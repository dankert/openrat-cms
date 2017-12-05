<?php
use database\DbVersion;

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
		$not_nullable = false;
		$nullable     = true;
		
		$this->addColumn('user','password_expires','INT',0,null,$nullable);
		
		$this->addColumn('user','last_login'      ,'INT',0,null,$nullable);
		
		$this->addColumn('user','password_algo'   ,'INT',0,2,$not_nullable);
		
		// Setting Password algo. Passwords beginning with '$' are (old) MD5-hashes. 
		
		// SUBSTR(s,pos,length) is supported by MySql,Postgres,SQLite
		// SUBSTRING(s FROM pos FOR length) is NOT supported by SQLite
		$table = $this->getTableName('user');
		$db    = $this->getDb();
		$updateAlgoStmt = $db->sql('UPDATE '.$table.
				' SET password_algo=1 WHERE SUBSTR(password_hash,1,1) = '."'$'".';'
		);
		$updateAlgoStmt->query();
		
	}
}

?>