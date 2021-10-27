<?php

namespace configuration;

/**
 * Reading configuration values.
 */
class Config
{
	/**
	 * The actual configuraton values.
	 * @var array
	 */
    private $config;


    /**
     * Config constructor.
     * @param array $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }


	/**
	 * Returns a list of all subsets.
	 *
	 * @return Config[] subsets
	 */
    public function subsets() {

    	return array_map( function( $value ) {
			if (is_array($value))
				return new Config($value);
			else
				return new Config(array());
		}, array_filter($this->config, function($value) {
			// All non-arrays are removed.
			return is_array($value);
		}) );

	}


	/**
     * Giving the child configuration with a fluent interface.
     *
     * @param $names string|array
     * @return Config
     */
    public function subset($names)
    {
    	if   ( !is_array($names) )
    		$names = [$names];

    	$config = $this->config;
    	foreach($names as $key )
			if (isset($config[$key]) && is_array($config[$key]))
	    		$config = $config[$key];
			else
				return new Config( [] );

        return new Config( $config );
    }


	/**
	 * Gets the configuration value in seconds for this key.
	 *
	 * @param $name
	 * @param null $default
	 * @return int
	 */
    public function getSeconds( $name, $default = 0 ) {
    	return $this->parseSuffix( $this->get( $name, (string)$default ),[
    		's' => 1,            // seconds
    		'm' => 60,           // minutes
    		'h' => 60*60,        // hours
    		'd' => 60*60*24,     // days
    		'y' => 60*60*24*365, // years
		] );
	}

	/**
	 * Gets the configuration value in bytes for this key.
	 *
	 * @param $name
	 * @param null $default
	 * @return int
	 */
    public function getBytes( $name, $default = 0 ) {
    	return $this->parseSuffix( $this->get( $name, (string)$default ),[
			'b' => 1,                        // bytes
			'k' => 1024,                     // kibibyte
			'm' => 1024*1024,                // mibibyte
			'g' => 1024*1024*1024,           // gibibyte
			't' => 1024*1024*1024*1024,      // tebibyte
			'p' => 1024*1024*1024*1024*1024, // pebibyte
			// exabyte, zettabyte, yottabyte, google, buuum...
		] );
	}

    /**
     * Gets the configuration value for this key.
     *
     * @param $name
     * @param null $default
     * @return mixed|null
     */
    public function get($name, $default = null)
    {
        if (isset($this->config[$name]) && !empty($this->config[$name])) {
            $value = $this->config[$name];

            // if default-value is given, the type of the default-value is forced.
            if (!is_null($default))
                settype($value, gettype($default));
            return $value;
        } else {
            return $default;
        }
    }


    /**
     * Is the Config key present?
     *
     * @param $name
     * @return bool
     */
    public function has($name)
    {
        return isset($this->config[$name]) && !empty($this->config[$name]);
    }


    /**
     * Is the boolean Value true?
     *
     * @param $name
     * @param bool $default false
     * @return bool
     */
    public function is($name, $default = false)
    {
        if (isset($this->config[$name]))
        	// This filter accepts 'true' and 'yes' for true and 'false' and 'no' for false.
            return filter_var( $this->config[$name],FILTER_VALIDATE_BOOLEAN );
        else
            return (bool) $default;
    }


    /**
     * Gets the underlying configuration settings as a bare array.
     *
     * @return array
     */
    public function getConfig()
    {

        return $this->config;
    }


	/**
	 * Merges another Configuration
	 * @param $otherConfig Config
	 */
    public function merge( $otherConfig ) {
    	$this->config = array_merge( $this->config, $otherConfig->config );
    	return $this;
	}

	public function isEmpty()
	{
		return (boolean) $this->config;
	}

	public function hasContent()
	{
		return !$this->isEmpty();
	}

	private function parseSuffix( $value, $map)
	{
		$suffix = substr($value,-1,1);
		$value  = substr($value,1);
		if   ( isset($map[$suffix] ) )
			return $value * $map[$suffix];
		else
			return (int) $value;
	}
}