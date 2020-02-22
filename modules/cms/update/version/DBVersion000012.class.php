<?php

namespace cms\update\version;

use database\DbVersion;
use security\Password;

/**
 * Objects gets new columns for storing the publish date.
 *
 * @author dankert
 *
 */
class DBVersion000012 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
        $this->addColumn('object','published_date'  ,OR_DB_COLUMN_TYPE_INT,0,null,OR_DB_COLUMN_NULLABLE);
        $this->addColumn('object','published_userid',OR_DB_COLUMN_TYPE_INT,0,null,OR_DB_COLUMN_NULLABLE);
        $this->addConstraint('object','published_userid','user','id');
    }
}

?>