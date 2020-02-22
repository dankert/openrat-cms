<?php

namespace cms\update\version;

use database\DbVersion;
use security\Password;

/**
 * Objects gets new columns for storing valid-dates.
 *
 * @author dankert
 *
 */
class DBVersion000017 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
        $this->addColumn('object','valid_from',OR_DB_COLUMN_TYPE_INT,0,null,OR_DB_COLUMN_NULLABLE);
        $this->addColumn('object','valid_to'  ,OR_DB_COLUMN_TYPE_INT,0,null,OR_DB_COLUMN_NULLABLE);
    }
}

