<?php


namespace database;


abstract class DbVersion
{
	const TYPE_MYSQL    = 1;
	const TYPE_POSTGRES = 2;
	const TYPE_SQLITE   = 3;
	const TYPE_ORACLE   = 4; // Attention: ORACLE is NOT really supported.

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
			case 'pdo':
				if   ( $db->conf['dsn'] ) {
					$dsnParts = explode(':', $db->conf['dsn']);
					$driver = $dsnParts[0];
				}else {
					$driver = $db->conf['driver'];
				}
				switch ($driver) {
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
						throw new \LogicException('Unknown PDO driver: ' . $driver);
				}
				break;
			default:
				// for now we are only supporting PDO.
				throw new \LogicException('Unknown DBMS type: ' . $db->conf['type']);
		}

		$this->tablePrefix = $db->conf['prefix'];
		$this->tableSuffix = $db->conf['suffix'];
	}

	// Muss überschrieben werden!
	abstract function update();


	/**
	 * @param $tableName String table name
	 * @return Table
	 */
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
