<?php

namespace cms\update\version;

use cms\base\Startup;
use database\DbVersion;
use database\Column;
use security\Password;

/**
 * Bigger number values.
 *
 * @author dankert
 *
 */
class DBVersion000034 extends DbVersion
{
    /**
     * Modify the number column for values for storing bigger integers.
     */
    public function update()
    {
    	foreach( [
    		$this->table('value'  )->column('number')->nullable(),
		] as $column ) {
			$column->type( Column::TYPE_INT )->size( Column::SIZE_INT_BIG )->modify();
		}
	}
}

