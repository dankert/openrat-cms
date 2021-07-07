<?php

namespace cms\update\version;

use database\DbVersion;
use database\Column;

/**
 * MySql is now supporting constraints in the same table, so we should have a constraint for the parent child relations.
 *
 * @author Jan Dankert
 *
 */
class DBVersion000025 extends DbVersion
{
    /**
     *
     */
    public function update()
    {
		$objectTable = $this->table('object');
		$objectTable->addConstraint('parentid', 'object');
	}
}