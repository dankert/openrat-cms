<?php
namespace cms\model;

abstract class ModelBase
{
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

    public abstract function load();

    public abstract function delete();

    public abstract function getId();
}
