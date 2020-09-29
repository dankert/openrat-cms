<?php


namespace database;


class Column
{
	const TYPE_INT     = 1;
	const TYPE_VARCHAR = 2;
	const TYPE_TEXT    = 3;
	const TYPE_BLOB    = 4;

	private $db;
	private $dbmsType;
	private $name;
	private $table;

	private $type     = self::TYPE_INT;
	private $size     = null;
	private $default  = null;
	private $nullable = false;

	public function type( $type ) {
		$this->type = $type;
		return $this;
	}


	public function size( $size ) {
		$this->size = $size;
		return $this;
	}

	public function defaultValue( $default ) {
		$this->default = $default;
		return $this;
	}


	public function nullable() {
		$this->nullable = true;;
		return $this;
	}

	/**
	 * Column constructor.
	 *
	 * @param $db Database
	 * @param $type
	 * @param $table Table
	 * @param $name
	 */
	public function __construct($db, $type, $table, $name)
	{
		$this->db     = $db;
		$this->dbmsType = $type;
		$this->table  = $table;
		$this->name   = $name;
	}


	/**
	 * Creating a new column.
	 */
	function add()
	{
		$table = $this->table->getSqlName();

		switch ($this->type) {
			case self::TYPE_INT:
				switch ($this->dbmsType) {
					case DbVersion::TYPE_MYSQL:
						if ($this->size == 1)
							$dbmsInternalType = 'TINYINT';
						else
							$dbmsInternalType = 'INT';
						break;

					case DbVersion::TYPE_ORACLE:
						$dbmsInternalType = 'NUMBER';
						break;

					default:
						$dbmsInternalType = 'INTEGER';

				}
				break;

			case self::TYPE_VARCHAR:
				switch ($this->dbmsType) {
					default:
						$dbmsInternalType = 'VARCHAR';

				}
				break;

			case self::TYPE_TEXT:
				switch ($this->dbmsType) {
					case DbVersion::TYPE_MYSQL:
						$dbmsInternalType = 'MEDIUMTEXT';
						break;

					case DbVersion::TYPE_ORACLE:
						$dbmsInternalType = 'CLOB';
						break;

					default:
						$dbmsInternalType = 'TEXT';

				}
				break;

			case self::TYPE_BLOB:
				switch ($this->dbmsType) {
					case DbVersion::TYPE_MYSQL:
						$dbmsInternalType = 'MEDIUMBLOB';
						break;

					case DbVersion::TYPE_ORACLE:
						$dbmsInternalType = 'CLOB';
						break;

					case DbVersion::TYPE_POSTGRES:
						$dbmsInternalType = 'TEXT';
						break;

					case DbVersion::TYPE_SQLITE:
						$dbmsInternalType = 'TEXT';
						break;

					default:
						$dbmsInternalType = 'BLOB';

				}
				break;
			default:
				throw new \LogicException( 'Unknown Column type: ' . $this->type);
		}

		if ($this->dbmsType == DbVersion::TYPE_ORACLE) {
			// TEXT-columns must be nullable in Oracle, because empty strings are treated as NULL. BAD BAD BAD, Oracle!
			if ($this->type == self::TYPE_VARCHAR || $this->type == self::TYPE_TEXT)
				$nullable = true;

		}

		$ddl = $this->db->sql('ALTER TABLE ' . $table .
			' ADD COLUMN ' . $this->name . ' ' . $dbmsInternalType . ($this->size != null ? '(' . $this->size . ')' : '') .
			($this->default !== null ? ' DEFAULT ' . (is_string($this->default) ? "'" : '') . $this->default . (is_string($this->default) ? "'" : '') : '') .
			' ' . ($this->nullable ? 'NULL' : 'NOT NULL') . ';'
		);
		$ddl->query();

		return $this;
	}


	function drop()
	{
		$table = $this->table->getSqlName();

		$ddl = $this->db->sql('ALTER TABLE ' . $table . ' DROP COLUMN ' . $this->name . ';');
		$ddl->query();
	}
}