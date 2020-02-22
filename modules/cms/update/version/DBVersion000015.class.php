<?php

namespace cms\update\version;

use database\DbVersion;
use security\Password;

/**
 * Local settings for every object.
 *
 * @author dankert
 *
 */
class DBVersion000015 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
        $this->addColumn('object','settings',OR_DB_COLUMN_TYPE_TEXT,0,null,OR_DB_COLUMN_NOT_NULLABLE);
   }
}

?>