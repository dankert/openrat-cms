<?php

namespace cms\status;


/**
 * Metrics.
 */
class Metrics
{
	/**
     * Creating the metrics
     */
    public static function execute()
    {
		$data    = '';

		$data .= self::createGauge('interpreter_version','Major version of PHP Interpreter',PHP_MAJOR_VERSION);
		$data .= self::createGauge('resource_usage','current resource usage',getrusage() );
		$data .= self::createGauge('memory','memory usage', [
				'allocated' => memory_get_usage(true),
				'used'      => memory_get_usage(),
				'peak_allocated' => memory_get_peak_usage(true),
				'peak_used'      => memory_get_peak_usage(),
			]);


		$data .= "# EOF\n";

		header('Content-Type: application/openmetrics-text; version=1.0.0; charset=UTF-8');

        if (!headers_sent()) {
            // HTTP Spec:
            // "Applications SHOULD use this field to indicate the transfer-length of the
        	//  message-body, unless this is prohibited by the rules in section 4.4."
            //
            // And the overhead of 'Transfer-Encoding: chunked' is eliminated...
			header('HTTP/1.0 200 OK' );
            header('Content-Length: ' . strlen($data));
		}

		echo $data;
    }


	/**
	 * Creating an openmetrics gauge.
	 *
	 * @param $name string Name of the metric
	 * @param $description string short description for tooltips
	 * @param $value int a numeric value
	 * @return string
	 */
	private static function createGauge($name,$description,$value)
	{
		return
			"# TYPE $name gauge\n".
			"# HELP $name $description\n".
			(is_array($value)?implode("\n",array_map( function($key,$val) use ($name) {
				return "$name{id=\"$key\"} $val";
			},array_keys($value),$value)):"$name $value").
			"\n";

	}
}
