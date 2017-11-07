<?php

class LdapAuth implements Auth
{

    public function login($username, $password, $token)
	{
	    global $conf;
		$db = db_connection();
		$this->mustChangePassword = false;
		
		// Lesen des Benutzers aus der DB-Tabelle
		$sql = $db->sql( <<<SQL
SELECT * FROM {{user}}
 WHERE name={name}
SQL
		);
		$sql->setString('name',$username);
	
		$row_user = $sql->getRow( $sql );
		$userid  = $row_user['id'];
		
		$ldap = new Ldap();
		$ldap->connect();
		
		if	( empty($conf['ldap']['dn']) )
		{
			// Der Benutzername wird im LDAP-Verzeichnis gesucht.
			// Falls gefunden, wird der DN (=der eindeutige Schl�ssel im Verzeichnis) ermittelt.
			$dn = $ldap->searchUser( $username );
			
			if	 ( empty($dn) )
			{
				Logger::debug( 'User not found in LDAP directory' );
				return false; // Kein LDAP-Account gefunden.
			}

			Logger::debug( 'User found: '.$dn );
		}
		else
		{
			$dn = str_replace( '{user}',$username,$conf['ldap']['dn'] );
		}
			
		// LDAP-Login versuchen
		$ok = $ldap->bind( $dn, $password );
		
		Logger::debug( 'LDAP bind: '.($ok?'success':'failed') );
		
		if	( !$ok )
			return false;
			
		$sucheAttribut = $conf['ldap']['authorize']['group_name'];
		$sucheFilter   = str_replace('{dn}',$dn,$conf['ldap']['authorize']['group_filter']);
		
		$this->groups = $ldap->searchAttribute( $sucheFilter, $sucheAttribut );
		$user = new User( $userid );
		
		// Html::debug($this->groups,'Gruppen/Ids des Benutzers');
		
		// Verbindung zum LDAP-Server brav beenden
		$ldap->close();

		return true;
	}

	public function username()
	{
		return null;
	}
	
}

?>