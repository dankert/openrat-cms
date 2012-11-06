<?php

/**
 * Authentifizierung als Gast-User.
 * 
 * Falls konfiguriert, wird der Gast-Benutzer voreingestellt.
 *  
 * @author dankert
 */
class CookieAuth implements Auth
{
	public function username()
	{
		if	( isset($_COOKIE['or_username']) )
			return $_COOKIE['or_username'];
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