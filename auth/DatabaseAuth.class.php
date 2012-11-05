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
	public function login( $user, $password )
	{
		global $conf;

		$authdb = new DB( $conf['security']['authdb'] );
		
		$sql = new Sql( $conf['security']['authdb']['sql'] );
		$sql->setString('username',$this->name);
		$sql->setString('password',$password);
		$row = $authdb->getRow( $sql );
		$ok = !empty($row);
		
		// noch nicht implementiert: $authdb->close();
		
		return $ok;
	}
}

?>