; <?php exit('direct access denied') ?>

; All is readonly (for maintanance jobs)
; true|false, default:false
readonly=false

; Disable publishing
nopublish=false

; Unix-UMask for saved files
; Default: 0002
umask=0002



[login]
; Type of authorization.
; 'http' uses the HTTP Basic Authrization.
;        Only available if PHP is used in the module version.
;        Not available, if PHP is used via the CGI way.
;        Only the default database is available (because there is no way to select another one)
; 'form' shows a login form via a HTML page (default).

type=form
;type=http



[auth]
; this is the backend where the passwords are checked against.
; 'database' uses the internal database table as password store.  
; 'ldap'     uses an external LDAP directory for password checking.  
type=database

; per-user setting of the LDAP DN.
; 'true'  users which have there LDAP-DN explicitly stored are authenticated against LDAP.
; 'false' no LDAP-DN storage per user.
userdn=false



[password]

; length of automatic generated password
random_length=8

; minimum passwort length
min_length=5
