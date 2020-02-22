<?php

namespace cms\update\version;

use database\DbVersion;

/**
 * Authentication tokens.
 *
 * @author dankert
 *
 */
class DBVersion000021 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
        $this->addTable('auth');

        $this->addColumn('auth','selector'     ,OR_DB_COLUMN_TYPE_VARCHAR ,150 ,null,OR_DB_COLUMN_NOT_NULLABLE);
        $this->addColumn('auth','userid'       ,OR_DB_COLUMN_TYPE_INT  ,0   ,null,OR_DB_COLUMN_NOT_NULLABLE);
        $this->addColumn('auth','token'        ,OR_DB_COLUMN_TYPE_VARCHAR ,150 ,null,OR_DB_COLUMN_NOT_NULLABLE);
        $this->addColumn('auth','token_algo'   ,OR_DB_COLUMN_TYPE_INT  ,0   ,0   ,OR_DB_COLUMN_NOT_NULLABLE);
        $this->addColumn('auth','expires'      ,OR_DB_COLUMN_TYPE_INT  ,0   ,null,OR_DB_COLUMN_NOT_NULLABLE);
        $this->addColumn('auth','create_date'  ,OR_DB_COLUMN_TYPE_INT  ,0   ,null,OR_DB_COLUMN_NOT_NULLABLE);
        $this->addColumn('auth','platform'     ,OR_DB_COLUMN_TYPE_VARCHAR,255 ,null,OR_DB_COLUMN_NOT_NULLABLE);
        $this->addColumn('auth','name'         ,OR_DB_COLUMN_TYPE_VARCHAR,255 ,null,OR_DB_COLUMN_NOT_NULLABLE);


        $this->addPrimaryKey ('auth','id');

        $this->addConstraint ('auth','userid'     ,'user'  ,'id');

        $this->addUniqueIndex('auth','selector' );
    }
}

