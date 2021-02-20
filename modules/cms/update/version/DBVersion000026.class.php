<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;

/**
 * Templates now have a type.
 *
 * @author Jan Dankert
 *
 */
class DBVersion000026 extends DbVersion
{
    /**
     *
     */
    public function update() {

		$templateTable = $this->table('template');
		$templateTable->column('type')->type( Column::TYPE_INT)->defaultValue(1 )->add();
	}
}