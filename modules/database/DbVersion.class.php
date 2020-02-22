<?php


namespace database {

    define('OR_DB_INDEX_PREFIX', 'IX');
    define('OR_DB_CONSTRAINT_PREFIX', 'FK');

    define('OR_DB_TYPE_MYSQL',1);
    define('OR_DB_TYPE_POSTGRES',2);
    define('OR_DB_TYPE_SQLITE',3);
    define('OR_DB_TYPE_ORACLE',4);

    define('OR_DB_COLUMN_TYPE_INT',1);
    define('OR_DB_COLUMN_TYPE_VARCHAR',2);
    define('OR_DB_COLUMN_TYPE_TEXT',3);
    define('OR_DB_COLUMN_TYPE_BLOB',4);
    define('OR_DB_COLUMN_NULLABLE',true);
    define('OR_DB_COLUMN_NOT_NULLABLE',false);


    abstract class DbVersion
    {
        private $db;
        private $tablePrefix;
        private $tableSuffix;

        /**
         * Datenbank-RDBMS-Typ
         * @var int
         */
        private $dbmsType;

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


        protected function getTableName($name)
        {
            return $this->tablePrefix . $name . $this->tableSuffix;
        }


        /**
         * Erzeugt eine neue Tabelle.
         * Die neue Tabelle enthält bereits eine Spalte "id" (da eine leere Tabelle i.d.R. nicht zulässig ist).
         * @param $tableName string
         */
        function addTable($tableName)
        {
            $tableName = $this->getTableName($tableName);

            $table_opts = $this->dbmsType == OR_DB_TYPE_MYSQL ? ' ENGINE=InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci' : '';

            $ddl = $this->db->sql('CREATE TABLE ' . $tableName . '(id INTEGER)' . $table_opts . ';');
            // The syntax 'TYPE = InnoDB' was deprecated in MySQL 5.0 and was removed in MySQL 5.1 and later versions.

            $ddl->query();
        }


        /**
         * Creating a new column.
         * @param $tableName string Table name
         * @param $columnName string Column name
         * @param $type int one of the constance OR_DB_COLUMN_TYPE_*
         * @param $size int Size
         * @param $default mixed Default value
         * @param $nullable boolean
         */
        function addColumn($tableName, $columnName, $type, $size, $default, $nullable)
        {
            $table = $this->getTableName($tableName);

            $type = strtoupper($type);
            switch ($type) {
                case OR_DB_COLUMN_TYPE_INT:
                    switch ($this->dbmsType) {
                        case OR_DB_TYPE_MYSQL:
                            if ($size == 1)
                                $dbmsInternalType = 'TINYINT';
                            else
                                $dbmsInternalType = 'INT';
                            break;

                        case OR_DB_TYPE_ORACLE:
                            $dbmsInternalType = 'NUMBER';
                            break;

                        default:
                            $dbmsInternalType = 'INTEGER';

                    }
                    break;

                case OR_DB_COLUMN_TYPE_VARCHAR:
                    switch ($this->dbmsType) {
                        default:
                            $dbmsInternalType = 'VARCHAR';

                    }
                    break;

                case OR_DB_COLUMN_TYPE_TEXT:
                    switch ($this->dbmsType) {
                        case OR_DB_TYPE_MYSQL:
                            $dbmsInternalType = 'MEDIUMTEXT';
                            break;

                        case OR_DB_TYPE_ORACLE:
                            $dbmsInternalType = 'CLOB';
                            break;

                        default:
                            $dbmsInternalType = 'TEXT';

                    }
                    break;

                case OR_DB_COLUMN_TYPE_BLOB:
                    switch ($this->dbmsType) {
                        case OR_DB_TYPE_MYSQL:
                            $dbmsInternalType = 'MEDIUMBLOB';
                            break;

                        case OR_DB_TYPE_ORACLE:
                            $dbmsInternalType = 'CLOB';
                            break;

                        case OR_DB_TYPE_POSTGRES:
                            $dbmsInternalType = 'TEXT';
                            break;

                        case OR_DB_TYPE_SQLITE:
                            $dbmsInternalType = 'TEXT';
                            break;

                        default:
                            $dbmsInternalType = 'BLOB';

                    }
                    break;
                default:
                    throw new \LogicException( 'Unknown Column type: ' . $type);
            }

            if ($this->dbmsType == OR_DB_TYPE_ORACLE) {
                // TEXT-columns must be nullable in Oracle, because empty strings are treated as NULL. BAD BAD BAD, Oracle!
                if ($type == OR_DB_COLUMN_TYPE_VARCHAR || $type == OR_DB_COLUMN_TYPE_TEXT)
                    $nullable = true;

            }

            $ddl = $this->db->sql('ALTER TABLE ' . $table .
                ' ADD COLUMN ' . $columnName . ' ' . $dbmsInternalType . ($size != null ? '(' . $size . ')' : '') .
                ($default !== null ? ' DEFAULT ' . (is_string($default) ? "'" : '') . $default . (is_string($default) ? "'" : '') : '') .
                ' ' . ($nullable ? 'NULL' : 'NOT NULL') . ';'
            );
            $ddl->query();

        }


