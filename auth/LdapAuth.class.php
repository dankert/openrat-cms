<?php

class LdapAuth implements Auth
{

	public function login($username, $password)
	{
		$db = db_connection();
		$this->mustChangePassword = false;
		
		// Lesen des Benutzers aus der DB-Tabelle
		$sql = new Sql( <<<SQL
SELECT * FROM {t_user}
 WHERE name={name}
SQL
		);
		$sql->setString('name',$this->name);
	
		$row_user = $db->getRow( $sql );

		$check = false;
		$authType = $conf['security']['auth']['type']; // Entweder 'ldap', 'authdb', 'http', oder 'database'
		
		if	( !empty($row_user) )
		{
			// Benutzername ist bereits in der Datenbank.
			$this->userid  = $row_user['id'];
			$this->ldap_dn = $row_user['ldap_dn'];
			$check   = true;
			$autoAdd = false; // Darf nicht hinzugef�gt werden, da schon vorhanden.
		}
		elseif( $authType == 'ldap' && $conf['ldap']['search']['add'] )
		{
			// Benutzer noch nicht in der Datenbank vorhanden.
			// Falls ein LDAP-Account gefunden wird, wird dieser �bernommen.
			$check   = true;
			$autoAdd = true;
		}
		elseif( $authType == 'authdb' && $conf['security']['authdb']['add'] )
		{
			$check   = true;
			$autoAdd = true;
		}
		elseif( $authType == 'http' && $conf['security']['http']['add'] )
		{
			$check   = true;
			$autoAdd = true;
		}

		if	( $check )
		{
			// Falls benutzerspezifischer LDAP-dn vorhanden wird Benutzer per LDAP authentifiziert
			if	( $conf['security']['auth']['userdn'] && !empty($this->ldap_dn ) )
			{
				Logger::debug( 'checking login via ldap' );
				$ldap = new Ldap();
				$ldap->connect();
				
				// Benutzer ist bereits in Datenbank
				// LDAP-Login mit dem bereits vorhandenen DN versuchen
				$ok = $ldap->bind( $this->ldap_dn, $password );
				
				// Verbindung zum LDAP-Server brav beenden
				$ldap->close();

				return $ok;
			}
			elseif( $authType == 'ldap' )
			{
				Logger::debug( 'checking login via ldap' );
				$ldap = new Ldap();
				$ldap->connect();
				
				if	( empty($conf['ldap']['dn']) )
				{
					// Der Benutzername wird im LDAP-Verzeichnis gesucht.
					// Falls gefunden, wird der DN (=der eindeutige Schl�ssel im Verzeichnis) ermittelt.
					$dn = $ldap->searchUser( $this->name );
					
					if	 ( empty($dn) )
					{
						Logger::debug( 'User not found in LDAP directory' );
						return false; // Kein LDAP-Account gefunden.
					}

					Logger::debug( 'User found: '.$dn );
				}
				else
				{
					$dn = str_replace( '{user}',$this->name,$conf['ldap']['dn'] );
				}
					
				// LDAP-Login versuchen
				$ok = $ldap->bind( $dn, $password );
				
				Logger::debug( 'LDAP bind: '.($ok?'success':'failed') );
				
				if	( $ok && $conf['security']['authorize']['type'] == 'ldap' )
				{
					$sucheAttribut = $conf['ldap']['authorize']['group_name'];
					$sucheFilter   = str_replace('{dn}',$dn,$conf['ldap']['authorize']['group_filter']);
					
					$ldap_groups = $ldap->searchAttribute( $sucheFilter, $sucheAttribut );
					$sql_ldap_groups = "'".implode("','",$ldap_groups)."'";
					
					$sql = new Sql( <<<SQL
SELECT id,name FROM {t_group}
 WHERE name IN($sql_ldap_groups)
 ORDER BY name ASC
SQL
					);
					$oldGroups = $this->getGroupIds();
					$this->groups = $db->getAssoc( $sql );
					
					foreach( $this->groups as $groupid=>$groupname)
					{
						if	( ! in_array($groupid,$oldGroups))
							$this->addGroup($groupid);
					}
					foreach( $oldGroups as $groupid)
					{
						if	( !isset($this->groups[$groupid]) )
							$this->delGroup($groupid);
					}
					
					
					// Pr�fen, ob Gruppen fehlen. Diese dann ggf. in der OpenRat-Datenbank hinzuf�gen.
					if	( $conf['ldap']['authorize']['auto_add'] )
					{
						foreach( $ldap_groups as $group )
						{
							if	( !in_array($group,$this->groups) ) // Gruppe schon da?
							{
								$g = new Group();
								$g->name = $group;
								$g->add(); // Gruppe hinzuf�gen
								
								$this->groups[$g->groupid] = $group;
							}
						}
					}
//					Html::debug($this->groups,'Gruppen/Ids des Benutzers');
				}
				
				// Verbindung zum LDAP-Server brav beenden
				$ldap->close();

				if	( $ok && $autoAdd )
				{
					// Falls die Authentifizierung geklappt hat, wird der
					// LDAP-Account in die Datenbank �bernommen.
					$this->ldap_dn  = $dn;
					$this->fullname = $this->name;
					$this->add();
					$this->save();
				}
				
				return $ok;
			}
			elseif( $authType == 'database' )
			{
				// Pruefen ob Kennwort mit Datenbank uebereinstimmt
				if   ( $row_user['password'] == $password )
				{
					// Kennwort stimmt mit Datenbank �berein, aber nur im Klartext.
					// Das Kennwort muss ge�ndert werden
					$this->mustChangePassword = true;
					
					// Login nicht erfolgreich
					return false;
				}
				elseif   ( $row_user['password'] == md5( $this->saltPassword($password) ) )
				{
					// Die Kennwort-Pr�fsumme stimmt mit dem aus der Datenbank �berein.
					// Juchuu, Login ist erfolgreich.
					return true;
				}
				else
				{
					// Kennwort stimmt garnicht �berein.
					return false;
				}
			}
			elseif( $authType == 'authdb' )
			{
				$authdb = new DB( $conf['security']['authdb'] );
				$sql = new Sql( $conf['security']['authdb']['sql'] );
				$sql->setString('username',$this->name);
				$sql->setString('password',$password);
				$row = $authdb->getRow( $sql );
				$ok = !empty($row);

				if	( $ok && $autoAdd )
				{
					// Falls die Authentifizierung geklappt hat, wird der
					// Benutzername in der eigenen Datenbank eingetragen.
					$this->fullname = $this->name;
					$this->add();
					$this->save();
				}
				// noch nicht implementiert: $authdb->close();
				
				return $ok;
			}
			elseif( $authType == 'http' )
			{
				$http = new Http( $conf['security']['http']['url'] );
				$http->method = 'HEAD';
				$http->setBasicAuthentication( $this->name, $password );
				
				$ok = $http->request();
				
				return $ok; 
			}
			else
			{
				die( 'unknown authentication-type in configuration: '.$authType );
			}
		}

		// Benutzername nicht in Datenbank.
		return false;
	}

	public function username()
	{
		return null;
	}
	
}

?>