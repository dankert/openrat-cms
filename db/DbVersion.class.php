<?php

define('OR_DB_INDEX_PREFIX','IX');

abstract class DbVersion
{
	private $db;
	private $tablePrefix;
	private $tableSuffix;
	private $dbmsType;
	
	function DbVersion( $db )
	{
		$this->db = $db;
		
		switch( $db->conf['type'] )
		{
			case 'mysql':
			case 'mysqli':
				$this->dbmsType = 'mysql';
				break;
			case 'postgresql':
				$this->dbmsType = 'postgresql';
				break;
			case 'sqlite':
			case 'sqlite3':
				$this->dbmsType = 'sqlite';
				break;
			case 'pdo':
				$dsnParts = explode(':',$db->conf['dsn']);
				switch( $dsnParts[0] )
				{
					case 'mysql':
						$this->dbmsType = 'mysql';
						break;
					case 'pgsql':
						$this->dbmsType = 'postgresql';
						break;
					case 'sqlite':
						$this->dbmsType = 'sqlite';
						break;
					default:
						Http::serverError('Datebase Configuration Error','Unknown DBMS in PDO-DSN: '.$dsnParts[0]);
				}
				break;
			default:
				Http::serverError('Datebase Configuration Error','Unknown DBMS type: '.$db->conf['type'] );
		}
		
		$this->tablePrefix = $db->conf['prefix'];
		$this->tableSuffix = $db->conf['suffix'];
	}
	
	// Muss überschrieben werden!
	abstract function update();
	
	
	
	
	
	
	
	
	private function getTableName( $name )
	{
		return $this->tablePrefix.$name.$this->tableSuffix;
	}
	
	
	/**
	 * Erzeugt eine neue Tabelle.
	 * Die neue Tabelle enthält bereits eine Spalte "id" (da eine leere Tabelle i.d.R. nicht zulässig ist). 
	 */
	function addTable( $tableName )
	{
		$tableName = $this->getTableName($tableName);
		
		$table_opts = $this->dbmsType=='mysql'?' ENGINE=InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci':'';
		
		$ddl = $this->db->sql('CREATE TABLE '.$tableName.'(id INTEGER)'.$table_opts.';');
		// The syntax 'TYPE = InnoDB' was deprecated in MySQL 5.0 and was removed in MySQL 5.1 and later versions.
		
		$ddl->query();
	}

	
		# Creating a new column
		# param 1: column name
		# param 2: type (available are: INT,VARCHAR,TEXT,BLOB)
		# param 3: size (number value)
		# param 4: default (number value)
		# param 5: nullable (available are: J,N)
	function addColumn($tableName,$columnName,$type,$size,$default,$nullable)
	{
		$table = $this->getTableName($tableName);

		$type = strtoupper($type);
		switch( $type )
		{
			case 'INT':
				switch( $this->dbmsType )
				{
					case 'mysql':
						if	( $size == 1 )
							$dbmsInternalType = 'TINYINT';
						else
							$dbmsInternalType = 'INT';
						break;
					
					case 'oracle':
						$dbmsInternalType = 'NUMBER';
						break;
					
					default:
						$dbmsInternalType = 'INTEGER';
						
				}
				break;

			case 'VARCHAR':
				switch( $this->dbmsType )
				{
					default:
						$dbmsInternalType = 'VARCHAR';
						
				}
				break;
				
			case 'TEXT':
				switch( $this->dbmsType )
				{
					case 'mysql':
						$dbmsInternalType = 'MEDIUMTEXT';
						break;
							
					case 'oracle':
						$dbmsInternalType = 'CLOB';
						break;
					
					default:
						$dbmsInternalType = 'TEXT';
							
				}
				break;
				
			case 'BLOB':
				switch( $this->dbmsType )
				{
					case 'mysql':
						$dbmsInternalType = 'MEDIUMBLOB';
						break;
					
					case 'oracle':
						$dbmsInternalType = 'CLOB';
						break;

					case 'postgresql':
						$dbmsInternalType = 'TEXT';
						break;

					case 'sqlite':
						$dbmsInternalType = 'TEXT';
						break;
						
					default:
						$dbmsInternalType = 'BLOB';
						
				}
				break;
			default:
				Http::serverError('Datebase Configuration Error','Unknown Column type: '.$type );
		}
				
		if	( $this->dbmsType == 'oracle')
		{
			// TEXT-columns should be nullable in Oracle, because empty strings are treated as NULL
			if	( $type=='VARCHAR' || $type=='TEXT')
				$nullable = true;
			
		}
		
		$ddl = $this->db->sql('ALTER TABLE '.$table.
	               ' ADD COLUMN '.$columnName.' '.$dbmsInternalType.($size!=null?'('.$size.')':'').
	               ($default!=null?' DEFAULT '.(is_string($default)?"'":'').$default.(is_string($default)?"'":''):'').
	               ' '.($nullable?'NULL':'NOT NULL').';'
	              );
		$ddl->query();
	
	}
	
	
	
