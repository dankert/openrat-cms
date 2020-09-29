<?php


namespace database;


abstract class DbVersion
{
	const TYPE_MYSQL    = 1;
	const TYPE_POSTGRES = 2;
	const TYPE_SQLITE   = 3;
	const TYPE_ORACLE   = 4;

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
				$this->dbmsType = DbVersion::TYPE_MYSQL;
				break;
			case 'postgresql':
				$this->dbmsType = DbVersion::TYPE_POSTGRES;
				break;
			case 'sqlite':
			case 'sqlite3':
				$this->dbmsType = DbVersion::TYPE_SQLITE;
				break;
			case 'pdo':
				$dsnParts = explode(':', $db->conf['dsn']);
				switch ($dsnParts[0]) {
					case 'mysql':
						$this->dbmsType = DbVersion::TYPE_MYSQL;
						break;
					case 'pgsql':
						$this->dbmsType = DbVersion::TYPE_POSTGRES;
						break;
					case 'sqlite':
						$this->dbmsType = DbVersion::TYPE_SQLITE;
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
