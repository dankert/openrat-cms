<?php
namespace cms\model;

abstract class ModelBase
{
    /*
    protected function setDatabaseRow( $row )
    {
        
    }
    */

    public function __construct()
    {
    }

    /**
     * All public properties of this object.
     * @return array
     */
    public function getProperties()
    {
        return get_object_vars( $this );
    }

    public abstract function getName();
}
