; <!-- $Id$ -->
; <?php exit('direct access denied') ?>

; main configuration file for OpenRat
; Lines beginnung with a semicolon are comments. Empty lines are ignored.


[database]
dir      = ./config/db/  ; directory which contains database configuration
prefix   = config-db-    ; praefix of database configuration files
suffix   = .ini.php      ; suffix  of database configuration files
default  = db1           ; preselected database (used for http-auth)

[auth]
type     = form          ; 'http' or 'form'  (must 'form' for more than 1 database connection)

[ldap]
host     =               ; host of ldap server ( blank if not used )  
port     =               ; port of ldap server ( blank if not used )


[ftp]
ascii    = html,htm,php  ; file extensions to use FTP ascii mode for


[publish]
filename = edit            ; filename-mode 'ss','crc32','md5','edit' or 'id'


[log]
file        = ""                    ; logfile ( blank if no logging )
level       = "trace"               ; loglevel 'trace','debug','info','warn','error'
date_format = "M j H:i:s"           ; date format
dns_lookup  = true                  ; lookup hostname of client-IP 
format      = "%time %level %host %user %action %text"   ; format


[image]
truecolor            = true         ; 'true' if GD2 is available, otherwise 'false'


[interface]
tree_width           = "25%"        ; width of navigation frame (tree)
file_separator       = " &raquo; "  ; chars between directory names
nice_urls            = false        ; if 'true' you need special rewrite rules in a .htaccess file!
url_sessionid        = false        ; only needed if cookies and transid not available 
theme                = default      ;
language             = en           ; default language
use_browser_language = true         ; use HTTP_ACCEPT_LANGUAGE header to determine language


[login]
logo=./themes/default/images/logo.jpg    ; url of logo in login mask 


[mail]
enabled=true                        ; Enable sending E-Mails
from="OpenRat <user@example.com>"   ; Sender Adress
signature="http://www.openrat.de"   ; Signature (blank if unused)


[security]
random_password_length=8            ; length of automatic generated password
min_password_length=4               ; minimum passwort length


[html]
tag_teletype_open    = "<tt>"       ; HTML-tag begin of teletype text
tag_teletype_close   = "</tt>"      ; HTML-tag end   of teletype text

tag_emphatic_open    = "<em>"       ; HTML-tag begin of emphatic text
tag_emphatic_close   = "</em>"      ; HTML-tag end   of emphatic text

tag_strong_open      = "<strong>"   ; HTML-tag begin of strong text
tag_strong_close     = "</strong>"  ; HTML-tag end   of strong text

tag_speech_open      = "&bdquo;"    ; HTML-tag begin of speech
tag_speech_close     = "&rdquo;"    ; HTML-tag end   of speech


[wiki]
convert_html         = true         ; convert simple HTML-tags to wiki-markup (if HTML is disabled)
convert_bbcode       = true         ; convert a few BB-code tags to wiki-markup
tag_strong           = "*"          ; how strong text is marked
tag_emphatic         = "_"          ; how emphatic text is marked


[replace]
euro   = "EUR,&euro;"   ; HTML-Markup of the EUR-sign 
copy   = "(c),&copy;"   ; HTML-Markup of copyright-char
; ... add useful replacements here


; END OF DOCUMENT