	function addPrimaryKey( $tableName,$columnNames)
	{
		$table = $this->getTableName($tableName);
		
		if	( !is_array($columnNames) )
			$columnNames = explode(',',$columnNames);

		$ddl = $this->db->sql('ALTER TABLE '.$table.' ADD PRIMARY KEY ('.implode(',',$columnNames).');');
		$ddl->query();
				
	}
	
	
	
	# Creating a unique key
	# param 1: name of index column. Seperate multiple columns with ','
	function addIndex($tableName,$columnNames,$unique=false)
	{
		$table = $this->getTableName($tableName);
		
		if	( !is_array($columnNames) )
			$columnNames = explode(',',$columnNames);
		
		$indexName = $this->tablePrefix.OR_DB_INDEX_PREFIX.'_'.$tableName.'_'.implode('_',$columnNames).$this->tableSuffix;
			
//	if	[ "$type" == "oracle" ]; then
//	cnt=$(($cnt+1))
//	echo "CREATE UNIQUE INDEX ${prefix}uidx_${cnt}" >> $outfile
//	else
			
		$ddl = $this->db->sql('CREATE '.($unique?'UNIQUE ':'').'INDEX '.$indexName.' ON '.$table.' ('.implode(',',$columnNames).');');
		$ddl->query();
		
	}

	
	/**
	 * Creating a unique key.
	 * param 1: name of index column. Seperate multiple columns with ','
	 * 
	 */
	function addUniqueIndex($tableName,$columnNames)
	{
		$this->addIndex( $tableName,$columnNames,true );
	}
	
				
	# Creating a foreign key
	# param 1: column name
	# param 2: target table name
	# param 3: target column name
	function addConstraint($tableName,$columnName,$targetTableName,$targetColumnName)
	{
		$table       = $this->getTableName($tableName);
		$targetTable = $this->getTableName($targetTableName);
	
		$constraintName = $this->tablePrefix.'fk_'.$tableName.$this->tableSuffix.'_'.$columnName;
		
		//
// 	if	[ "$type" == "oracle" ]; then
// 	cnt=$(($cnt+1))
// 	echo "  ,CONSTRAINT ${prefix}fk_${cnt}" >> $outfile
// 	else
// 	echo "  ,CONSTRAINT ${prefix}fk_${table}${suffix}_$1" >> $outfile
// 	fi
	// Oracle doesn't support "ON DELETE RESTRICT"-Statements, but its the default.
		
		$ddl = $this->db->sql('ALTER TABLE '.$table.' ADD CONSTRAINT '.$constraintName.' FOREIGN KEY ('.$columnName.') REFERENCES '.$targetTable.' ('.$targetColumnName.') ON DELETE RESTRICT ON UPDATE RESTRICT;');
		$ddl->query();
	}
	
	
	
	function dropTable( $tableName)
	{
		$table = $this->getTableName($tableName);
	
		$ddl = $this->db->sql('DROP TABLE '.$table.';' );
		$ddl->query();
	}

	function dropColumn( $tableName,$columnName )
	{
		$table = $this->getTableName($tableName);
	
		$ddl = $this->db->sql('ALTER TABLE '.$table.' DROP COLUMN '.$columnName.';');
		$ddl->query();
		
	
	}
	
	function dropIndex( $indexName,$unique=false)
	{
		$ddl = $this->db->sql('DROP'.($unique?' UNIQUE':'').' INDEX '.$indexName.';' );
		$ddl->query();
	}

	function dropUniqueIndex( $indexName)
	{
		$this->dropIndex( $indexName,true );
	}
	
	function dropPrimaryKey( $tableName,$columnNames )
	{
		$table = $this->getTableName($tableName);
		
		if	( !is_array($columnNames) )
			$columnNames = explode(',',$columnNames);
		
		$ddl = $this->db->sql('ALTER TABLE '.$table.' DROP PRIMARY KEY('.implode(',',$columnNames).')');
		$ddl->query();
	}
	
	
	function dropConstraint( $constraintName)
	{
		$ddl = $this->db->sql('DROP CONSTRAINT '.$constraintName.';' );
		$ddl->query();
	}

	
	function getDb()
	{
		return $this->db;
	}

}

?>