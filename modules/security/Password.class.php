<?php
namespace security;



use cms\base\Configuration;

/**
 * Security functions for passwords.
 * 
 * @author Jan dankert
 *
 */
class Password
{
    /**
     * yes, we are supporting PLAIN passwords. Why?
     * Normally, there are not used, but in developing situations this is useful.
     */
    const ALGO_PLAIN             = 0;
    const ALGO_CRYPT             = 1;
    const ALGO_MD5               = 2;
    const ALGO_PHP_PASSWORD_HASH = 3;
    const ALGO_SHA1              = 4;

    /**
	 * Detects the best available algorhythm for password hashing.
	 */
	static public function bestAlgoAvailable()
	{
		if	( function_exists('password_hash') )
		{
		    // Use BCRYPT, this is available since PHP 5.5 and is safe for now.
			return self::ALGO_PHP_PASSWORD_HASH;
		}
		elseif	( function_exists('crypt') && defined('CRYPT_BLOWFISH') && CRYPT_BLOWFISH == 1 )
		{
		    // see https://en.wikipedia.org/wiki/Blowfish_(cipher)
            // BLOWFISH
			return self::ALGO_CRYPT;
		}
		elseif	( function_exists('sha1') )
		{
            // see https://en.wikipedia.org/wiki/SHA-1
            // should not be used because of some security issues.
			return self::ALGO_SHA1;
		}
		elseif	( function_exists('md5') )
		{
            // see https://en.wikipedia.org/wiki/MD5
            // should not be used because of some security issues.
			return self::ALGO_MD5;
		}
		else
		{
		    // This should never happen ;)
			return self::ALGO_PLAIN;
		}
	}


	
	/**
	 * Hash the password.
     *
	 * @param $password string The password to hash
	 * @param $algo int Hashing algorhythm
	 * @param $cost cost factor: An integer between 4 and 31.
	 */
	static public function hash( $password,$algo,$cost=10 )
	{
		switch( $algo )
		{
			case self::ALGO_PHP_PASSWORD_HASH:

			    return password_hash( $password, PASSWORD_BCRYPT,array('cost'=>$cost) );
				
			case self::ALGO_CRYPT:

				$salt  = Password::randomHexString(10); // this should be cryptographically safe.

                // see https://www.php.net/security/crypt_blowfish.php
				if	( version_compare(PHP_VERSION, '5.3.7') >= 0 )
					$algo = '2y'; // BLOWFISH
				else
					$algo = '2a'; // "old" BLOWFISH, but no problem if using PHP >= 5.3.7
				
				// cost factor should be between '04' and '31'.
				$cost = max(min($cost,31),4); 
				$cost = str_pad($cost, 2, '0', STR_PAD_LEFT);
				
				return crypt($password,'$'.$algo.'$'.$cost.'$'.$salt.'$');
				
			case self::ALGO_MD5:
				return md5($password); // ooold.
				
			case self::ALGO_SHA1:
				return sha1($password); //
				
			case self::ALGO_PLAIN:
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
			case self::ALGO_PHP_PASSWORD_HASH:
			    // This is 'timing attack safe' as the documentation says.
				return password_verify($password,$hash);
				
			case self::ALGO_CRYPT:
		
				if	( function_exists('crypt') )
				{
					// Workaround: Die Spalte 'password' war frueher nur 50 Stellen lang, daher
					// wird der mit crypt() erzeugte Hash auf die Länge des gespeicherten Hashes
					// gekürzt. Mit aktuellen Versionen gespeicherte Hashes haben die volle Länge.
					return Password::equals( $hash, substr(crypt($password,$hash),0,strlen($hash)) );
				}
				else
				{
					throw new LogicException("Modular crypt format is not supported by this PHP ".PHP_VERSION."  (no function 'crypt()')");
				}

			case self::ALGO_SHA1:
			    return Password::equals( $hash, sha1($password) );
				
			case self::ALGO_MD5:
			    return Password::equals( $hash, md5($password) );
				
			case self::ALGO_PLAIN:
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
		// With '@' we reject the message "Invalid characters passed" since PHP 7.4
   		return @bindec( Password::randomBytes($bytesCount) );
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
	 * Creates a new, pronounceable password.
	 *
	 * Inspired by http://www.phpbuilder.com/annotate/message.php3?id=1014451
	 *
	 * @return String a random password
	 */
	public static function createPassword()
	{
		$passwordConfig = Configuration::subset('security')->subset('password');

		$pw = '';
		$c  = 'bcdfghjklmnprstvwz'; // consonants except hard to speak ones
		$v  = 'aeiou';              // vowels
		$a  = $c.$v.'123456789';    // both (plus numbers except zero)

		//use two syllables...
		for ( $i=0; $i < intval($passwordConfig->get('generated_length',16))/3; $i++ )
		{
			$pw .= $c[rand(0, strlen($c)-1)];
			$pw .= $v[rand(0, strlen($v)-1)];
			$pw .= $a[rand(0, strlen($a)-1)];
		}

		return $pw;
	}



	/**
	 * Pepper the password.
	 *
	 * Siehe http://de.wikipedia.org/wiki/Salt_%28Kryptologie%29#Pfeffer
	 * für weitere Informationen.
	 *
	 * @param $pass string password
	 * @return string peppered password
	 */
	public static function pepperPassword( $pass )
	{
		$salt = Configuration::Conf()->subset('security')->subset('password')->get('pepper');

		return $salt.$pass;
	}



}
