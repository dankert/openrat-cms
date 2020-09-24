<?php


namespace database;

define('OR_DB_TYPE_MYSQL',1);
define('OR_DB_TYPE_POSTGRES',2);
define('OR_DB_TYPE_SQLITE',3);
define('OR_DB_TYPE_ORACLE',4);


abstract class DbVersion
{
	private $db;
	private $tablePrefix;
	private $tableSuffix;

	/**
	 * Datenbank-RDBMS-Typ
	 */
	private $dbmsType;

	/**
	 * DbVersion constructor.
	 * @param Database $db
	 */
	public function __construct(Database $db)
	{
		$this->db = $db;

		switch ($db->conf['type']) {
			case 'mysql':
			case 'mysqli':
				$this->dbmsType = OR_DB_TYPE_MYSQL;
				break;
			case 'postgresql':
				$this->dbmsType = OR_DB_TYPE_POSTGRES;
				break;
			case 'sqlite':
			case 'sqlite3':
				$this->dbmsType = OR_DB_TYPE_SQLITE;
				break;
			case 'pdo':
				$dsnParts = explode(':', $db->conf['dsn']);
				switch ($dsnParts[0]) {
					case 'mysql':
						$this->dbmsType = OR_DB_TYPE_MYSQL;
						break;
					case 'pgsql':
						$this->dbmsType = OR_DB_TYPE_POSTGRES;
						break;
					case 'sqlite':
						$this->dbmsType = OR_DB_TYPE_SQLITE;
						break;
					default:
						throw new \LogicException('Unknown DBMS in PDO-DSN: ' . $dsnParts[0]);
				}
				break;
			default:
				throw new \LogicException('Unknown DBMS type: ' . $db->conf['type']);
		}

		$this->tablePrefix = $db->conf['prefix'];
		$this->tableSuffix = $db->conf['suffix'];
	}

	// Muss überschrieben werden!
	abstract function update();


	public function table( $tableName ) {
		return new Table( $this->getDb(),$this->dbmsType, $tableName );
	}


	/**
	 * @return Database
	 */
	function getDb()
	{
		return $this->db;
	}

}
