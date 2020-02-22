<?php

namespace cms\update\version;

use database\DbVersion;
use security\Password;

/**
 * Elements should have a name and a separate label.
 *
 * @author dankert
 *
 */
class DBVersion000018 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
        $this->addColumn('element','label'  ,OR_DB_COLUMN_TYPE_VARCHAR,100,'',OR_DB_COLUMN_NOT_NULLABLE);

        // Initial Value for Labels is the element name.
        $tableElement = $this->getTableName('element');

        $updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableElement
   SET label=name
SQL
        );
        $updateStmt->query();

        $this->addUniqueIndex('element','templateid,label');
    }
}

