<?php

/**
 * Authentifzierung über eine externe Datenbank.
 * @author dankert
 *
 */
class DatabaseAuth implements Auth
{

	/**
	 * Login.
	 */
	function login( $user, $password )
	{
		global $conf;

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
}

?>