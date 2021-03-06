<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;
use security\Password;

/**
 * The format of a value is stored in the value table, so users can change the format of a value, independent of the element.
 *
 * @author dankert
 *
 */
class DBVersion000019 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
    	$table = $this->table('value');
        $table->column('format'  )->type(Column::TYPE_INT)->size(1)->defaultValue(0)->add();

        // Initial Value: Copy from element.
        $tableValue   = $this->table('value')->getSqlName();
        $tableElement = $this->table('element')->getSqlName();

        $updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableValue
   SET format=(select format from $tableElement where $tableValue.elementid=$tableElement.id)
SQL
        );
        $updateStmt->execute();
    }
}

