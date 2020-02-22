<?php

namespace cms\update\version;

use database\DbVersion;
use security\Password;

/**
 * Converting element types from string to number.
 *
 * @author dankert
 *
 */
class DBVersion000016 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
        // Type 3 = Text is the default.
        $this->addColumn('element','typeid',OR_DB_COLUMN_TYPE_INT,0,3,OR_DB_COLUMN_NOT_NULLABLE);

        $db = $this->getDb();
        $tableProject = $this->getTableName('element');

        // Update the types
        $conversionTable = array(
          1 => 'date',
          2 => 'number',
          3 => 'text',
          4 => 'info' ,
          5 => 'infodate',
          6 => 'link'    ,
          7 => 'longtext',
          8 => 'code'    ,
          9 => 'dynamic' ,
         10 => 'select'  ,
         11 => 'copy'    ,
         12 => 'linkinfo',
         13 => 'linkdate',
         14 => 'insert'
        );

        foreach ($conversionTable as $typeid => $typename )
        {
            $updateStmt = $db->sql(<<<SQL
UPDATE $tableProject
   SET typeid=$typeid WHERE type = '$typename'
SQL
            );
            $updateStmt->query();
        }

        $this->dropColumn('element','type');



        $this->addColumn('element','flags',OR_DB_COLUMN_TYPE_INT,0,0,OR_DB_COLUMN_NOT_NULLABLE);

        $updateStmt = $db->sql(<<<SQL
UPDATE $tableProject
   SET flags=flags+1 WHERE html = 1
SQL
        );
        $updateStmt->query();

        $updateStmt = $db->sql(<<<SQL
UPDATE $tableProject
   SET flags=flags+2 WHERE all_languages = 1
SQL
        );
        $updateStmt->query();

        $updateStmt = $db->sql(<<<SQL
UPDATE $tableProject
   SET flags=flags+4 WHERE writable = 1
SQL
        );
        $updateStmt->query();

        $updateStmt = $db->sql(<<<SQL
UPDATE $tableProject
   SET flags=flags+8 WHERE with_icon = 1
SQL
        );
        $updateStmt->query();



        $this->addColumn('element','format',OR_DB_COLUMN_TYPE_INT,0,0,OR_DB_COLUMN_NOT_NULLABLE);

        // Format = HTML
        $updateStmt = $db->sql(<<<SQL
UPDATE $tableProject
   SET format=1 WHERE html = 1 and wiki = 0
SQL
        );
        $updateStmt->query();

        // Format = Wiki
        $updateStmt = $db->sql(<<<SQL
UPDATE $tableProject
   SET format=2 WHERE wiki = 1
SQL
        );
        $updateStmt->query();

        // Other formats were not supported up to this version.

        // Cleanup
        $this->dropColumn('element','wiki'         );
        $this->dropColumn('element','html'         );
        $this->dropColumn('element','all_languages');
        $this->dropColumn('element','writable'     );
        $this->dropColumn('element','with_icon'    );

    }


}

?>