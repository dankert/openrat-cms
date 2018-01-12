<?php
use database\DbVersion;
/**
 * new table: version.
 *
 * @author dankert
 *
 */
class DBVersion000002 extends DbVersion
{
	public function update()
	{
		$this->addTable('version');

		$this->addColumn('version','version'  ,OR_DB_COLUMN_TYPE_INT,null,null,false);
		$this->addColumn('version','status'   ,OR_DB_COLUMN_TYPE_INT,null,null,false);
		$this->addColumn('version','installed',OR_DB_COLUMN_TYPE_INT,null,null,false);
		
		$this->addPrimaryKey ('version','id'      );
		$this->addIndex      ('version','status'  );
		$this->addUniqueIndex('version','version' );
	}
}

?>