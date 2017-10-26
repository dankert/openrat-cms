<?php

define('OR_PASSWORD_ALGO_PLAIN',0);
define('OR_PASSWORD_ALGO_CRYPT',1);
define('OR_PASSWORD_ALGO_MD5'  ,2);


/**
 * Hashfunktion für Passwörter.
 * 
 * Als Hashfunktion wird Bcrypt verwendet. Falls Bcrypt nicht zur
 * Verfügung steht, erfolgt ein Fallback auf MD5.
 * 
 * @author dankert
 *
 */
class Password
{
	/**
	 * Ermittelt den bestverfügbarsten hash-Algorhytmus.
	 */
	static public function bestAlgoAvailable()
	{
		if	( function_exists('crypt') && defined('CRYPT_BLOWFISH') && CRYPT_BLOWFISH == 1 )
		{
			return OR_PASSWORD_ALGO_CRYPT;
		}
		elseif	( function_exists('md5') )
		{
			return OR_PASSWORD_ALGO_MD5;
		}
		else
		{
			return OR_PASSWORD_ALGO_PLAIN;
		}
	}
	
		
	/**
	 * Hashen eines Kennwortes mit Bcrypt (bzw. MD5).
	 * @param $password
	 * @param $algo Algo
	 * @param $cost Kostenfaktor: Eine Ganzzahl von 4 bis 31.
	 */
	static public function hash( $password,$algo,$cost=10 )
	{
		switch( $algo )
		{
			case OR_PASSWORD_ALGO_CRYPT:
				
				$chars = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				$salt  = '';
				for( $i = 1; $i <= 22; $i++ )
					$salt .= $chars[ rand(0,63) ];
			
				// 
				if	( version_compare(PHP_VERSION, '5.3.7') >= 0 )
					$algo = '2y';
				else
					$algo = '2a';
				
				// Kostenfaktor muss zwischen '04' und '31' (jeweils einschließlich) liegen.
				$cost = max(min($cost,31),4); 
				$cost = str_pad($cost, 2, '0', STR_PAD_LEFT);
				
				return crypt($password,'$'.$algo.'$'.$cost.'$'.$salt.'$');
				
			case OR_PASSWORD_ALGO_MD5:
				return md5($password); // ooold.
				
			case OR_PASSWORD_ALGO_PLAIN:
				return $password; // you want it, you get it.
		}
	}
	
	/**
	 * Prüft das Kennwort gegen einen gespeicherten Hashwert.
	 * 
	 * @param String $password Passwort
	 * @param String $hash Hash
	 * @return boolean true, falls das Passwort dem Hashwert entspricht.
	 */
	static public function check( $password,$hash,$algo )
	{
		switch( $algo )
		{
			case OR_PASSWORD_ALGO_MD5:
				return $hash == md5($password);
				
			case OR_PASSWORD_ALGO_CRYPT:
		
				if	( function_exists('crypt') )
				{
					// Workaround: Die Spalte 'password' ist z.Zt. nur 50 Stellen lang, daher
					// wird der mit crypt() erzeugte Hash auf die Länge des gespeicherten Hashes
					// gekürzt. Falls die Spalte später länger ist, wirkt automatisch die volle
					// Hash-Länge.
					return $hash == substr(crypt($password,$hash),0,strlen($hash));
				}
				else
				{
					throw new Exception("Modular crypt format is not supported by this PHP version (no function 'crypt()')");
				}
				
			case OR_PASSWORD_ALGO_PLAIN:
				return $hash == $password;
		}
	}
	
	static public function randomHexString( $bytesCount )
	{
		if	( function_exists('random_bytes') )
		{
			return bin2hex( random_bytes($bytesCount) );
		}
		elseif	( function_exists('openssl_random_pseudo_bytes') )
		{
			return bin2hex( openssl_random_pseudo_bytes($bytesCount) );
		}
		else
		{
			// This fallback is NOT cryptographic safe!
			$buf = '';
    		for ($i = 0; $i < $length; ++$i)
    		{
		        $buf .= chr(mt_rand(0, 255));
		    }
    		return bin2hex($buf);
		}
	}
}
?>