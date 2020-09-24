<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;
use security\Password;

/**
 * Objects gets new columns for storing the sort order.
 *
 * @author dankert
 *
 */
class DBVersion000014 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
    	$table = $this->table('folder');
        $table->column('order_by'       )->type(Column::TYPE_INT)->size(0)->nullable()->add();
        $table->column('order_direction')->type(Column::TYPE_INT)->size(0)->nullable()->add();
    }
}

?>