<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;

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
        $table = $this->table('alias')->add();

        $table->column('objectid'     )->type(Column::TYPE_INT)->add();
        $table->column('languageid'   )->type(Column::TYPE_INT)->nullable()->add();
        $table->column('link_objectid')->type(Column::TYPE_INT)->add();


        $table->addPrimaryKey ('id');

        $table->addConstraint ('objectid'     ,'object'  ,'id');
        $table->addConstraint ('languageid'   ,'language','id');
        $table->addConstraint ('link_objectid','object'  ,'id');

        $table->addUniqueIndex('objectid');
        $table->addUniqueIndex(['link_objectid','languageid']);
        $table->addIndex      ('link_objectid');
    }
}

