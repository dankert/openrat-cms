; <?php exit('direct access denied') ?>

; Database configuration

; This database will be selected by default.
; There has to exist an section with this name.
default=db1

[db1]

; Database configuration for connection 'db1

enabled    = true
comment    = "OpenRat Example"  ; comment of this database 

type       = mysql                 ; 'mysql' or 'postgresql' 
user       = dbuser                ; database user
password   = dbpass                ; database password
host       = localhost             ; database hostname
;port                              ; database TCP/IP-Port (optional)
database   = cms                   ; database name

base64     = false                 ; store binary as BASE64 (in postgresql=true)
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



; Add here more sections with other database connections.
;[another_db]
;...
