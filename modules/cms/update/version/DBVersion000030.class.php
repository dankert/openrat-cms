<?php

namespace cms\update\version;

use cms\base\Startup;
use database\DbVersion;
use database\Column;
use security\Password;

/**
 * Migrate template models to a text content
 *
 * @author dankert
 *
 */
class DBVersion000030 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
    	$contentTable = $this->table('content'       );
    	$valueTable   = $this->table('value'         );

    	$templateModelTable = $this->table('templatemodel' );
    	$templateModelTable->column('contentid')->add();

		$db    = $this->getDb();
		$stmt  = $db->sql('SELECT * FROM '.$templateModelTable->getSqlName() );

		foreach($stmt->getAll() as $row ) // all templates should fit into memory.
		{
			$stmt = $db->sql('SELECT MAX(id) FROM '.$contentTable->getSqlName());
			$contentid = $stmt->getOne() + 1;

			$stmt = $db->sql('INSERT INTO '.$contentTable->getSqlName().' (id) VALUES('.$contentid.')') ;
			$stmt->execute();

			$stmt = $db->sql('SELECT MAX(id) FROM '.$valueTable->getSqlName());
			$valueid = $stmt->getOne() + 1;

			$stmt = $db->sql('INSERT INTO '.$valueTable->getSqlName().' (id,contentid,active,publish,text,lastchange_date) VALUES('.$valueid.','.$contentid.',1,1,{text},{time})');
			$stmt->setString( 'text', $row['text'] );
			$stmt->setInt   ( 'time', Startup::getStartTime() );
			$stmt->execute();

			$stmt = $db->sql('UPDATE '.$templateModelTable->getSqlName().' SET contentid='.$contentid.' WHERE id='.$row['id']);
			$stmt->execute();
		}

		$templateModelTable->addConstraint('contentid' , 'content' );
		$templateModelTable->column('text')->drop();
	}
}

