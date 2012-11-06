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
//			Html::debug($this->groups,'Gruppen/Ids des Benutzers');
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

	public function username()
	{
		return null;
	}
	
}

?>