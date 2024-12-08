<?php

namespace cms\update\version;

use cms\base\Startup;
use database\DbVersion;
use database\Column;
use security\Password;

/**
 * Modify date columns to bigint to fix the year 2038 problem.
 *
 * @author dankert
 *
 */
class DBVersion000033 extends DbVersion
{
    /**
     * Modify date columns to bigint to fix the year 2038 problem.
     */
    public function update()
    {
    	foreach( [
			$this->table('object' )->column('create_date'    ),
		    $this->table('object' )->column('lastchange_date'),
		    $this->table('object' )->column('published_date')->nullable(),
		    $this->table('object' )->column('valid_from')->nullable(),
		    $this->table('object' )->column('valid_to'  )->nullable(),
    		$this->table('value'  )->column('date')->nullable(),
    		$this->table('value'  )->column('lastchange_date'),
    		$this->table('version')->column('installed'),
    		$this->table('user'   )->column('password_expires')->nullable(),
    		$this->table('user'   )->column('last_login')->nullable(),
    		$this->table('user'   )->column('password_locked_until')->nullable(),
    		$this->table('auth'   )->column('expires'),
    		$this->table('auth'   )->column('create_date'),
		] as $column ) {
			$column->type( Column::TYPE_INT )->size( Column::SIZE_INT_BIG )->modify();
		}
	}
}

