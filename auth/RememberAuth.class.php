<?php

/**
 * Authentifizierung mit einem Login-Token.
 *  
 * @author dankert
 */
class RememberAuth implements Auth
{
	public function username()
	{
		// Ermittelt den Benutzernamen aus den Login-Cookies.
		if	( isset($_COOKIE['or_username']) &&
			  isset($_COOKIE['or_token'   ]) &&
			  isset($_COOKIE['or_dbid'    ])    )
		{
			$name = $_COOKIE['or_username'];
			try
			{
				$dbid = $_COOKIE['or_dbid'];
				
				global $conf;
				$db = new DB( $conf['database'][$dbid] );
				$db->id = $dbid;
				$db->start();
				Session::setDatabase($db);
				
				// Jetzt den Benutzer laden und nachschauen, ob der Token stimmt.
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