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
class DBVersion000006 extends DbVersion
{
	public function update()
	{
		$table = $this->table('user');

		$table->column('password_expires')->type(Column::TYPE_INT)->size(0)->nullable()->add();
		
		$table->column('last_login'      )->type(Column::TYPE_INT)->size(0)->nullable()->add();
		
		$table->column('password_algo'   )->type(Column::TYPE_INT)->size(0)->defaultValue(2)->add();
		
		// Setting Password algo. Passwords beginning with '$' are (old) MD5-hashes. 
		
		// SUBSTR(s,pos,length) is supported by MySql,Postgres,SQLite
		// SUBSTRING(s FROM pos FOR length) is NOT supported by SQLite
		$db    = $this->getDb();
		$updateAlgoStmt = $db->sql('UPDATE '.$table->getSqlName().
				' SET password_algo=1 WHERE SUBSTR(password_hash,1,1) = '."'$'".';'
		);
		$updateAlgoStmt->query();
		
	}
}