        function addPrimaryKey($tableName, $columnNames)
        {
            $table = $this->getTableName($tableName);

            if (!is_array($columnNames))
                $columnNames = explode(',', $columnNames);

            $ddl = $this->db->sql('ALTER TABLE ' . $table . ' ADD PRIMARY KEY (' . implode(',', $columnNames) . ');');
            $ddl->query();

        }



        # Creating a unique key
        # param 1: name of index column. Seperate multiple columns with ','
        function addIndex($tableName, $columnNames, $unique = false)
        {
            $table = $this->getTableName($tableName);

            if (!is_array($columnNames))
                $columnNames = explode(',', $columnNames);

            $indexName = $this->tablePrefix . OR_DB_INDEX_PREFIX . '_' . $tableName . '_' . implode('_', $columnNames) . $this->tableSuffix;

//	if	[ "$type" == "oracle" ]; then
//	cnt=$(($cnt+1))
//	echo "CREATE UNIQUE INDEX ${prefix}uidx_${cnt}" >> $outfile
//	else

            $ddl = $this->db->sql('CREATE ' . ($unique ? 'UNIQUE ' : '') . 'INDEX ' . $indexName . ' ON ' . $table . ' (' . implode(',', $columnNames) . ');');
            $ddl->query();

        }


        /**
         * Creating a unique key.
         * param 1: name of index column. Seperate multiple columns with ','
         *
         */
        function addUniqueIndex($tableName, $columnNames)
        {
            $this->addIndex($tableName, $columnNames, true);
        }


        # Creating a foreign key
        # param 1: column name
        # param 2: target table name
        # param 3: target column name
        function addConstraint($tableName, $columnName, $targetTableName, $targetColumnName)
        {
            $table = $this->getTableName($tableName);
            $targetTable = $this->getTableName($targetTableName);

            $constraintName = $this->tablePrefix . OR_DB_CONSTRAINT_PREFIX . '_' . $tableName . $this->tableSuffix . '_' . $columnName;

            // Oracle doesn't support "ON DELETE RESTRICT"-Statements, but its the default.

            $ddl = $this->db->sql('ALTER TABLE ' . $table . ' ADD CONSTRAINT ' . $constraintName . ' FOREIGN KEY (' . $columnName . ') REFERENCES ' . $targetTable . ' (' . $targetColumnName . ') ON DELETE RESTRICT ON UPDATE RESTRICT;');
            $ddl->query();
        }


        function dropTable($tableName)
        {
            $table = $this->getTableName($tableName);

            $ddl = $this->db->sql('DROP TABLE ' . $table . ';');
            $ddl->query();
        }

        function dropColumn($tableName, $columnName)
        {
            $table = $this->getTableName($tableName);

            $ddl = $this->db->sql('ALTER TABLE ' . $table . ' DROP COLUMN ' . $columnName . ';');
            $ddl->query();


        }

        function dropIndex($indexName, $unique = false)
        {
            $ddl = $this->db->sql('DROP' . ($unique ? ' UNIQUE' : '') . ' INDEX ' . $indexName . ';');
            $ddl->query();
        }

        function dropUniqueIndex($indexName)
        {
            $this->dropIndex($indexName, true);
        }

        function dropPrimaryKey($tableName, $columnNames)
        {
            $table = $this->getTableName($tableName);

            if (!is_array($columnNames))
                $columnNames = explode(',', $columnNames);

            $ddl = $this->db->sql('ALTER TABLE ' . $table . ' DROP PRIMARY KEY(' . implode(',', $columnNames) . ')');
            $ddl->query();
        }


        function dropConstraint($constraintName)
        {
            $ddl = $this->db->sql('DROP CONSTRAINT ' . $constraintName . ';');
            $ddl->query();
        }


        /**
         * @return Database
         */
        function getDb()
        {
            return $this->db;
        }

    }
}