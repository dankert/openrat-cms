<?php


namespace database;


class Column
{
	const TYPE_INT     = 1;
	const TYPE_VARCHAR = 2;
	const TYPE_TEXT    = 3;
	const TYPE_BLOB    = 4;
	const TYPE_BIGINT  = 5;

	/**
	 * medium INT with 1 byte.
	 */
	const SIZE_INT_BOOL = 1;
	/**
	 * medium INT with 4 bytes.
	 */
	const SIZE_INT_MED = 2;
	/**
	 * medium INT with 8 bytes.
	 */
	const SIZE_INT_BIG = 3;

	const SIZE_VARCHAR_MAX = 255;

	private $db;
	private $dbmsType;
	private $name;
	private $table;

	private $type     = self::TYPE_INT;
	private $charset  = null;
	private $size     = null;
	private $default  = null;
	private $nullable = false;

	public function type( $type ) {
		$this->type = $type;
		return $this;
	}


	public function charset( $charset ) {
		$this->charset = $charset;
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


	/**
	 * Column is nullable.
	 * Marks the column as nullable, default is not nullable.
	 * @return $this
	 */
	public function nullable() {
		$this->nullable = true;;
		return $this;
	}

	/**
	 * Creates a column.
	 *
	 * @param $db Database database
	 * @param $type int Type of column
	 * @param $table string table name
	 * @param $name string column name
	 */
	public function __construct($db, $type, $table, $name)
	{
		$this->db     = $db;
		$this->dbmsType = $type;
		$this->table  = $table;
		$this->name   = $name;
	}


	/**
	 * Creating the column definition.
	 */
	protected function getColumnDefinition()
	{
		$table = $this->table->getSqlName();
		$size = null;

		switch ($this->type) {
			case self::TYPE_INT:
				switch ($this->dbmsType) {
					case DbVersion::TYPE_MYSQL:

						switch ($this->size ) {
							case self::SIZE_INT_BOOL: // small 1 or 2 byte integer
								$dbmsInternalType = 'TINYINT';
								break;
							case self::SIZE_INT_MED:
							case null: // default size is the 4-byte integer
								$dbmsInternalType = 'INT';
								break;
							case self::SIZE_INT_BIG: // 8 byte integer
								$dbmsInternalType = 'BIGINT';
								break;
						}

						break;

					case DbVersion::TYPE_POSTGRES:
						switch ( $this->size ) {

							case self::SIZE_INT_BOOL: // small 1 or 2 byte integer
								$dbmsInternalType = 'SMALLINT';
								break;
							case self::SIZE_INT_MED:
							case null: // default size is the 4-byte integer
								$dbmsInternalType = 'INTEGER';
								break;
							case self::SIZE_INT_BIG: // 8 byte integer
								$dbmsInternalType = 'BIGINT';
								break;
						}
						break;

					case DbVersion::TYPE_SQLITE:
					default:
						$dbmsInternalType = 'INTEGER';
				}
				break;

			case self::TYPE_VARCHAR:
				switch ($this->dbmsType) {
					default:
						$dbmsInternalType = 'VARCHAR';

				}
				$size = $this->size; // char count

				if   ( ! $size )
					$size = self::SIZE_VARCHAR_MAX;

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

		return $dbmsInternalType .
			($size ? '(' . $size . ')' : '') .
			($this->charset !== null ? ' CHARACTER SET ' . $this->charset : '') .
			($this->default !== null ? ' DEFAULT ' . (is_string($this->default) ? "'" : '') . $this->default . (is_string($this->default) ? "'" : '') : '') .
			' ' . ($this->nullable ? 'NULL' : 'NOT NULL');
	}


	public function add() {
		$table = $this->table->getSqlName();
		$ddl = $this->db->sql('ALTER TABLE ' . $table .
			' ADD COLUMN ' . $this->name . ' ' . $this->getColumnDefinition(). ';'
		);
		$ddl->execute();
	}

	public function modify() {
		$table = $this->table->getSqlName();
		$ddl = $this->db->sql('ALTER TABLE ' . $table .
			' MODIFY COLUMN ' . $this->name . ' ' . $this->getColumnDefinition() . ';'
		);
		$ddl->execute();
	}

	function drop()
	{
		$table = $this->table->getSqlName();

		$ddl = $this->db->sql('ALTER TABLE ' . $table . ' DROP COLUMN ' . $this->name . ';');
		$ddl->execute();
	}
}