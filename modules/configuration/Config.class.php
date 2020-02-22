<?php

namespace configuration;

class Config
{
    private $config = array();


    /**
     * Config constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }


    /**
     * Giving the child configuration with a fluent interface.
     *
     * @param $name
     * @return Config
     */
    public function subset($name)
    {
        if (isset($this->config[$name]))
            return new Config($this->config[$name]);
        else
            return new Config(array());
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
        if (isset($this->config[$name])) {
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
        return isset($this->config[$name]);
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
            return (bool)$this->config[$name];
        else
            return $default;
    }


    /**
     * The configuration entries as an array.
     *
     * @return array
     */
    public function getConfig()
    {

        return $this->config;
    }


}