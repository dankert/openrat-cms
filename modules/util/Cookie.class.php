<?php


namespace util;


use cms\base\Configuration;
use cms\base\Startup;

class Cookie
{
	/**
	 * Gets a cookie
	 * @param $name string key
	 * @param $default string default value
	 * @return string
	 */
	public static function get( $name,$default=null ) {
		$value = @$_COOKIE[ $name ];
		if   ( !$value )
			return $default;
		return $value;
	}


	/**
	 * is a cookie set?
	 * @param $name string key
	 * @return boolean
	 */
	public static function has( $name ) {
		return isset( $_COOKIE[ $name ] );
	}


	/**
	 * Sets a cookie.
	 *
	 * @param $name string cookie name
	 * @param $value string cookie value, null or empty to delete
	 */
	public static function set($name, $value = '' ) {

		$cookieConfig = Configuration::subset('security')->subset('cookie');

		if ( ! $value )
			$expire = Startup::getStartTime(); // Cookie wird gelöscht.
		else
			$expire = Startup::getStartTime() + 60 * 60 * 24 * $cookieConfig->get('expire',2*365); // default: 2 years

		$cookieAttributes = [
			rawurlencode($name).'='.rawurlencode($value),
			'Expires='.date('r',$expire),
			'Path='.COOKIE_PATH
		];

		if   ( $cookieConfig->is('secure',false ) )
			$cookieAttributes[] = 'Secure';

		if   ( $cookieConfig->is('httponly',true ) )
			$cookieAttributes[] = 'HttpOnly';

		$cookieAttributes[] = 'SameSite='.$cookieConfig->get('samesite','Lax');

		header('Set-Cookie: '.implode('; ',$cookieAttributes),false );
	}
}