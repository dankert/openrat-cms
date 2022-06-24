<?php

namespace configuration;

use util\text\variables\VariableResolver;
use util\YAML;


/**
 * Configuration Loader.
 *
 * Loades the configuration values from a YAML file.
 *
 * @author Jan Dankert
 */
class ConfigurationLoader
{
	public $configFile;


	/**
	 */
	public function __construct($configFile)
	{
		$this->configFile = $configFile;
	}


	/**
	 * Gets the last timestamp from the configuration file.
	 *
	 * @return int timestamp of last change as unix-timestamp
	 */
	public function lastModificationTime()
	{
		return filemtime($this->configFile);
	}


	/**
	 * Loads the custom configuration file.
	 *
	 * @return array Configuration
	 */
	public function load()
	{
		$customConfig = ConfigurationLoader::loadCustomConfig($this->configFile);

		// Den Dateinamen der Konfigurationsdatei in die Konfiguration schreiben.
		$customConfig['config']['filename'] = $this->configFile;
		$customConfig['config']['last_modification_time'] = filemtime($this->configFile);
		$customConfig['config']['last_modification'] = date('r', filemtime($this->configFile));
		$customConfig['config']['read'] = date('r');

		return $customConfig;
	}


	/**
	 * Loads the configuration file and resolves all include-commands.
	 *
	 * @return array Configuration
	 */
	private function loadCustomConfig($configFile)
	{
		if (!is_file($configFile) && !is_link($configFile)) {
			error_log('Warning: Configuration file ' . $configFile . ' not found');
			return array();
		}

		// Parse the YAML config to a hierarchical array
		$customConfig = YAML::parse(file_get_contents($configFile));

		// resolve variables
		$customConfig = self::resolveVariables($customConfig);

		// enrich with environment variables
		$customConfig = self::enrichEnvironmentVariables($customConfig, getenv('CMS_CONFIG_PREFIX')?:'CMS');

		// Does we have includes?
		if (isset($customConfig['include'])) {

			// 'include' must be an array
			if (is_string($customConfig['include']))
				$customConfig['include'] = array($customConfig['include']);

			// Load include files.
			foreach ($customConfig['include'] as $key => $file) {

				if ($file[0] == '/') // File begins with '?'
					; // File has an absolute path - do not change.
				else
					// Prepend file path with our config directory.
					$file = __DIR__ . '/../../config/' . $file;

				if (substr($file, -4) == '.yml' ||
					substr($file, -5) == '.yaml' ||
					substr($file, -8) == '.yml.php')
					$customConfig = array_replace_recursive($customConfig, self::loadCustomConfig($file));
				else
					error_log('Warning: ' . $file . ' is no .yml file - not loaded');

			}
		}

		return $customConfig;
	}

	/**
	 * Evaluates variables in a config array.
	 * Examples:
	 * - config-${http:host}.yml         => config-yourdomain.yml
	 * - config-${server:http-host}.yml  => config-yourdomain.yml
	 * - config-${env:myvar}.yml         => config-myvalue.yml
	 * - config-${env:myxyz?default}.yml => config-default.yml
	 * @param $config array Configuration
	 * @return array
	 */
	private function resolveVariables($config)
	{
		$resolver = new VariableResolver();
		$resolver->namespaceSeparator = ':';
		$resolver->defaultSeparator   = '?';

		$resolver->addResolver('env',function ($var) {
				return getenv(strtoupper($var));
		});

		// http:... is a shortcut for server:http-...
		$resolver->addResolver('http', function ($var) {
				return @$_SERVER['HTTP_' . strtoupper($var)];
		});

		$resolver->addResolver('server',function ($var) {
				return @$_SERVER[strtoupper($var)];
		});

		return $resolver->resolveVariablesInArray($config);
	}



	/**
	 * Walk through an array and search for pleasant environment variables.
	 *
	 * Example input:
	 *
	 *     ['fruits' =>
	 *         [ 'red' => 'apple' ]
	 *     ]
	 *
	 * would search for the environment variable "PREFIX_FRUITS_RED" and,
	 * if present, replaces the value "apple".
	 *
	 * @param $data array data array
	 * @param $prefix string|array prefix
	 * @return array
	 */
	private function enrichEnvironmentVariables($data, $prefix)
	{
		foreach ($data as $key=> $value ) {

			$newKey = array_merge( (array)$prefix,[$key] );

			if   ( is_array($value) ) {
				$value = $this->enrichEnvironmentVariables($value,$newKey ); // recursive call
			} else {
				$environmentKey   = strtoupper( implode('_',$newKey ) );

				// replace with value from environment
				// if present, otherwise leave it untouched
				$value = getenv( $environmentKey ) ?: $value;

				// string-based boolean flags must be converted to real booleans
				if   ( in_array(strtolower($value),['true ','on' ]) )
					$value = true;
				if   ( in_array(strtolower($value),['false','off']) )
					$value = false;
			}

			$data[ $key ] = $value;
		}

		return $data;
	}

}

