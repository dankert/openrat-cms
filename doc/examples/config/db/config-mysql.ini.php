; <!-- $Id$ -->
; <?php exit ?>

; Konfigurationsdatei fuer Datenbankverbindung

comment    = "OpenRat Datenbank"   ; beliebiger Text der diese Datenbank beschreibt
type       = mysql                 ; moegliche Werte: 'mysql' oder 'postgresql' 
user       = dbuser                ; Datenbank-Benutzer
password   = dbpass                ; Datenbank-Kennwort
host       = localhost             ; Adresse desDatenbank-Servers
;port                              ; TCP/IP-Port (optional)
database   = cms                   ; Logischer Name der Datenbank
base64     = false                 ; Binaerdateien als BASE64 speichern (in Mysql=false, in Postgresql=true)
prefix     = or_                   ; Praefix der Tabellen
persistent = yes                   ; Persistene Datenbankverbindungen (schneller)

; ................................ ;