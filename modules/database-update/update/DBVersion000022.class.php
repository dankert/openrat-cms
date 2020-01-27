<?php

use database\DbVersion;

/**
 * Macros.
 *
 * @author dankert
 *
 */
class DBVersion000022 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
        $this->addTable('macro');

        $this->addColumn('macro','objectid'     ,OR_DB_COLUMN_TYPE_INT ,null,null,OR_DB_COLUMN_NOT_NULLABLE);
        $this->addColumn('alias','name'         ,OR_DB_COLUMN_TYPE_TEXT,150 ,null,OR_DB_COLUMN_NOT_NULLABLE);
        $this->addColumn('alias','link_objectid',OR_DB_COLUMN_TYPE_INT ,null,null,OR_DB_COLUMN_NOT_NULLABLE);


        $this->addPrimaryKey ('macro','id');

        $this->addConstraint ('macro','objectid'     ,'object'  ,'id');

        $this->addUniqueIndex('macro','objectid'                );
    }
}

