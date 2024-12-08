<?php

namespace cms\update\version;

use database\Column;
use database\DbVersion;

/**
 * Add Bookmarks.
 *
 * @author dankert
 *
 */
class DBVersion000036 extends DbVersion
{
    /**
     * Creates the 'bookmark'-table.
     */
    public function update()
    {
    	$bookmarkTable = $this->table('bookmark')->add();
		$bookmarkTable->addPrimaryKey();
		$bookmarkTable->column('objectid')->type( Column::TYPE_INT)->add();
		$bookmarkTable->column('userid'  )->type( Column::TYPE_INT)->add();
		$bookmarkTable->addConstraint('objectid', 'object' );
		$bookmarkTable->addConstraint('userid'  , 'user'   );

		$bookmarkTable->addUniqueIndex( ['objectid','userid'] );
	}
}

