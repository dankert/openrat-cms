<?php


namespace cms\update\version;

use database\DbVersion;
use security\Password;

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
        $not_nullable = false;
        $nullable = true;


        $this->addColumn('project', 'url', OR_DB_COLUMN_TYPE_VARCHAR, 255, '', $not_nullable);
        $this->addColumn('project', 'flags', OR_DB_COLUMN_TYPE_INT, 11, 0, $not_nullable);

        $db = $this->getDb();
        $tableProject = $this->getTableName('project');

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
        $this->dropColumn('project', 'cut_index');
        $this->dropColumn('project', 'content_negotiation');
    }
}

?>