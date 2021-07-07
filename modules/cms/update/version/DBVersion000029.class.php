<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;
use security\Password;

/**
 * Migrate page value to content, so it becomes versionable.
 *
 * @author dankert
 *
 */
class DBVersion000029 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
    	$contentTable = $this->table('content');
		$contentTable->add();
		$contentTable->addPrimaryKey();

		$valueTable = $this->table('value');
		$valueTable->column('contentid')->nullable()->add();
		$valueTable->addConstraint('contentid','content');
		$valueTable->column('binary')->type( Column::TYPE_BLOB )->add();

		$pageContentTable = $this->table('pagecontent');
    	$pageContentTable->add();
		$pageContentTable->addPrimaryKey();
		$pageContentTable->column('pageid'    )->add();
		$pageContentTable->column('elementid' )->add();
		$pageContentTable->column('languageid')->add();
    	$pageContentTable->column('contentid' )->add();

    	$pageContentTable->addConstraint('pageid'    , 'page'    );
    	$pageContentTable->addConstraint('elementid' , 'element' );
    	$pageContentTable->addConstraint('languageid', 'language');
    	$pageContentTable->addConstraint('contentid' , 'content' );

		$db    = $this->getDb();
		$stmt  = $db->sql('SELECT * FROM '.$valueTable->getSqlName().' WHERE active=1' );
		$contentid = 0;
		foreach($stmt->getAll() as $row )
		{
			++$contentid;

			$stmt = $db->sql('INSERT INTO '.$contentTable->getSqlName().' (id) VALUES('.$contentid.')');
			$stmt->execute();

			$stmt = $db->sql('INSERT INTO '.$pageContentTable->getSqlName().' (id,pageid,elementid,languageid,contentid) VALUES('.$contentid.','.$row['pageid'].','.$row['elementidid'].','.$row['languageid'].','.$contentid.')');
			$stmt->execute();

			$stmt = $db->sql('UPDATE '.$valueTable->getSqlName().' SET contentid='.$contentid.' WHERE pageid='.$row['pageid'].' AND elementid='.$row['elementid'].' AND languageid='.$row['languageid'].')');
			$stmt->execute();
		}

		//$valueTable->column('pageid'    )->drop();
		//$valueTable->column('elementid' )->drop();
		//$valueTable->column('languageid')->drop();
	}
}

