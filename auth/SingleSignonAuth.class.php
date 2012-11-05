<?php

/**
 * Single-Signon-Authentifizierung.
 * 
 * @author dankert
 */
class SingleSignonAuth implements Auth
{
	public function username()
	{
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