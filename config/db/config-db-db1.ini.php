; <!-- $Id$ -->
; <?php exit ?>

; Database configuration

comment    = "OpenRat DB"          ; comment of this database 

type       = mysql                 ; 'mysql' or 'postgresql' 
user       = dbuser                ; database user
password   = dbpass                ; database password
host       = localhost             ; database hostname
;port                              ; database TCP/IP-Port (optional)
database   = cms                   ; database name

base64     = false                 ; store binary as BASE64 (in postgresql=true)
prefix     = or_                   ; table praefix
persistent = yes                   ; use persistent connections

; ................................ ;