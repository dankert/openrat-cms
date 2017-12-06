<?php
namespace security;

define('OR_PASSWORD_ALGO_PLAIN',0);
define('OR_PASSWORD_ALGO_CRYPT',1);
define('OR_PASSWORD_ALGO_MD5'  ,2);
define('OR_PASSWORD_ALGO_PHP_PASSWORD_HASH',3);
define('OR_PASSWORD_ALGO_SHA1'  ,4);


/**
 * Sicherheitsfunktionen für Passwörter.
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
		if	( function_exists('password_hash') )
		{
			return OR_PASSWORD_ALGO_PHP_PASSWORD_HASH;
		}
		elseif	( function_exists('crypt') && defined('CRYPT_BLOWFISH') && CRYPT_BLOWFISH == 1 )
		{
			return OR_PASSWORD_ALGO_CRYPT;
		}
		elseif	( function_exists('sha1') )
		{
			return OR_PASSWORD_ALGO_SHA1;
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
	 * @param $algo int Algo
	 * @param $cost Kostenfaktor: Eine Ganzzahl von 4 bis 31.
	 */
	static public function hash( $password,$algo,$cost=10 )
	{
		switch( $algo )
		{
			case OR_PASSWORD_ALGO_PHP_PASSWORD_HASH:

			    return password_hash( $password, PASSWORD_BCRYPT,array('cost'=>$cost) );
				
			case OR_PASSWORD_ALGO_CRYPT:

				$salt  = Password::randomHexString(10); // this should be cryptographically safe.
				
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
				
			case OR_PASSWORD_ALGO_SHA1:
				return sha1($password); //
				
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
			case OR_PASSWORD_ALGO_PHP_PASSWORD_HASH:
			    // This is 'timing attack safe' as the documentation says.
				return password_verify($password,$hash);
				
			case OR_PASSWORD_ALGO_CRYPT:
		
				if	( function_exists('crypt') )
				{
					// Workaround: Die Spalte 'password' war frueher nur 50 Stellen lang, daher
					// wird der mit crypt() erzeugte Hash auf die Länge des gespeicherten Hashes
					// gekürzt. Mit aktuellen Versionen gespeicherte Hashes haben die volle Länge.
					return Password::equals( $hash, substr(crypt($password,$hash),0,strlen($hash)) );
				}
				else
				{
					throw new LogicException("Modular crypt format is not supported by this PHP version (no function 'crypt()')");
				}

			case OR_PASSWORD_ALGO_SHA1:
			    return Password::equals( $hash, sha1($password) );
				
			case OR_PASSWORD_ALGO_MD5:
			    return Password::equals( $hash, md5($password) );
				
			case OR_PASSWORD_ALGO_PLAIN:
			    return Password::equals( $hash, $password );
		}
	}
	
	
	/**
	 * Creates cryptographic safe random bytes in HEX format.
	 * @param int $bytesCount
	 * @return string HEX
	 */
	static public function randomHexString( $bytesCount )
	{
		return bin2hex( Password::randomBytes($bytesCount) );
	}
	

	/**
	 * Creates a cryptographic safe number.
	 * @param int $bytesCount
	 * @return int
	 */
	static public function randomNumber( $bytesCount )
	{
   		return bindec( Password::randomBytes($bytesCount) );
	}
	

	/**
	 * Creates cryptographic safe random bytes.
	 * @param int $bytesCount
	 * @return string Binary bytes
	 */
	static public function randomBytes( $bytesCount )
	{
		if	( function_exists('random_bytes') )
		{
			return random_bytes($bytesCount);
		}
		elseif	( function_exists('openssl_random_pseudo_bytes') )
		{
			return openssl_random_pseudo_bytes($bytesCount);
		}
		else
		{
			// This fallback is NOT cryptographic safe!
			$buf = '';
    		for ($i = 0; $i < $length; ++$i)
    		{
		        $buf .= chr(mt_rand(0, 255));
		    }
    		return $buf;
		}
	}
	

	/**
	 * Time-safe Compare of 2 strings.
	 * 
	 * @param String $known
	 * @param String $user
	 * @return boolean true, if equal
	 */
	static private function equals( $known, $user )
	{
        if( function_exists('hash_equals'))
        {
            return hash_equals($known, $user);
        }
        else
        {
            if  ( strlen($known) != strlen($user) )
            {
                return false;
            }
            else
            {
                $res = $known ^ $user;
                $ret = 0;
                for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);
                return !$ret;
            }
        }
	}
	

	/**
	 * Cryptographic delay of execution.
	 * Delay is from 0 to 168 milliseconds, Steps of 10 nanoseconds(!), which would be very heavy to attack over a network.
	 */
	static public function delay()
	{
	    time_nanosleep(0, Password::randomNumber(3)*10); // delay: 0-167772150ns (= 0-~168ms)  
	}
	
	
	
	
	
	/**
	 * Calculate the code, with given secret and point in time.
	 *
	 * @param string   $secret
	 * @param int|null $timeSlice
	 *
	 * @return string
	 */
	public static function getTOTPCode( $secret )
	{
		$codeLength = 6;
		$timeSlice = floor(time() / 30);
		$secretkey = @hex2bin($secret);
		// Pack time into binary string
		$time = chr(0).chr(0).chr(0).chr(0).pack('N*', $timeSlice);
		// Hash it with users secret key
		$hm = hash_hmac('SHA1', $time, $secretkey, true);
		// Use last nipple of result as index/offset
		$offset = ord(substr($hm, -1)) & 0x0F;
		// grab 4 bytes of the result
		$hashpart = substr($hm, $offset, 4);
		// Unpak binary value
		$value = unpack('N', $hashpart);
		$value = $value[1];
		// Only 32 bits
		$value = $value & 0x7FFFFFFF;
		$modulo = pow(10, $codeLength);
		return str_pad($value % $modulo, $codeLength, '0', STR_PAD_LEFT);
	}
	
	
}
?>