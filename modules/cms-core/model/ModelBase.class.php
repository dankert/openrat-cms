<?php
namespace cms\model;

class ModelBase
{
    protected function setDatabaseRow( $row )
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
}
