<?php

namespace logger;

use Exception;
use util\json\JSON;
use util\Text;

/**
 * Writing log messages into a log file.
 *
 * @author Jan Dankert
 */
class Logger
{
	const LEVEL_TRACE = 5;
	const LEVEL_DEBUG = 4;
	const LEVEL_INFO  = 3;
	const LEVEL_WARN  = 2;
	const LEVEL_ERROR = 1;

	const OUTPUT_PLAIN = 1;
	const OUTPUT_JSON  = 2;


	public static $level = self::LEVEL_ERROR;
	public static $filename = null;

	public static $messageFormat = ['time','level','host','text'];
	public static $dateFormat = 'r';
	public static $nsLookup = false;
	/**
	 * @var null | callable
	 */
	public static $messageCallback = null;
	public static $outputType = self::OUTPUT_PLAIN;

	public static function init()
	{
	}


	/**
	 * Writes a trace message to log
	 *
	 * @param string|Exception message text
	 */
	public static function trace($message)
	{
		Logger::doLog(self::LEVEL_TRACE, $message);
	}


	/**
	 * Is trace enabled?
	 * @return bool
	 */
	public static function isTraceEnabled() {
		return Logger::$level >= self::LEVEL_TRACE;
	}

	/**
	 * Writes a debug message to log
	 *
	 * @param string|Exception message text
	 */
	public static function debug($message)
	{
		Logger::doLog(self::LEVEL_DEBUG, $message);
	}


	/**
	 * Writes a information message to log
	 *
	 * @param string|Exception message text
	 */
	public static function info($message)
	{
		Logger::doLog(self::LEVEL_INFO, $message);
	}


	/**
	 * Writes a warning message to log
	 *
	 * @param string|Exception message text
	 */
	public static function warn($message)
	{
		Logger::doLog(self::LEVEL_WARN, $message);
	}


	/**
	 * Writes an error message to log
	 *
	 * @param string|Exception message text
	 */
	public static function error($message)
	{
		Logger::doLog(self::LEVEL_ERROR, $message);
	}


	/**
	 * Writes a mesage into the log file
	 *
	 * @param string facility of log entry
	 * @param string|Throwable message text
	 */
	private static function doLog($facility, $message)
	{
		if   ( Logger::$level < $facility )
			return; // log level not reached.

		if ($facility == self::LEVEL_ERROR)
			$levelName = 'ERROR';
		elseif ($facility == self::LEVEL_WARN)
			$levelName = 'WARN';
		elseif ($facility == self::LEVEL_INFO)
			$levelName = 'INFO';
		elseif ($facility == self::LEVEL_DEBUG)
			$levelName = 'DEBUG';
		elseif ($facility == self::LEVEL_TRACE)
			$levelName = 'TRACE';
		else
			$levelName = '';

		if ($message instanceof Exception)
			$message = $message->getMessage()."\n".$message->__toString();

		$values = array_map( function($key) use ($message, $levelName) {
			switch( $key ) {
				case 'host':
					if (Logger::$nsLookup)
						return gethostbyaddr(getenv('REMOTE_ADDR'));
					else
						return getenv('REMOTE_ADDR');

				case 'level':
					return str_pad($levelName, 5);
				case 'agent':
					return getenv('HTTP_USER_AGENT');
				case 'time':
					return date(Logger::$dateFormat);
				case 'text':
					return $message;

				default:
					if   ( Logger::$messageCallback )
						return call_user_func(Logger::$messageCallback,$key);
					return '';
			}
		}, array_combine(Logger::$messageFormat,Logger::$messageFormat) );

		switch( self::$outputType ) {
			case self::OUTPUT_PLAIN:
			default:

				$text = '';
				foreach( $values as $value ) {
					if   ( ! $value )
						$value = '-';

					if   ( $text )
						$text = $text . ' ';

					$text .= '"'.str_replace('"','\"',$value).'"';
				}

				// Mehrzeilige Meldungen werden um 1 Spalte eingerueckt, um sie maschinell
				// erkennen und auswerten zu koennen.
				$text = str_replace("\n", "\n ", $text);
				break;

			case self::OUTPUT_JSON:
				$json = new JSON();
				$text = $json->encode( $values );
				$text = str_replace("\n", "", $text);
				break;
		}

		if ( Logger::$filename ) {

			if (!is_writable( Logger::$filename )) {

				error_log('logfile ' . Logger::$filename . ' is not writable');
				error_log($text . "\n");
			} else {
				// Writing to the logfile
				// It's not a good idea to user error_log here because it failed on symlinked files.
				file_put_contents( Logger::$filename,$text . "\n", FILE_APPEND );
			}
		}

		// Errors and warnings are written to the common error log.
		if (Logger::$level <= self::LEVEL_WARN)
			error_log($text . "\n");
	}

}