; <?php exit('direct access denied') ?>

; Database configuration

; This database will be selected by default.
; There has to exist an section with this name.
default=db1

[db1]

; Database configuration for connection 'db1

enabled    = true
comment    = "OpenRat Example DB"  ; comment of this database 

type       = mysql                 ; 'mysql' or 'postgresql' 
user       = dbuser                ; database user
password   = dbpass                ; database password
host       = localhost             ; database hostname
;port                              ; database TCP/IP-Port (optional)
database   = cms                   ; database name

base64     = false                 ; store binary as BASE64 (in postgresql=true)
prefix     = or_                   ; table praefix
persistent = yes                   ; use persistent connections (try this, it's faster)


; Add here more sections with other database connections.
;[another_db]
;...