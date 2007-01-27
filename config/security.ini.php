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
; 'authdb'   uses an external database table as password store, see section [authdb] which has to exist.  
; 'ldap'     uses an external LDAP directory for password checking.  
type=database

; per-user setting of the LDAP DN.
; 'true'  users which have there LDAP-DN explicitly stored are authenticated against LDAP.
; 'false' no LDAP-DN storage per user.
userdn=false



; password settings
[password]

; length of automatic generated password
random_length=8

; minimum passwort length
min_length=5



; this section is needed if the setting "auth/type" is 'authdb'.
; passwords are stored against an external database table.
; This is quite useful, if you have another software running (f.e. a forum system)
; and so the user must only remember 1 password.
[authdb]

; 'mysql' or 'postgresql'
type = postgresql

user = dbuser
password = dbpassword
host = 127.0.0.1
database = dbname
persistent = false

; the sql which is executed while checking the password.
; the variables {username} and {password} are replaced.
sql = "select 1 from table where user={username} and password=md5({password})"

; if the user exists in the external database, should it
; automatically be inserted into the openrat internal table?  
add = true
