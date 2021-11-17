<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;

/**
 * new table: version.
 *
 * @author dankert
 *
 */
class DBVersion000002 extends DbVersion
{
	public function update()
	{
		$table = $this->table('version')->add();

		$table->column('version'  )->type(Column::TYPE_INT)->add();
		$table->column('status'   )->type(Column::TYPE_INT)->add();
		$table->column('installed')->type(Column::TYPE_INT)->add();
		
		$table->addPrimaryKey ();
		$table->addIndex      ('status');
		$table->addUniqueIndex('version');
	}
}
