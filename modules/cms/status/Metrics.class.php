<?php

namespace cms\status;


use cms\base\Startup;
use configuration\Config;
use configuration\ConfigurationLoader;
use database\Database;
use util\cache\FileCache;
use util\FileUtils;
use util\Http;

/**
 * Create metrics for Prometheus/OpenMetrics.
 */
class Metrics
{
	private static $metrics = [];

	/**
	 * prefix for all metrics.
	 */
	const METRIC_PREFIX = 'cms';

	/**
     * Creating the metrics
     */
    public static function execute()
    {
		// get interpreter metrics
		self::addGauge('interpreter_version','version of PHP Interpreter',PHP_VERSION_ID     ,['type'=>'all'    ]);
		self::addGauge('interpreter_version','version of PHP Interpreter',PHP_MAJOR_VERSION  ,['type'=>'major'  ]);
		self::addGauge('interpreter_version','version of PHP Interpreter',PHP_MINOR_VERSION  ,['type'=>'minor'  ]);
		self::addGauge('interpreter_version','version of PHP Interpreter',PHP_RELEASE_VERSION,['type'=>'release']);

		// get system metrics
		foreach( getrusage() as $item=>$value )
			self::addGauge('resource_usage','current resource usage',$value,['usage'=>$item] );

		# get memory metrics
		self::addGauge('memory','amount of memory, in bytes, thats currently being allocated', memory_get_usage(true),['usage'=>'allocated']);
		self::addGauge('memory','amount of memory, in bytes, thats currently being allocated', memory_get_usage()              ,['usage'=>'used']     );
		self::addGauge('memory_peak','peak of memory, thats been allocated', memory_get_peak_usage(true),['usage'=>'allocated'] );
		self::addGauge('memory_peak','peak of memory, thats been allocated', memory_get_peak_usage()              ,['usage'=>'used'     ] );

		# get load
		if   (function_exists('sys_getloadavg')) {
			if   ( $load = sys_getloadavg() ) {
				self::addGauge('load','load average',$load[0] ,['minutes'=>'1']);
				self::addGauge('load','load average',$load[1] ,['minutes'=>'5']);
				self::addGauge('load','load average',$load[2] ,['minutes'=>'15']);
			}
		}
		// get metrics from databases
		$config = new Config( self::getConfiguration() );
		foreach( $config->subset('database')->subsets() as $dbName => $dbConfig ) {

			if ($dbConfig->is('enabled', true)) {

				try {
					$db = new Database($dbConfig->subset('read')->getConfig() + $dbConfig->getConfig());
					$dbLabel = ['db'=>$dbName];
					$sql = $db->sql( 'SELECT COUNT(*) FROM {{object}}' );
					self::addGauge('db_objects','count of all nodes', $sql->getOne(),$dbLabel );

					$sql = $db->sql( 'SELECT COUNT(*) FROM {{value}}' );
					self::addGauge('db_values','count of all values', $sql->getOne(),$dbLabel );

					$sql = $db->sql( 'SELECT COUNT(*) FROM {{user}}' );
					self::addGauge('db_users','count of all users', $sql->getOne(),$dbLabel );

					$sql = $db->sql( 'SELECT COUNT(*) FROM {{group}}' );
					self::addGauge('db_groups','count of all groups', $sql->getOne(),$dbLabel );

					$sql = $db->sql( 'SELECT COUNT(*) FROM {{acl}}' );
					self::addGauge('db_acl','count of all rights', $sql->getOne(),$dbLabel );

					$sql = $db->sql( 'SELECT SUM(size) FROM {{file}}');
					self::addGauge('db_blob_size','size of all files', $sql->getOne(),$dbLabel );

					$db->disconnect();

				} catch (\Exception $e) {
					echo '# Error: '.$e->getMessage()."\n";
				}

			}

		}

		// Get metrics for cache dir
		$cacheDir = FileUtils::getTempDir();

		if   ( $files = scandir($cacheDir) )
		{
			$count = 0;
			$size = 0;
			foreach ( $files as $file ) {
				if ( substr($file,0,strlen(FileCache::CACHE_FILENAME_PREFIX))==FileCache::CACHE_FILENAME_PREFIX ) {
					$count ++;
					$size += filesize($cacheDir.'/'.$file);
				}
			}

			self::addGauge('cache_files','Files in cache dir',$count);
			self::addGauge('cache_bytes','Sum file size in cache dir',$size);
		}

		// if client accepts OpenMetrics format, we will serve it.
		if   ( in_array('application/openmetrics-text',Http::getAccept() ) )
			header('Content-Type: application/openmetrics-text; version=1.0.0; charset=UTF-8');
		else
			header('Content-Type: text/plain; charset=UTF-8');

		$output = self::renderMetrics();

        if (!headers_sent()) {
            // HTTP Spec:
            // "Applications SHOULD use this field to indicate the transfer-length of the
        	//  message-body, unless this is prohibited by the rules in section 4.4."
            //
            // And the overhead of 'Transfer-Encoding: chunked' is eliminated...
			header('HTTP/1.0 200 OK' );
            header('Content-Length: ' . strlen($output));
		}

		echo $output;
    }


	/**
	 * Creating an openmetrics gauge.
	 *
	 * @param $name string Name of the metric
	 * @param $description string short description for tooltips
	 * @param $value int a numeric value
	 */
	private static function addGauge($name, $description, $value, $label=[])
	{
		if   ( ! array_key_exists($name,self::$metrics) ) {
			self::$metrics[$name] = ['name'=>$name,'description'=>$description,'values'=>[]];
		}
		self::$metrics[$name]['values'][] = ['labels'=>$label,'value'=>$value];
	}

	/**
	 * Creating an openmetrics gauge.
	 *
	 * @param $name string Name of the metric
	 * @param $description string short description for tooltips
	 * @param $value int a numeric value
	 * @return string
	 */
	private static function renderMetrics()
	{
		$output = '';
		foreach ( self::$metrics as $name => $metric ) {
			$metricName = '' . self::METRIC_PREFIX . '_' .$name; // prefix all metrics because they are app related.

			$output .= "# TYPE ".$metricName." gauge\n";
			$output .= "# HELP ".$metricName." ".$metric['description']."\n";
			foreach ( $metric['values'] as $value ) {
				$output .= $metricName;
				if   ($value['labels']) {
					$output .= "{";
					$output .= implode(',',array_map( function($key,$val) {
						return $key."=\"".$val."\"";
					},array_keys($value['labels']),$value['labels']));
					$output .= "}";
				}
				$output .= ' '.$value['value']."\n";

			}


		}
		return $output;

	}

	private static function getConfiguration() {
		$configFile = getenv( 'CMS_CONFIG_FILE' );
		if   ( ! $configFile )
			$configFile = Startup::DEFAULT_CONFIG_FILE;

		$configLoader = new ConfigurationLoader( $configFile );
		return  $configLoader->load();
	}
}
