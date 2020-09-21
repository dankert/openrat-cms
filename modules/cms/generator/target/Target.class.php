<?php


namespace cms\generator\target;


use util\Url;

interface Target
{

	public function __construct( $targetUrl );


	public static function accepts( $scheme );


	public function open();


	public function put($source, $dest, $timestamp);


	/**
	 * Closes the connection.
	 */
	public function close();


	public static function isAvailable();

}