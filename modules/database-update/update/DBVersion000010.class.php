<?php
use database\DbVersion;
use security\Password;

/**
 * Filetype 'file' is now devided into 'file' (unchanged), 'image' (new) and OR_DB_COLUMN_TYPE_TEXT (new).
 * 
 * @author dankert
 *
 */
class DBVersion000010 extends DbVersion
{
    /**
     *
     */
    public function update()
	{
        $db    = $this->getDb();
        $tableObject = $this->getTableName('object');
        $tableFile   = $this->getTableName('file');

        $updateStmt = $db->sql('UPDATE '.$tableObject.
            ' SET typeid=6 WHERE id IN (SELECT objectid FROM '.$tableFile.
            " WHERE extension IN ('gif','png','jpeg','jpg','svg','tiff') )"
        );
        $updateStmt->query();

        $updateStmt = $db->sql('UPDATE '.$tableObject.
            ' SET typeid=7 WHERE id IN (SELECT objectid FROM '.$tableFile.
            " WHERE extension IN ('css','text','txt','js','html','xml','log','ini','gpx') )"
        );
        $updateStmt->query();


	}
}

?>