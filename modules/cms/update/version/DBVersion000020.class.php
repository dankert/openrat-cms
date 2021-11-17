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


        $table->addPrimaryKey ();

        $table->addConstraint ('objectid', 'object');
        $table->addConstraint ('languageid', 'language');
        $table->addConstraint ('link_objectid', 'object');

        $table->addUniqueIndex('objectid');
        $table->addUniqueIndex(['link_objectid','languageid']);
        $table->addIndex      ('link_objectid');
    }
}

