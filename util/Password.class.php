<?php


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
	 * Hashen eines Kennwortes mit Bcrypt (bzw. MD5).
	 * @param $password
	 * @param $cost Kostenfaktor: Eine Ganzzahl von 4 bis 31.
	 */
	static public function hash( $password,$cost=10 )
	{
		if	( function_exists('crypt') && defined('CRYPT_BLOWFISH') && CRYPT_BLOWFISH == 1 )
		{
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
		}
		else
		{
			return md5($password);
		}
	}
	
	/**
	 * Prüft das Kennwort gegen einen gespeicherten Hashwert.
	 * 
	 * @param String $password Passwort
	 * @param String $hash Hash
	 * @return boolean true, falls das Passwort dem Hashwert entspricht.
	 */
	static public function check( $password,$hash )
	{
		if	( substr($hash,0,1) != '$' )
			// Wenn kein '$' voransteht, dann handelt es sich wohl um
			// einen alten MD5-Hash
			return $hash == md5($password);
		
		elseif	( function_exists('crypt') )
		{
			return $hash == crypt($password,$hash);
		}
		else
		{
			throw new Exception("Modular crypt format is not supported by this PHP version (no function 'crypt()')");
		}
	}
}
?>