<?php

/**
 * Authentifizierung ueber ein SSL-Zertifikat.
 *  
 * @author dankert
 */
class SSLAuth implements Auth
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