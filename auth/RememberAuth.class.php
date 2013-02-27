<?php

/**
 * Authentifizierung mit einem Login-Token.
 *  
 * @author dankert
 */
class CookieAuth implements Auth
{
	public function username()
	{
		if	( isset($_COOKIE['or_username']) )
		{
			$name = $_COOKIE['or_username'];
			try
			{
				$user = User::loadWithName($name);
				$token = $user->loginToken();
				
				// Stimmt der Token?
				if	( $_COOKIE['or_token'] == $token )
					// Token stimmt, Benutzer ist damit angemeldet.
					return $name;
			}
			catch( ObjectNotFoundException $e )
			{
				// Benutzer nicht gefunden.
			}
		}
		
		return null;
	}
	
	
	/**
	 * Ueberpruefen des Kennwortes ist über den Cookie nicht möglich.
	 */
	public function login( $user, $password )
	{
		return false;
	}
}

?>