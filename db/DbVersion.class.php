<?php

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
	
	
	/*
	 * Erzeugt eine neue, leere Tabelle.
	# Creating a new table
	# param 1: table name
	 */
	
	function addTable( $tableName )
	{
		$tableName = $this->getTableName($tableName);
		
		$ddl = new Sql('CREATE TABLE '.$tableName.'(id INTEGER)'.($this->dbmsType=='mysql'?' ENGINE=InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci':'').';');
		// The syntax 'TYPE = InnoDB' was deprecated in MySQL 5.0 and was removed in MySQL 5.1 and later versions.
		
		$this->db->query( $ddl );
	}

	
		# Creating a new column
		# param 1: column name
		# param 2: type (available are: INT,VARCHAR,TEXT,BLOB)
		# param 3: size (number value)
		# param 4: default (number value)
		# param 5: nullable (available are: J,N)
	function addColumn($tableName,$columnName,$type,$size,$default,$nullable)
	{
		if	( $columnName == 'id') return;
		
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
		
		$ddl = new Sql('ALTER TABLE '.$table.
	               ' ADD COLUMN '.$columnName.' '.$dbmsInternalType.($size!=null?'('.$size.')':'').
	               ($default!=null?' DEFAULT '.(is_string($default)?"'":'').$default.(is_string($default)?"'":''):'').
	               ' '.($nullable?'NULL':'NOT NULL').';'
	              );
		$this->db->query( $ddl );
	
	}
	
	
	
	function addPrimaryKey( $tableName,$columnNames)
	{
		$table = $this->getTableName($tableName);
		
		if	( !is_array($columnNames) )
			$columnNames = explode(',',$columnNames);

		$ddl = new Sql('ALTER TABLE '.$table.' ADD PRIMARY KEY ('.implode(',',$columnNames).');');
		$this->db->query( $ddl );
		
	}
	
	
	
	# Creating a unique key
	# param 1: name of index column. Seperate multiple columns with ','
	function addIndex($tableName,$columnNames,$unique=false)
	{
		$table = $this->getTableName($tableName);
		
		if	( !is_array($columnNames) )
			$columnNames = explode(',',$columnNames);
		
		$indexName = $this->tablePrefix.'uidx_'.$tableName.'_'.implode('_',$columnNames).$this->tableSuffix;
			
//	if	[ "$type" == "oracle" ]; then
//	cnt=$(($cnt+1))
//	echo "CREATE UNIQUE INDEX ${prefix}uidx_${cnt}" >> $outfile
//	else
			
		$ddl = new Sql('CREATE '.($unique?'UNIQUE ':'').'INDEX '.$indexName.' ON '.$table.' ('.implode(',',$columnNames).');');
		$this->db->query( $ddl );
	}

	
	# Creating a unique key
	# param 1: name of index column. Seperate multiple columns with ','
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
		
		$ddl = new Sql('ALTER TABLE '.$table.' ADD CONSTRAINT '.$constraintName.' FOREIGN KEY ('.$columnName.') REFERENCES '.$targetTable.' ('.$targetColumnName.') ON DELETE RESTRICT ON UPDATE RESTRICT;');
		$this->db->query( $ddl );
	
	}
	
	
	
	function dropTable( $tableName)
	{
		$table = $this->getTableName($tableName);
	
		$ddl = new Sql('DROP TABLE '.$table.';' );
		$this->db->query( $ddl );
	
	}

	function dropColumn( $tableName,$columnName )
	{
		$table = $this->getTableName($tableName);
	
		$ddl = new Sql('ALTER TABLE '.$table.' DROP COLUMN '.$columnName.';');
		$this->db->query( $ddl );
	
	}
	
	function dropIndex( $indexName,$unique=false)
	{
		$ddl = new Sql('DROP'.($unique?' UNIQUE':'').' INDEX '.$indexName.';' );
		$this->db->query( $ddl );
	
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
		
		$ddl = new Sql('ALTER TABLE '.$table.' DROP PRIMARY KEY('.implode(',',$columnNames).')');
		$this->db->query( $ddl );
	}
	
	
	function dropConstraint( $constraintName)
	{
		$ddl = new Sql('DROP CONSTRAINT '.$constraintName.';' );
		$this->db->query( $ddl );
	
	}

	
	function getDb()
	{
		return $this->db;
	}

}

?>