; <!-- $Id$ -->
; <?php exit('direct access denied') ?>

; main configuration file for OpenRat
; Lines beginnung with a semicolon are comments. Empty lines are ignored.


[database]
dir      = ./config/db/  ; directory which contains database configuration
prefix   = config-db-    ; praefix of database configuration files
suffix   = .ini.php      ; suffix  of database configuration files
default  = db1           ; preselected database (used, if http-auth is wanted)

[auth]
type     = form          ; (http|form) 'form' is a good choice. if 'http' max. 1 database connection available.

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


[cache]
conditional_get      = true         ; Conditional-GET enables the "304 not modified" HTTP-Header
                                    ; This  is much faster, but sometimes caching is unwanted

[interface]
tree_width           = "25%"        ; width of navigation frame (tree)
file_separator       = " &raquo; "  ; chars between directory names
nice_urls            = false        ; if 'true' you need special rewrite rules in a .htaccess file!
url_sessionid        = false        ; only needed if cookies and transid not available 
theme                = default      ;
language             = en           ; default language
use_browser_language = true         ; use HTTP_ACCEPT_LANGUAGE header to determine language
show_duration        = false        ; Show duration on every page
timeout              =              ; Request timeout in seconds (blank=system default)
override_title       =              ; Replace the default title (Program name+version) with this text
min_width            = 950          ; Minimal Width of the browser window. If smaller, then tree is initally disabled.


[login]
logo="./themes/default/images/logo.jpg"  ; logo (url to image) in login mask 
logo_url="http://www.openrat.de"         ; linked url in login mask 
motd=""                                  ; Message of the day, shown in login mask 
nologin=false                            ; Disable Login (for maintanance jobs)



[filename]
edit    = true           ; Allow editing of filenames (true|false)
default = index          ; filename of index file. Default: 'index'.

;style  = ss             ; poor imitation of story server urls
;style  = id             ; simply use the object id for the url
;style  = longid         ; use a more longer id in the url
style   = short          ; use a url which is as short as possible
; hint: If edit=true, then the stored filename will be used.
;       If no filename stored, or if edit=false, then the defined style is used. 

url=relative             ; how the target url is referenced (relative|absolute), 'relative' is always a good choice.


[mail]
enabled=true                        ; Enable sending E-Mails
from="OpenRat <user@example.com>"   ; Sender Adress
signature="http://www.openrat.de"   ; Signature (blank if unused)


[security]
random_password_length = 8          ; length of automatic generated password
min_password_length    = 4          ; minimum passwort length
readonly  = false                   ; All is readonly (for maintanance jobs)
nopublish = false                   ; Disable publishing


[text-markup]
strong-begin = *
strong-end   = *

emphatic-begin = _
emphatic-end   = _

image-begin = "{"
image-end   = "}"

speech-begin = "\""
speech-end   = "\""

code-begin = "="
code-end   = "="

pre-begin = "="
pre-end   = "="

insert-begin = ++
insert-end   = ++

remove-begin = --
remove-end   = --

definition-sep = ":"
headline       = "+"

list-unnumbered = "-"
list-numbered   = "#"

linkto="->"
table-cell-sep="|"

style-begin = "'"
style-end   = "'"



[html]
tag_teletype = tt
tag_emphatic = em
tag_strong   = strong
tag_speech   = cite
speech_open  = "&bdquo;"
speech_close = "&rdquo;"



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