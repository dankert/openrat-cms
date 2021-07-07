<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;
use security\Password;

/**
 * Migrate file values to content.
 *
 * @author dankert
 *
 */
class DBVersion000031 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
    	$contentTable = $this->table('content'       );
    	$valueTable   = $this->table('value'         );

    	$fileTable = $this->table('file' );
    	$fileTable->column('contentid')->add();
		$fileTable->addConstraint('contentid' , 'content' );

		$db    = $this->getDb();
		$stmt  = $db->sql('SELECT * FROM '.$fileTable->getSqlName().'' );

		foreach($stmt->getAll() as $row )
		{
			$stmt = $db->sql('SELECT MAX(id) FROM '.$contentTable->getSqlName().'');
			$contentid = $stmt->getOne();

			$stmt = $db->sql('INSERT INTO '.$contentTable->getSqlName().' (id) VALUES('.$contentid.')') ;
			$stmt->execute();

			$stmt = $db->sql('SELECT MAX(id) FROM '.$valueTable->getSqlName().'');
			$valueid = $stmt->getOne();

			$stmt = $db->sql('INSERT INTO '.$valueTable->getSqlName().' (id,contentid,active,publish,binary) VALUES('.$valueid.','.$contentid.',1,1,{file}');
			$stmt->setString( 'file', $row['value'] );
			$stmt->execute();
		}

		//$fileTable->column('value')->drop();

	}
}

