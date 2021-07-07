<?php

namespace cms\update\version;

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
		$templateModelTable->addConstraint('contentid' , 'content' );

		$db    = $this->getDb();
		$stmt  = $db->sql('SELECT * FROM '.$templateModelTable->getSqlName().'' );

		foreach($stmt->getAll() as $row )
		{
			$stmt = $db->sql('SELECT MAX(id) FROM '.$contentTable->getSqlName().'');
			$contentid = $stmt->getOne();

			$stmt = $db->sql('INSERT INTO '.$contentTable->getSqlName().' (id) VALUES('.$contentid.')') ;
			$stmt->execute();

			$stmt = $db->sql('SELECT MAX(id) FROM '.$valueTable->getSqlName().'');
			$valueid = $stmt->getOne();

			$stmt = $db->sql('INSERT INTO '.$valueTable->getSqlName().' (id,contentid,active,publish,text) VALUES('.$valueid.','.$contentid.',1,1,{text}');
			$stmt->setString( 'text', $row['text'] );
			$stmt->execute();
		}
		//$templateModelTable->column('text')->drop();

	}
}

