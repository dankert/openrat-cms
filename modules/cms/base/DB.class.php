<?php

namespace cms\base;

use RuntimeException;
use util\Request;
use util\Session;

class DB {

	/**
	 * Turns a SQL query into a Statement.
	 *
	 * @param $sql SQL-query
	 * @return \database\Statement SQL-Statement
	 */
	public static function sql( $sql ) {
		return self::get()->sql( $sql );
	}

	/**
	 * Returns the database connection.
	 * @return \database\Database
	 */
	public static function get() {

		$db = Request::getDatabase();

		if (!is_object($db))
			throw new RuntimeException('no database available');

		return $db;
	}
}