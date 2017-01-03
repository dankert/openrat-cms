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
		
		$authDbConf = $conf['security']['authdb'];
		
		if	( ! $authDbConf['enable'] )
			return false;

		$authdb = new DB( $authDbConf );
		
		$sql = $db->sql( $conf['security']['authdb']['sql'] );
		$sql->setString('username',$user    );
		$sql->setString('password',$password);
		$row = $authdb->getRow( $sql );
		$ok = !empty($row);
		
		// noch nicht implementiert: $authdb->close();
		
		return $ok;
	}
	
	public function username()
	{
		return null;
	}

}

?>