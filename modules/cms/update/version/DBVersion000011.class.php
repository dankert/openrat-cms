<?php


namespace cms\update\version;

use database\DbVersion;
use database\Column;

/**
 * Project gets new columns.
 *
 * @author dankert
 *
 */
class DBVersion000011 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
        $table = $this->table('project');

        $table->column( 'url')->type( Column::TYPE_VARCHAR)->size( 255)->defaultValue( '')->add();
        $table->column( 'flags')->type( Column::TYPE_INT)->size( 11)->defaultValue( 0)->add();

        $db = $this->getDb();
        $tableProject = $table->getSqlName();

        // Update the url
        $updateStmt = $db->sql(<<<SQL
UPDATE $tableProject
  SET url= CONCAT('//',name)
SQL
        );
        $updateStmt->query();

        // Update the new flags
        $updateStmt = $db->sql(<<<SQL
UPDATE $tableProject
  SET flags=flags+1 WHERE cut_index=1
SQL
        );
        $updateStmt->query();

        $updateStmt = $db->sql(<<<SQL
UPDATE $tableProject
  SET flags=flags+2 WHERE content_negotiation=1
SQL
        );
        $updateStmt->query();

        // now the information is hold in column 'flags', so we can delete the old columns.
		$table->column( 'cut_index')->drop();
		$table->column('content_negotiation')->drop();
    }
}

?>