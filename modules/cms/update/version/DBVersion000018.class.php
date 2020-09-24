<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;
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
    	$table = $this->table('element');
        $table->column('label'  )->type(Column::TYPE_VARCHAR)->size(100)->defaultValue('')->add();

        // Initial Value for Labels is the element name.
        $tableElement = $table->getSqlName();

        $updateStmt = $this->getDb()->sql(<<<SQL
UPDATE $tableElement
   SET label=name
SQL
        );
        $updateStmt->query();

        $table->addUniqueIndex(['templateid','label']);
    }
}

