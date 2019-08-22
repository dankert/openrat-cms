<?php

use database\Database;
use cms\model\User;

/**
 * Authentifizierung mit einem Login-Token.
 *  
 * @author dankert
 */
class RememberAuth implements Auth
{
    /**
     * @return null
     */
    public function username()
	{
		// Ermittelt den Benutzernamen aus den Login-Cookies.
		if	( isset($_COOKIE['or_token'   ]) &&
			  isset($_COOKIE['or_dbid'    ])    )
		{
			try
			{
			    list( $selector,$token) = array_pad( explode('.',$_COOKIE['or_token']),2,'');
				$dbid = $_COOKIE['or_dbid'];
				
				global $conf;
				$db = new Database( $conf['database'][$dbid] );
				$db->id = $dbid;
				$db->start();

				$stmt = $db->sql( <<<SQL
                    SELECT userid,{{user}}.name as username,token,token_algo FROM {{auth}}
                       LEFT JOIN {{user}} ON {{auth}}.userid = {{user}}.id
                    WHERE selector = {selector} AND expires > {now}
SQL
                );
				$stmt->setString('selector',$selector);
				$stmt->setInt   ('now'     ,time()   );

				$auth = $stmt->getRow();

				if  ( $auth )
                {
                    if   ( \security\Password::check($token, $auth['token'],$auth['token_algo']) )
                        return $auth['username'];
                }

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
	public function login( $user, $password, $token )
	{
		return false;
	}
}

?>