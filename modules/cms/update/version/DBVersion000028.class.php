<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;
use security\Password;

/**
 * The permission flags are now stored in 1 bitmask-column.
 *
 * @author dankert
 *
 */
class DBVersion000028 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
    	$table = $this->table('acl');
    	$table->addIndex( ['type'] );

        $table->column('flags'  )->type(Column::TYPE_INT)->defaultValue(1)->add();

        // Initial Value: Copy from element.
        $tableSqlName = $table->getSqlName();

        $updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableSqlName
   SET flags=1;
SQL
        );
        $updateStmt->execute();

        $updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableSqlName
   SET flags=flags+2 WHERE is_write=1;
SQL
        );
        $updateStmt->execute();

        $updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableSqlName
   SET flags=flags+4 WHERE is_prop=1;
SQL
        );
        $updateStmt->execute();

        $updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableSqlName
   SET flags=flags+64 WHERE is_create_folder=1;
SQL
        );
        $updateStmt->execute();

        $updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableSqlName
   SET flags=flags+128 WHERE is_create_file=1;
SQL
        );
        $updateStmt->execute();

        $updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableSqlName
   SET flags=flags+256 WHERE is_create_link=1;
SQL
        );
        $updateStmt->execute();

        $updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableSqlName
   SET flags=flags+512 WHERE is_create_page=1;
SQL
        );
        $updateStmt->execute();

        $updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableSqlName
   SET flags=flags+8 WHERE is_delete=1;
SQL
        );
        $updateStmt->execute();

        $updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableSqlName
   SET flags=flags+16 WHERE is_release=1;
SQL
        );
        $updateStmt->execute();

        $updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableSqlName
   SET flags=flags+32 WHERE is_publish=1;
SQL
        );
        $updateStmt->execute();

        $updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableSqlName
   SET flags=flags+1024 WHERE is_grant=1;
SQL
        );
        $updateStmt->execute();

        $updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableSqlName
   SET flags=flags+2048 WHERE is_transmit=1;
SQL
        );
        $updateStmt->execute();

		$table->column('is_write'        )->drop();
		$table->column('is_prop'         )->drop();
		$table->column('is_create_folder')->drop();
		$table->column('is_create_file'  )->drop();
		$table->column('is_create_page'  )->drop();
		$table->column('is_create_link'  )->drop();
		$table->column('is_delete'       )->drop();
		$table->column('is_release'      )->drop();
		$table->column('is_publish'      )->drop();
		$table->column('is_grant'        )->drop();
		$table->column('is_transmit'     )->drop();
	}
}

