<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;

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
        $table = $this->table('auth')->add();

        $table->column('selector'     )->type(Column::TYPE_VARCHAR )->size(150 )->add();
        $table->column('userid'       )->type(Column::TYPE_INT  )->add();
        $table->column('token'        )->type(Column::TYPE_VARCHAR )->size(150 )->add();
        $table->column('token_algo'   )->type(Column::TYPE_INT  )->defaultValue(0   )->add();
        $table->column('expires'      )->type(Column::TYPE_INT  )->add();
        $table->column('create_date'  )->type(Column::TYPE_INT  )->add();
        $table->column('platform'     )->type(Column::TYPE_VARCHAR)->add();
        $table->column('name'         )->type(Column::TYPE_VARCHAR)->add();


        $table->addPrimaryKey ();

        $table->addConstraint ('userid', 'user');

        $table->addUniqueIndex('selector');
    }
}

