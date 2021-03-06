<?php

namespace cms\update\version;

use database\DbVersion;
use security\Password;

/**
 * Filetype 'file' is now devided into 'file' (unchanged), 'image' (new) and Column::TYPE_TEXT (new).
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
        $db          = $this->getDb();
        $tableObject = $this->table('object')->getSqlName();
        $tableFile   = $this->table('file'  )->getSqlName();

        $updateStmt = $db->sql('UPDATE '.$tableObject.
            ' SET typeid=6 WHERE id IN (SELECT objectid FROM '.$tableFile.
            " WHERE extension IN ('gif','png','jpeg','jpg','svg','tiff') )"
        );
        $updateStmt->execute();

        $updateStmt = $db->sql('UPDATE '.$tableObject.
            ' SET typeid=7 WHERE id IN (SELECT objectid FROM '.$tableFile.
            " WHERE extension IN ('css','text','txt','js','html','xml','log','ini','gpx') )"
        );
        $updateStmt->execute();

	}
}