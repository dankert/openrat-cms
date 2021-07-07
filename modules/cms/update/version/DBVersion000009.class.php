<?php


namespace cms\update\version;

use cms\model\BaseObject;
use database\DbVersion;
use database\Column;
use security\Password;

/**
 * New Object type 'url'.
 *
 * In this Version 9 we are creating a table 'url' and are copying
 * the selected entries from table 'link' to 'url'.
 * 
 * @author dankert
 *
 */
class DBVersion000009 extends DbVersion
{
    /**
     *
     */
    public function update()
	{
		// Creating new table 'url'
        $table = $this->table('url')->add();
        $table->column('objectid')->type(Column::TYPE_INT)->size(0)->add();
        $table->column('url')->type(Column::TYPE_VARCHAR)->size(255)->add();

        $table->addPrimaryKey();
        $table->addConstraint('objectid', 'object');

        $table->addUniqueIndex('objectid');

        // Copying values from table 'link' to new table 'url'
        $db    = $this->getDb();

        $insertStmt = $db->sql('INSERT INTO '.$table->getSqlName().
            ' (id,objectid,url) SELECT id,objectid,url FROM '.$this->table('link')->getSqlName().' WHERE url is not null'
        );
        $insertStmt->execute();

        // Updating the typeid for URL entrys in table 'object'
        $updateStmt = $db->sql('UPDATE '.$this->table('object')->getSqlName().
            ' SET typeid='.BaseObject::TYPEID_URL.' WHERE id IN (SELECT objectid FROM '.$this->table('url')->getSqlName().')'
        );
        $updateStmt->execute();

        $tableLink = $this->table('link');
        // Remove old entrys in table 'link'
        $updateStmt = $db->sql('DELETE FROM '.$tableLink->getSqlName().' WHERE url is not null'
        );
        $updateStmt->execute();

        // Cleanup: Drop unused column.
		$tableLink->column('url')->drop();
	}
}