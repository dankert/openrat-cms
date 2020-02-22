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
class DBVersion000014 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
        $this->addColumn('folder','order_by'       ,OR_DB_COLUMN_TYPE_INT,0,null,OR_DB_COLUMN_NULLABLE);
        $this->addColumn('folder','order_direction',OR_DB_COLUMN_TYPE_INT,0,null,OR_DB_COLUMN_NULLABLE);
    }
}

?>