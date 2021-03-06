<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;
use security\Password;

/**
 * The type of a permission is stored in a new column.
 *
 * @author dankert
 *
 */
class DBVersion000027 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
    	$table = $this->table('acl');
        $table->column('type'  )->type(Column::TYPE_INT)->size(1)->defaultValue(3)->add();

        // Initial Value: Copy from element.
        $tableSqlName = $table->getSqlName();

        $updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableSqlName
   SET type=3;
SQL
        );
        $updateStmt->query();

		$updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableSqlName
   SET type=2 where groupid is not null;
SQL
		);
		$updateStmt->query();

		$updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableSqlName
   SET type=1 where userid is not null;
SQL
		);
		$updateStmt->query();
	}
}

