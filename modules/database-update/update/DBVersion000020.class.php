<?php

use database\DbVersion;

/**
 * Aliases for node objects.
 *
 * @author dankert
 *
 */
class DBVersion000020 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
        $this->addTable('alias');

        $this->addColumn('alias','objectid'     ,OR_DB_COLUMN_TYPE_INT,null,null,OR_DB_COLUMN_NOT_NULLABLE);
        $this->addColumn('alias','languageid'   ,OR_DB_COLUMN_TYPE_INT,null,null,OR_DB_COLUMN_NULLABLE);
        $this->addColumn('alias','link_objectid',OR_DB_COLUMN_TYPE_INT,null,null,OR_DB_COLUMN_NOT_NULLABLE);


        $this->addPrimaryKey ('alias','id');

        $this->addConstraint ('alias','objectid'     ,'object'  ,'id');
        $this->addConstraint ('alias','languageid'   ,'language','id');
        $this->addConstraint ('alias','link_objectid','object'  ,'id');

        $this->addUniqueIndex('alias','objectid'                );
        $this->addUniqueIndex('alias','link_objectid,languageid');
        $this->addIndex      ('alias','link_objectid'           );

    }
}

