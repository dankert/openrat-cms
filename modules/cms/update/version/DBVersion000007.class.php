<?php

namespace cms\update\version;

use database\DbVersion;
use security\Password;

/**
 * Security enhancements.
 * 
 * @author dankert
 *
 */
class DBVersion000007 extends DbVersion
{
	public function update()
	{
		$not_nullable = false;
		$nullable     = true;
		
		$this->addColumn('user','otp_secret'  ,OR_DB_COLUMN_TYPE_VARCHAR,255,null,$nullable    );

		$table = $this->getTableName('user');
		$db    = $this->getDb();
		$stmt  = $db->sql('SELECT id FROM '.$table);
		foreach($stmt->getCol() as $userid )
		{
			$secret = Password::randomHexString(64);
			$stmt = $db->sql('UPDATE '.$table.' SET otp_secret={secret} WHERE id={id}');
			$stmt->setString('secret',$secret);
			$stmt->setInt('id',$userid);
			$stmt->query();
		}
		
		$this->addColumn('user','totp'        ,OR_DB_COLUMN_TYPE_INT    ,  1,   0,$not_nullable);
		$this->addColumn('user','hotp_counter',OR_DB_COLUMN_TYPE_INT    ,  0,   0,$not_nullable);
		$this->addColumn('user','hotp'        ,OR_DB_COLUMN_TYPE_INT    ,  1,   0,$not_nullable);
		
	}
}

?>