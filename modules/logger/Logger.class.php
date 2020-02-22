<?php


namespace logger;
use Exception;

define('LOGGER_LOG_TRACE', 5);
define('LOGGER_LOG_DEBUG', 4);
define('LOGGER_LOG_INFO', 3);
define('LOGGER_LOG_WARN', 2);
define('LOGGER_LOG_ERROR', 1);

/**
 * Schreiben eines Eintrages in die Logdatei.
 *
 * @author Jan Dankert
 */
class Logger
{
	public static $level = LOGGER_LOG_ERROR;
	public static $filename = null;

	public static $messageFormat = '%time %level %host %text';
	public static $dateFormat = 'M j H:i:s';
	public static $nsLookup = false;
	public static $messageCallback;

	public static function init()
	{

	}


	/**
	 * Schreiben einer Trace-Meldung in die Logdatei
	 *
	 * @param string message Log-Text
	 */
	public static function trace($message)
	{
		if (Logger::$level >= LOGGER_LOG_TRACE)
			Logger::doLog(LOGGER_LOG_TRACE, $message);
	}


	/**
	 * Schreiben einer Debug-Meldung in die Logdatei
	 *
	 * @param string message Log-Text
	 */
	public static function debug($message)
	{
		if (Logger::$level >= LOGGER_LOG_DEBUG)
			Logger::doLog(LOGGER_LOG_DEBUG, $message);
	}


	/**
	 * Schreiben einer Information in die Logdatei
	 *
	 * @param string message Log-Text
	 */
	public static function info($message)
	{
		if (Logger::$level >= LOGGER_LOG_INFO)
			Logger::doLog(LOGGER_LOG_INFO, $message);
	}


	/**
	 * Schreiben einer Warnung in die Logdatei
	 *
	 * @param string message Log-Text
	 */
	public static function warn($message)
	{
		if (Logger::$level >= LOGGER_LOG_WARN)
			Logger::doLog(LOGGER_LOG_WARN, $message);
	}


	/**
	 * Schreiben einer normalen Fehlermeldung in die Logdatei
	 *
	 * @param string message Log-Text
	 */
	public static function error($message)
	{
		if (Logger::$level >= LOGGER_LOG_ERROR)
			Logger::doLog(LOGGER_LOG_ERROR, $message);
	}


	/**
	 * Schreiben der Meldung in die Logdatei
	 *
	 * @param string facility Schwere dieses Logdatei-Eintrages (z.B. warning)
	 * @param string message Log-Text
	 * @access private
	 */
	private static function doLog($facility, $message)
	{
		if ($facility == LOGGER_LOG_ERROR)
			$thisLevel = 'ERROR';
		elseif ($facility == LOGGER_LOG_WARN)
			$thisLevel = 'WARN';
		elseif ($facility == LOGGER_LOG_INFO)
			$thisLevel = 'INFO';
		elseif ($facility == LOGGER_LOG_DEBUG)
			$thisLevel = 'DEBUG';
		elseif ($facility == LOGGER_LOG_TRACE)
			$thisLevel = 'TRACE';


		// Ersetzen von Variablen
		if (Logger::$nsLookup)
			$vars['host'] = gethostbyaddr(getenv('REMOTE_ADDR'));
		else
			$vars['host'] = getenv('REMOTE_ADDR');

		if (isset(Logger::$messageCallback)) {
			$cb = Logger::$messageCallback;
			$vars += $cb();
		}

		$vars['level'] = str_pad($thisLevel, 5);
		$vars['agent'] = getenv('HTTP_USER_AGENT');
		$vars['time'] = date(Logger::$dateFormat);
		if ($message instanceof Exception)
			$message = $message->getTraceAsString();
		$vars['text'] = $message;

		$text = Logger::$messageFormat;

		// Variablen ersetzen.
		foreach ($vars as $key => $value) {
			$text = str_replace('%' . $key, $value, $text);
		}

		// Mehrzeilige Meldungen werden um 1 Spalte eingerueckt, um sie maschinell
		// erkennen und auswerten zu koennen.
		$text = str_replace("\n", "\n ", $text);

		if (isset(Logger::$filename)) {

			if (!is_writable(Logger::$filename)) {

				error_log('logfile ' . Logger::$filename . ' is not writable');
				error_log($text . "\n");
			} else {
				// Schreiben in Logdatei
				error_log($text . "\n", 3, Logger::$filename);
			}
		}

		// ERROR- und WARN-Meldungen immer zusätzlich in das Error-Log schreiben.
		if (Logger::$level <= LOGGER_LOG_WARN)
			error_log($text . "\n");
	}
}

?>