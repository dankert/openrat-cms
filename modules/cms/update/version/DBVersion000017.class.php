<?php

namespace cms\update\version;

use database\Column;
use database\DbVersion;

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

    	$table = $this->table('object');
        $table->column('valid_from')->type(Column::TYPE_INT)->nullable()->add();
        $table->column('valid_to'  )->type(Column::TYPE_INT)->nullable()->add();
    }
}

