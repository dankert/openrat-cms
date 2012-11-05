<?php

/**
 * Authentifizierung via Ident-Server.
 * 
 * Der Benutzername wird über einen Ident-Server, der auf dem
 * Client installiert sein muss, ermittelt.
 *  
 * @author dankert
 */
class IdentAuth implements Auth
{

	public function username()
	{
		// TODO: Ident.
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