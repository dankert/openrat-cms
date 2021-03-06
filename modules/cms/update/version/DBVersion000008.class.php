<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;
use security\Password;

/**
 * Creates a type column in table OBJECT. Now added types have no need for new table columns.
 * 
 * @author dankert
 *
 */
class DBVersion000008 extends DbVersion
{
    /**
     *
     */
    public function update()
	{
		$table = $this->table('object');

		$table->column('typeid')->type(Column::TYPE_INT)->size(2)->defaultValue(0)->add();
        $table->addIndex('typeid');

        // Converting old values...
        $db    = $this->getDb();
        $tableName = $table->getSqlName();

        $updateStmt = $db->sql('UPDATE '.$tableName.
            ' SET typeid=1 WHERE is_folder=1'
        );
        $updateStmt->execute();

        $updateStmt = $db->sql('UPDATE '.$tableName.
            ' SET typeid=2 WHERE is_file=1'
        );
        $updateStmt->execute();

        $updateStmt = $db->sql('UPDATE '.$tableName.
            ' SET typeid=3 WHERE is_page=1'
        );
        $updateStmt->execute();

        $updateStmt = $db->sql('UPDATE '.$tableName.
            ' SET typeid=4 WHERE is_link=1'
        );
        $updateStmt->execute();

		$table->column('is_folder')->drop();
		$table->column('is_file'  )->drop();
		$table->column('is_page'  )->drop();
		$table->column('is_link'  )->drop();
	}
}