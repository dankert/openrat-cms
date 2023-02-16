<?php

namespace cms\update\version;

use database\Column;
use database\DbVersion;

/**
 * Add tags.
 *
 * @author dankert
 *
 */
class DBVersion000032 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
    	$tagTable = $this->table('tag')->add();
		$tagTable->addPrimaryKey();
		$tagTable->column('projectid')->type( Column::TYPE_INT)->add();
		$tagTable->column('name'     )->type( Column::TYPE_VARCHAR)->size(128 )->add();
		$tagTable->addConstraint('projectid', 'project' );

		$tagObjectTable = $this->table('tag_object')->add();
		$tagObjectTable->addPrimaryKey();
		$tagObjectTable->column('tagid')   ->type( Column::TYPE_INT )->add();
		$tagObjectTable->column('objectid')->type( Column::TYPE_INT )->add();

		$tagObjectTable->addConstraint('tagid'    , 'tag'   );
		$tagObjectTable->addConstraint('objectid' , 'object');

		$tagObjectTable->addUniqueIndex( ['tagid','objectid'] );
	}
}

