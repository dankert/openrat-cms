; <?php exit('direct access denied') ?>


; Logfile settings


; filename of logfile. Every log entry will be appended to this file.
; This file must be writable by the webserver.
; If blank (default), no logging will be done.
file = ""

; loglevel are one of 'trace','debug','info','warn','error'
level = "warn"

; date format (for variable %time, see 'format'. This format is used by PHPs date()-function.
; See http://www.php.net/date
date_format = "M j H:i:s"
       
; lookup hostname of client-IP
; this may increase performance, if 'true'. Be careful!
dns_lookup = false

; output format
; the following variables are replaced:
; %time by the current time of the log entry.
; %level the logging level
; %host client ip ore hostname (see 'dns_lookup' entry above)
; %user username, who is logged in, ore '-' if not logged in.
; %action what is happening now
; %text reason of the log entry
format = "%time %level %host %user %action %text"
