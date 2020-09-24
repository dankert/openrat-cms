<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;

/**
 * Add Columns for user language and user timezone.
 * 
 * @author dankert
 *
 */
class DBVersion000004 extends DbVersion
{
	public function update()
	{
		// Add user language
		$table = $this->table('user');

		$table->column('language')->type(Column::TYPE_VARCHAR)->size( 2)->nullable()->add();
		
		// Add user timezone
		$table->column('timezone')->type(Column::TYPE_VARCHAR)->size(64)->nullable()->add();
		
	}
}
