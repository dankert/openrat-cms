<?php


/*
 * Liest einen Schluessel aus der Konfiguration
 *
 * @return String, leer falls Schluessel nicht vorhanden
 */
function config( $part1=null,$part2=null,$part3=null,$part4=null )
{
    global $conf;

    if ( $part1==null )
        return new Config( $conf );

    if	( $part2 == null)
        if	( isset($conf[$part1]))
            return $conf[$part1];
        else
            return '';

    if	( $part3 == null)
        if	( isset($conf[$part1][$part2]))
            return $conf[$part1][$part2];
        else
            return '';

    if	( $part4 == null)
        if	( isset($conf[$part1][$part2][$part3]))
            return $conf[$part1][$part2][$part3];
        else
            return '';

    if	( isset($conf[$part1][$part2][$part3][$part4]))
        return $conf[$part1][$part2][$part3][$part4];
    else
        return '';
}


/**
 * @return Config
 */
function Conf() {

    global $conf;
    return new Config( $conf );

}

class Config
{
    private $config = array();


    /**
     * Config constructor.
     * @param $config
     */
    public function __construct( $config )
    {
        $this->config = $config;
    }


    /**
     * Giving the child configuration with a fluent interface.
     *
     * @param $name
     * @return Config
     */
    public function subset( $name )
    {
        if   ( isset( $this->config[ $name ] ))
            return new Config( $this->config[$name] );
        else
            return new Config( array() );
    }


    public function get( $name, $default = null )
    {
        if   ( isset( $this->config[ $name ] ) )
        {
            $value = $this->config[$name];

            // if default-value is given, the type of the default-value is forced.
            if( !is_null( $default) )
                settype( $value, gettype($default) );
            return $value;
        }
        else
        {
            return $default;
        }
    }


    public function is( $name, $default = false )
    {
        if   ( isset( $this->config[ $name ] ) )
            return (bool) $this->config[$name];
        else
            return $default;
    }


}