<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;

/**
 * Objects gets new columns for storing the publish date.
 *
 * @author dankert
 *
 */
class DBVersion000012 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
    	$table = $this->table('object');
        $table->column('published_date'  )->type(Column::TYPE_INT)->size(0)->nullable()->add();
        $table->column('published_userid')->type(Column::TYPE_INT)->size(0)->nullable()->add();
        $table->addConstraint('published_userid', 'user');
    }
}