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
    public function login( $user, $password, $token )
	{
		global $conf;
		
		$authDbConf = $conf['security']['authdb'];
		
		if	( ! $authDbConf['enable'] )
			return false;

		$authdb = new DB( $authDbConf );
		
		$sql  = $authdb->sql( $conf['security']['authdb']['sql'] );
		$algo = $authdb->sql( $conf['security']['authdb']['hash_algo'] );
		$sql->setString('username',$user    );
		$sql->setString('password',hash($algo,$password));
		$row = $sql->getRow();
		$ok = !empty($row);
		
		// noch nicht implementiert: $authdb->close();
		
		return $ok?OR_AUTH_STATUS_SUCCESS:OR_AUTH_STATUS_FAILED;
	}
	
	public function username()
	{
		return null;
	}

}

?>