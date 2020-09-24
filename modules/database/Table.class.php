<?php


namespace database;


class Table
{
	const INDEX_PREFIX = 	'IX';
	const CONSTRAINT_PREFIX = 'FK';


	/**
	 * @var string
	 */
	private $tablePrefix;

	/**
	 * @var string
	 */
	private $tableSuffix;

	public function getSqlName()
	{
		return $this->tablePrefix . $this->name . $this->tableSuffix;
	}


	/**
	 * @var Database 
	 */
	private $db;
	private $dbmsType;

	/**
	 * Table name
	 * @var string
	 */
	private $name;

	/**
	 * Table constructor.
	 *
	 * @param $db Database
	 * @param $type
	 * @param $name
	 */
	public function __construct($db, $type, $name)
	{
		$this->db     = $db;
		$this->dbmsType = $type;
		$this->name   = $name;

		$this->tablePrefix = $db->conf['prefix'];
		$this->tableSuffix = $db->conf['suffix'];

	}

	public function column( $columnName ) {
		return new Column( $this->db,$this->dbmsType, $this, $columnName );
	}


	/**
	 * Erzeugt eine neue Tabelle.
	 * Die neue Tabelle enthält bereits eine Spalte "id" (da eine leere Tabelle i.d.R. nicht zulässig ist).
	 */
	public function add()
	{
		$tableName = $this->getSqlName();

		$table_opts = $this->dbmsType == OR_DB_TYPE_MYSQL ? ' ENGINE=InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci' : '';

		$ddl = $this->db->sql('CREATE TABLE ' . $tableName . '(id INTEGER)' . $table_opts . ';');
		// The syntax 'TYPE = InnoDB' was deprecated in MySQL 5.0 and was removed in MySQL 5.1 and later versions.

		$ddl->query();

		return $this;
	}


	public function addPrimaryKey($columnNames)
	{
		$table = $this->getSqlName();

		if (!is_array($columnNames))
			$columnNames = explode(',', $columnNames);

		$ddl = $this->db->sql('ALTER TABLE ' . $table . ' ADD PRIMARY KEY (' . implode(',', $columnNames) . ');');
		$ddl->query();

	}



	# Creating a unique key
	# param 1: name of index column. Seperate multiple columns with ','
	public function addIndex( $columnNames, $unique = false)
	{
		if (!is_array($columnNames))
			$columnNames = [$columnNames];

		$indexName = $this->tablePrefix . self::INDEX_PREFIX . '_' . $this->name . '_' . implode('_', $columnNames) . $this->tableSuffix;

//	if	[ "$type" == "oracle" ]; then
//	cnt=$(($cnt+1))
//	echo "CREATE UNIQUE INDEX ${prefix}uidx_${cnt}" >> $outfile
//	else

		$ddl = $this->db->sql('CREATE ' . ($unique ? 'UNIQUE ' : '') . 'INDEX ' . $indexName . ' ON ' . $this->getSqlName() . ' (' . implode(',', $columnNames) . ');');
		$ddl->query();

	}


	/**
	 * Creating a unique key.
	 * param 1: name of index column. Seperate multiple columns with ','
	 *
	 */
	public function addUniqueIndex( $columnNames)
	{
		$this->addIndex( $columnNames, true);
	}


	# Creating a foreign key
	# param 1: column name
	# param 2: target table name
	# param 3: target column name
	public function addConstraint($columnName, $targetTableName, $targetColumnName)
	{
		$targetTable = new Table($this->db,$this->dbmsType,$targetTableName);
		$targetTablename = $targetTable->getSqlName();

		$constraintName = $this->tablePrefix . self::CONSTRAINT_PREFIX . '_' . $this->name . $this->tableSuffix . '_' . $columnName;

		// Oracle doesn't support "ON DELETE RESTRICT"-Statements, but its the default.

		$ddl = $this->db->sql('ALTER TABLE ' . $this->getSqlName() . ' ADD CONSTRAINT ' . $constraintName . ' FOREIGN KEY (' . $columnName . ') REFERENCES ' . $targetTablename . ' (' . $targetColumnName . ') ON DELETE RESTRICT ON UPDATE RESTRICT;');
		$ddl->query();
	}


	public function drop()
	{
		$table = $this->getSqlName();

		$ddl = $this->db->sql('DROP TABLE ' . $table . ';');
		$ddl->query();
	}

	function dropIndex($indexName, $unique = false)
	{
		$ddl = $this->db->sql('DROP' . ($unique ? ' UNIQUE' : '') . ' INDEX ' . $indexName . ';');
		$ddl->query();
	}

	public function dropUniqueIndex($indexName)
	{
		$this->dropIndex($indexName, true);
	}

	public function dropPrimaryKey( $columnNames)
	{
		$table = $this->getSqlName();

		if (!is_array($columnNames))
			$columnNames = explode(',', $columnNames);

		$ddl = $this->db->sql('ALTER TABLE ' . $table . ' DROP PRIMARY KEY(' . implode(',', $columnNames) . ')');
		$ddl->query();
	}


	public function dropConstraint($constraintName)
	{
		$ddl = $this->db->sql('DROP CONSTRAINT ' . $constraintName . ';');
		$ddl->query();
	}

}