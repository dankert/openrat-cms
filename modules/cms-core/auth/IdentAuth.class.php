<?php

use util\Http;

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
		$ip   = Http::getClientIP();
		$port = Http::getClientPort();
		$identPort = 113;
		if ( !$socket = @fsockopen($ip,$identPort,$errno, $errstr,10 ))
		{
			return null;
		}
		
		$line = $port.','.$_SERVER['SERVER_PORT']."\r\n";
		@fwrite($socket, $line);
		$line = @fgets($socket, 1000); // 1000 octets according to RFC 1413
		fclose($socket);
		
		$array = explode(':', $line, 4);
		if (count($array) >= 4 && ! strcasecmp(trim($array[1]), 'USERID'))
		{
			$username = trim($array[3]);
			Logger::debug('Ident: User-Id: '.$username );
			return $username;
		}
		elseif (count($array) >= 3 && ! strcasecmp(trim($array[1]), 'ERROR'))
		{
			Logger::debug('Ident: Error: '.trim($array[2]) );
			return null;
		}
		else
		{
			Logger::warn('Ident: Invalid ident server response: '.$line);
			return null;		
		}
	}
	
	
	/**
	 * Ueberpruefen des Kennwortes ist über Ident nicht möglich.
	 */
	public function login( $user, $password, $token )
	{
		return OR_AUTH_STATUS_FAILED;
	}
}

?>