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
 * @package openrat.util
 */
class ConfigurationLoader
{
	public $configFile;


	/*
	 * Erzeugt eine neue Instanz.
	 */
	public function __construct($configFile)
	{
		$this->configFile = $configFile;
	}


	/**
	 * Ermittelt den Zeitpunkt der letzten Änderung der Konfigurationsdatei.
	 *
	 * @return int Zeitpunkt der letzten Änderung als Unix-Timestamp
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
	 * - config-${http:host}.yml        => config-yourdomain.yml
	 * - config-${server:http-host}.yml => config-yourdomain.yml
	 * - config-${env:myvar}.yml        => config-myvalue.yml
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
	 * Test for environment variables.
	 * @param $prefix string|array prefix
	 * @return array
	 */
	private function enrichEnvironmentVariables($config, $prefix)
	{
		foreach ( $config as $key=>$value ) {
			$newKey = array_merge( (array)$prefix,[$key] );
			if   ( is_array($value) ) {
				$value = $this->enrichEnvironmentVariables($value,$newKey );
			} else {
				$envKey = strtoupper( implode('_',$newKey ) );
				//error_log( "get env ".$envKey );
				$value = getenv( $envKey ) ?: $value;
				if   ( in_array(strtolower($value),['true ','on' ]) )
					$value = true;
				if   ( in_array(strtolower($value),['false','off']) )
					$value = false;
			}
			$config[$key] = $value;
		}
		return $config;
	}

}

