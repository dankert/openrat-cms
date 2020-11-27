<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;

/**
 * Security enhancements:
 * - log login tries
 * - add new fail counter
 *
 * @author Jan Dankert
 *
 */
class DBVersion000023 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
        $table = $this->table('user');

		$table->column('password_locked_until' )->type(Column::TYPE_INT )->nullable()->add();
		$table->column('password_fail_count'   )->type(Column::TYPE_INT )->defaultValue(0 )->add();
	}
}

