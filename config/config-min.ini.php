; <?php die() ?>

; OpenRat configuration file - Minimal settings.
; For all configuration settings and an explanation for each setting, see file 'config.ini.php'.
; Lines beginning with ';' are ignored.                   

database.default=db1                            ; Default Database

database.db1.enabled    = true                  ; using this connection
database.db1.name       = "Your DB"             ; comment
database.db1.comment    = "Description"         ; comment

database.db1.type       = mysql                 ; 'mysql|mysqli|postgresql|sqlite|sqlite3|pdo
database.db1.user       = dbuser                ; user
database.db1.password   = dbpass                ; password
database.db1.host       = localhost             ; hostname
database.db1.port       =                       ; TCP-Port
database.db1.database   = cms                   ; database name

database.db1.base64     = false                 ; store binary as BASE64
database.db1.prefix     = or_                   ; table praefix
database.db1.persistent = yes                   ; persistent connections
database.db1.charset    = UTF-8
database.db1.connection_sql = "SET NAMES 'UTF8';"
database.db1.cmd = ""
database.db1.prepare = false
database.db1.transaction = false
database.db1.readonly = false

;interface.override_title = "Your company"
;login.motd="Have a good day"

;log.file = "" ; filename of logfile (must be writable)

;mail.enabled=true ; Does your server send e-mails?
;mail.from="OpenRat <user@example.com>"


; There are a lot of more configuration settings available, see file 'config.ini.php'...
