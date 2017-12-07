<?php
use database\DbVersion;
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
		$not_nullable = false;
		$nullable     = true;

        $this->addColumn('object','typeid','INT',2,0,$not_nullable);
        $this->addIndex('object','typeid');

        // Converting old values...
        $db    = $this->getDb();
        $table = $this->getTableName('object');

        $updateStmt = $db->sql('UPDATE '.$table.
            ' SET typeid=1 WHERE is_folder=1'
        );
        $updateStmt->query();

        $updateStmt = $db->sql('UPDATE '.$table.
            ' SET typeid=2 WHERE is_file=1'
        );
        $updateStmt->query();

        $updateStmt = $db->sql('UPDATE '.$table.
            ' SET typeid=3 WHERE is_page=1'
        );
        $updateStmt->query();

        $updateStmt = $db->sql('UPDATE '.$table.
            ' SET typeid=4 WHERE is_link=1'
        );
        $updateStmt->query();

        $this->dropColumn('object','is_folder');
        $this->dropColumn('object','is_file');
        $this->dropColumn('object','is_page');
        $this->dropColumn('object','is_link');
	}
}

?>