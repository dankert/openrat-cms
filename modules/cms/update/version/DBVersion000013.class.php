<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;
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
    	$table = $this->table('file');
        $table->column('filterid'  )->type(Column::TYPE_INT)->size(0)->nullable()->add();
    }
}