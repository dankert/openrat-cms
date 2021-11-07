<?php

namespace cms\update\version;

use cms\base\Startup;
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

		$db    = $this->getDb();
		$stmt  = $db->sql('SELECT id FROM '.$fileTable->getSqlName() );

		foreach($stmt->getCol() as $fileid )
		{
			$stmt = $db->sql('SELECT * FROM '.$fileTable->getSqlName().' WHERE id='.$fileid );
			$row = $stmt->getRow();

			$stmt = $db->sql('SELECT MAX(id) FROM '.$contentTable->getSqlName() );
			$contentid = $stmt->getOne() + 1;

			$stmt = $db->sql('INSERT INTO '.$contentTable->getSqlName().' (id) VALUES('.$contentid.')') ;
			$stmt->execute();

			$stmt = $db->sql('SELECT MAX(id) FROM '.$valueTable->getSqlName() );
			$valueid = $stmt->getOne() + 1;

			$stmt = $db->sql('INSERT INTO '.$valueTable->getSqlName().' (id,contentid,active,publish,file,lastchange_date) VALUES('.$valueid.','.$contentid.',1,1,{file},{time})');
			$stmt->setString( 'file', $row['value'] );
			$stmt->setInt   ( 'time', Startup::getStartTime() );
			$stmt->execute();

			$stmt = $db->sql('UPDATE '.$fileTable->getSqlName().' SET contentid='.$contentid);
			$stmt->execute();
		}

		$fileTable->addConstraint('contentid' , 'content' );
		$fileTable->column('value')->drop();

	}
}

