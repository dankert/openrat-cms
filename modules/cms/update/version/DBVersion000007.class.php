<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;
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
		$table = $this->table('user');
		$table->column('otp_secret'  )->type(Column::TYPE_VARCHAR)->size(255)->nullable()->add();

		$tableName = $table->getSqlName();
		$db    = $this->getDb();
		$stmt  = $db->sql('SELECT id FROM '.$tableName);
		foreach($stmt->getCol() as $userid )
		{
			$secret = Password::randomHexString(64);
			$stmt = $db->sql('UPDATE '.$tableName.' SET otp_secret={secret} WHERE id={id}');
			$stmt->setString('secret',$secret);
			$stmt->setInt('id',$userid);
			$stmt->execute();
		}
		
		$table->column('totp'        )->type(Column::TYPE_INT    )->size(  1)->defaultValue(   0)->add();
		$table->column('hotp_counter')->type(Column::TYPE_INT    )->size(  0)->defaultValue(   0)->add();
		$table->column('hotp'        )->type(Column::TYPE_INT    )->size(  1)->defaultValue(   0)->add();
		
	}
}