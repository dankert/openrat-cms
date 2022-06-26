<?php

namespace cms\generator\dsl;

use dsl\context\BaseScriptableObject;
use logger\Logger;

/**
 * Logging.
 *
 * Wraps around the internal CMS logging.
 *
 * @package cms\generator\dsl
 */
class DslConsole  extends BaseScriptableObject
{

	public function log( $text )
	{
		Logger::info( $text );
	}
	public function debug( $text )
	{
		Logger::debug( $text );
	}
	public function trace( $text )
	{
		Logger::trace( $text );
	}
	public function info( $text )
	{
		Logger::info( $text );
	}
	public function warn( $text )
	{
		Logger::warn( $text );
	}
	public function error( $text )
	{
		Logger::error( $text );
	}
}