<?php

use database\DbVersion;
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
        $this->addColumn('value','format'  ,OR_DB_COLUMN_TYPE_INT,1,0,OR_DB_COLUMN_NOT_NULLABLE);

        // Initial Value: Copy from element.
        $tableValue   = $this->getTableName('value');
        $tableElement = $this->getTableName('element');

        $updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableValue
   SET format=(select format from $tableElement where $tableValue.elementid=$tableElement.id)
SQL
        );
        $updateStmt->query();
    }
}

