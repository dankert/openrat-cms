<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;

/**
 * Groups my contain subgroups.
 *
 * @author Jan Dankert
 *
 */
class DBVersion000024 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
		$groupTable = $this->table('group');
		$groupTable->column('parentid')->type(Column::TYPE_INT )->nullable()->add();
		$groupTable->addIndex('parentid');
		$groupTable->addConstraint('parentid', 'group');
	}
}