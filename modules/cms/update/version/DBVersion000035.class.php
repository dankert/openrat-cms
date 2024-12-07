<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;

/**
 * Users now have a style scheme.
 *
 * @author Jan Dankert
 *
 */
class DBVersion000035 extends DbVersion
{
    /**
     *
     */
    public function update() {

		$userTable = $this->table('user');
		$userTable->column('style_scheme')->type( Column::TYPE_INT)->defaultValue(1 )->add();
	}
}