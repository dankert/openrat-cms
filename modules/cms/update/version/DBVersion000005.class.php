<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;

/**
 * Security enhancements.
 * 
 * @author dankert
 *
 */
class DBVersion000005 extends DbVersion
{
	public function update()
	{
		$table = $this->table('user');

		// longer Passwords! 50 is not enough.
		$table->column('password_hash')->type(Column::TYPE_VARCHAR)->size(255)->add();
		
		$db    = $this->getDb();
		$updateStmt = $db->sql('UPDATE '.$table->getSqlName().
				' SET password_hash=password'
		);
		$updateStmt->query();

		$table->column('password')->drop();
		
		$table->column('password_salt')->type(Column::TYPE_VARCHAR)->size(255)->add();
	}
}