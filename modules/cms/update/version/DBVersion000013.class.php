<?php

namespace cms\update\version;

use database\DbVersion;
use security\Password;

/**
 * Textfiles should able to be filtered.
 *
 * @author dankert
 *
 */
class DBVersion000013 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
        $this->addColumn('file','filterid'  ,OR_DB_COLUMN_TYPE_INT,0,null,OR_DB_COLUMN_NULLABLE);
    }
}

?>