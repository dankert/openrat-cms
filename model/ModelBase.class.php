<?php
namespace cms\model;

class ModelBase
{
    protected function setDatabaseRow( $row )
    {
        
    }
    
    public function getProperties()
    {
        return get_object_vars( $this );
    }
}

?>