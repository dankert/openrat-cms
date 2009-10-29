; <?php exit('direct access denied') ?>

; Database configuration file
; You have to have at least one database connection which has 'enabled=true'.
;
; Supported RDBMS-types:
; - 'mysql'      the old PHP-mysql-driver
; - 'mysqli'     PHP-mysql-driver with support for prepared statements (EXPERIMENTAL) (since PHP 5.0) 
; - 'postgresql' Postgresql
; - 'sqlite'     SQ-Lite 2.x-databases                                                (since PHP 5.1)
; - 'sqlite3'    SQ-Lite 3.x-databases (EXPERIMENTAL)                                 (since PHP 5.3)
; - 'pdo'        A common PHP database abstraction layer for a lot of DBs.            (since PHP 5.1)



; Default Database
; This database will be selected by default.
; There has to exist a section with this name.
default=sample_db_mysql



[sample_db_mysql]

; This is a sample database connection.
; If you want to use it, just fill out the login data and set 'enabled' to 'true'

enabled    = false                 ; set this to 'true' for using this connection
comment    = "OpenRat-DB MySQL"    ; comment of this database 

type       = mysql                 ;  
user       = dbuser                ; database user
password   = dbpass                ; database password
host       = localhost             ; database hostname
;port                              ; database TCP/IP-Port (optional)
database   = cms                   ; database name

base64     = false                 ; store binary as BASE64
prefix     = or_                   ; table praefix
persistent = yes                   ; use persistent connections (try this, it's faster)
;charset = UTF-8

; SQL-Statement which is executed after opening the connection
;connection_sql = ""
 
; System command for executing before connecting to the database.
; Maybe for installing an SSH-Tunnel.
; For background programs, you have to redirect stdin and stdout! (maybe to /dev/null) 
; Example: "sudo -u u123 /usr/local/bin/sshtunnel-example.sh"
; Default: blank.
cmd = ""

; Using prepared statements.
; The 'old' mysql-interface in PHP does not support prepared statements
prepare = false

; Using transactions. Set to 'true' when you are using 'InnoDB'-tables.
; If so, maybe you need to set 'SET AUTOCOMMIT=0' as connection_sql above.
; Default: false
transaction = false

; Readonly tables. Set to 'true' during maintainance activitys.
; If 'true', OpenRat will disable all writing operations.
readonly = false



[sample_db_postgresql]

; This is a sample database connection.
; If you want to use it, just fill out the login data and set 'enabled' to 'true'

enabled    = false                 ; set this to 'true' for using this connection
comment    = "OpenRat PG-Example"  ; comment of this database 

type       = postgresql            ; 
user       = dbuser                ; database user
password   = dbpass                ; database password
host       = localhost             ; database hostname
;port                              ; database TCP/IP-Port (optional)
database   = cms                   ; database name

base64     = false                 ; store binary as BASE64 (in postgresql 7.x set this to 'true')
prefix     = or_                   ; table praefix
persistent = yes                   ; use persistent connections (try this, it's faster)
;charset = UTF-8

; SQL-Statement which is executed after opening the connection
;connection_sql = ""
 
; System command for executing before connecting to the database.
; Maybe for installing an SSH-Tunnel.
; For background programs, you have to redirect stdin and stdout! (maybe to /dev/null) 
; Example: "sudo -u u123 /usr/local/bin/sshtunnel-example.sh"
; Default: blank.
cmd = ""

; Using prepared statements.
; This is EXPERIMENTAL, do not use in production environments
prepare = false

; Using transactions. Set this to true, if your database is supporting transactions
transaction = false



; SQ-Lite is an embedded, 'mostly-ANSI-SQL-supporting' database system.
; for using SQLite, please check for the PHP module
; f.e. on ubuntu 'sudo apt-get install php5-sqlite'
[sample_db_sqlite]

enabled    = false                    ; set this to 'true' for using this connection
comment    = "OpenRat SQLite-Example" ; comment of this database 

type       = sqlite                ; 

; Filename of your SQlite database
filename   = "/local/path/to/your/sqlite/openrat.db"

base64     = false                 ; store binary as BASE64 (in postgresql=true)
prefix     = or_                   ; table praefix
persistent = yes                   ; use persistent connections (try this, it's faster)
;charset = UTF-8

; per default SQlite uses table-prefixed column names when using JOINs which MUST BE off. 
connection_sql = "pragma short_column_names=true;"
 
; System command for executing before connecting to the database.
cmd = ""

prepare = false

; Due to its embedded background SQLite does NOT support transactions.
transaction = false



; Add here more sections with other database connections.
;[another_db]
; type=...
; comment="My production DB ..."
; ...


