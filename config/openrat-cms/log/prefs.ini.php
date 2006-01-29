; <?php exit('direct access denied') ?>

file        = ""                    ; logfile ( blank if no logging )
level       = "trace"               ; loglevel 'trace','debug','info','warn','error'
date_format = "M j H:i:s"           ; date format
dns_lookup  = false                 ; lookup hostname of client-IP 
format      = "%time %level %host %user %action %text"   ; format
