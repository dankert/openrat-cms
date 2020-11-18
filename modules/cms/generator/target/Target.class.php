<?php


namespace cms\generator\target;


use util\Url;

/**
 * A target is a target for publishing files. A target is the bridge to a place where files are being copied to.
 */
interface Target
{

	/**
	 * Creating the target.
	 *
	 * @param $targetUrl string target URL
	 */
	public function __construct( $targetUrl );


	/**
	 * Open the connection to the target.
	 */
	public function open();


	/**
	 * Pushing a file to the target.
	 * @param $source string local filename
	 * @param $dest string remote filename
	 * @param $timestamp int timestamp of source file
	 */
	public function put($source, $dest, $timestamp);


	/**
	 * Closes the connection.
	 */
	public function close();


	/**
	 * Is this target available?
	 *
	 * @return boolean
	 */
	public static function isAvailable();

}