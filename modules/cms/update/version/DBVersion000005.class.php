<?php

namespace cms\update\version;

use database\DbVersion;

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
		$not_nullable = false;
		$nullable     = true;
		
		// longer Passwords! 50 is not enough.
		$this->addColumn('user','password_hash',OR_DB_COLUMN_TYPE_VARCHAR,255,null,$not_nullable);
		
		$db    = $this->getDb();
		$table = $this->getTableName('user');
		$updateStmt = $db->sql('UPDATE '.$table.
				' SET password_hash=password'
		);
		$updateStmt->query();

		$this->dropColumn('user','password');
		
		$this->addColumn('user','password_salt',OR_DB_COLUMN_TYPE_VARCHAR,255,null,$not_nullable);
	}
}

?>