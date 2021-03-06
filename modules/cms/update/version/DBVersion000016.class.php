<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;

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
    	$table = $this->table('element');

        // Type 3 = Text is the default.
        $table->column('typeid')->type(Column::TYPE_INT)->size(0)->defaultValue(3)->add();

        $db = $this->getDb();
        $tableProject = $table->getSqlName();

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
            $updateStmt->execute();
        }

		$table->column('type')->drop();



        $table->column('flags')->type(Column::TYPE_INT)->size(0)->defaultValue(0)->add();

        $updateStmt = $db->sql(<<<SQL
UPDATE $tableProject
   SET flags=flags+1 WHERE html = 1
SQL
        );
        $updateStmt->execute();

        $updateStmt = $db->sql(<<<SQL
UPDATE $tableProject
   SET flags=flags+2 WHERE all_languages = 1
SQL
        );
        $updateStmt->execute();

        $updateStmt = $db->sql(<<<SQL
UPDATE $tableProject
   SET flags=flags+4 WHERE writable = 1
SQL
        );
        $updateStmt->execute();

        $updateStmt = $db->sql(<<<SQL
UPDATE $tableProject
   SET flags=flags+8 WHERE with_icon = 1
SQL
        );
        $updateStmt->execute();



        $table->column('format')->type(Column::TYPE_INT)->size(0)->defaultValue(0)->add();

        // Format = HTML
        $updateStmt = $db->sql(<<<SQL
UPDATE $tableProject
   SET format=1 WHERE html = 1 and wiki = 0
SQL
        );
        $updateStmt->execute();

        // Format = Wiki
        $updateStmt = $db->sql(<<<SQL
UPDATE $tableProject
   SET format=2 WHERE wiki = 1
SQL
        );
        $updateStmt->execute();

        // Other formats were not supported up to this version.

        // Cleanup
		$table->column('wiki'         )->drop();
		$table->column('html'         )->drop();
		$table->column('all_languages')->drop();
		$table->column('writable'     )->drop();
		$table->column('with_icon'    )->drop();

    }


}

?>