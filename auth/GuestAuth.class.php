<?php

/**
 * Authentifizierung als Gast-User.
 * 
 * Falls konfiguriert, wird der Gast-Benutzer voreingestellt.
 *  
 * @author dankert
 */
class GuestAuth implements Auth
{
	public function username()
	{
		global $conf;
		$guestConf = $conf['security']['guest'];
			
		if	( $guestConf['enable'] )
			return $guestConf['user'];
		else
			return null;
	}
	
	
	/**
	 * Ueberpruefen des Kennwortes ist über Ident nicht möglich.
	 */
	public function login( $user, $password )
	{
		return false;
	}
}

?>