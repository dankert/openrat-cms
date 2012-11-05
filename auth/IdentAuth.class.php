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
		$ip   = Http::getClientIP();
		$port = 113;
		
		if ( !$socket = @fsockopen($ip,$port,$errno, $errstr,10 ))
		{
			return null;
		}
		
		$line = $port.','.$_SERVER['SERVER_PORT']."\r\n";
		@fwrite($socket, $line);
		$line = @fgets($socket, 1000); // 1000 octets according to RFC 1413
		fclose($socket);
		
		$array = explode(':', $string, 4);
		if (count($array) > 1 && ! strcasecmp(trim($array[1]), 'USERID'))
		{
			if	( isset($array[3]) )
				return trim($array[3]);
			else
				Logger::warn('Ident: Invalid ident server response: '.$line);
			
			return null;
		}
		elseif (count($array) > 1 && ! strcasecmp(trim($array[1]), 'ERROR'))
		{
			if	( isset($array[2]) )
				Logger::warn('Ident: '.trim($array[2]) );
			else
				Logger::warn('Ident: Invalid ident server response: '.$line);
				
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
	public function login( $user, $password )
	{
		return false;
	}
}

?>