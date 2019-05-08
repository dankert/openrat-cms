<?php
use database\DbVersion;
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
		$not_nullable = false;
		$nullable     = true;

		// Creating new table 'url'
        $this->addTable('url');
        $this->addColumn('url','objectid',OR_DB_COLUMN_TYPE_INT,0,null,$not_nullable);
        $this->addColumn('url','url',OR_DB_COLUMN_TYPE_VARCHAR,255,null,$not_nullable);

        $this->addPrimaryKey('url','id');
        $this->addConstraint('url','objectid','object','id');

        $this->addUniqueIndex('url','objectid');

        // Copying values from table 'link' to new table 'url'
        $db    = $this->getDb();

        $insertStmt = $db->sql('INSERT INTO '.$this->getTableName('url').
            ' (id,objectid,url) SELECT id,objectid,url FROM '.$this->getTableName('link').' WHERE url is not null'
        );
        $insertStmt->query();

        // Updating the typeid for URL entrys in table 'object'
        $updateStmt = $db->sql('UPDATE '.$this->getTableName('object').
            ' SET typeid='.BaseObject::TYPEID_URL.' WHERE id IN (SELECT objectid FROM '.$this->getTableName('url').')'
        );
        $updateStmt->query();

        // Remove old entrys in table 'link'
        $updateStmt = $db->sql('DELETE FROM '.$this->getTableName('link').' WHERE url is not null'
        );
        $updateStmt->query();

        // Cleanup: Drop unused column.
        $this->dropColumn('link','url');
	}
}

?>