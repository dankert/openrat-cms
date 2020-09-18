<?php

namespace cms\base;

class DB {

	/**
	 * Turns a SQL query into a Statement.
	 *
	 * @param $sql SQL-query
	 * @return \database\Statement SQL-Statement
	 */
	public static function sql( $sql ) {
		return db()->sql( $sql );
	}
}