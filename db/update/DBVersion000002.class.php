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

		$this->addColumn('version','version'  ,'INT',null,null,false);
		$this->addColumn('version','status'   ,'INT',null,null,false);
		$this->addColumn('version','installed','INT',null,null,false);
		
		$this->addPrimaryKey ('version','id'      );
		$this->addIndex      ('version','status'  );
		$this->addUniqueIndex('version','version' );
	}
}

?>