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
; 'http'     uses an HTTP-Auth Server for password checking (TODO)  
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



; SSL Client certificate Authentication
[ssl]

; The environment variable name which has the username out of the certificate.
; See modssl-configuration for more infos:
; http://httpd.apache.org/docs/2.0/mod/mod_ssl.html.en#envvars
; if blank, ssl client auth is unused (default)  
user_var=
;user_var="REMOTE_USER"
;user_var="SSL_CLIENT_S_DN"
;user_var="SSL_CLIENT_S_DN_CN"

; if 'true', you trust the client certificate fully, this is a passwordless login!
; take care tto have an useful webserver configuration where you only trust CA-signed certificates.
; if 'true', the 'user_var' is needed.  
trust=false



; Single Sign-on
; These settings are an example for checking login against "PhpMyAdmin".
; PhpMyAdmin must include a link to Openrat with the authid which includes the serialized cookies.
; Example: Include this in the file .../phpmyadmin/main.php:
; <a href="https://example.com/openrat/?authid=<?php echo urlencode(serialize($_COOKIE)) ?>">OpenRat</a>
[sso]

; use single sign-on? Set to 'true' or 'false'.
enable=false

; the url against the auth-id will be checked.
;url="http://localhost/check.php?phpsessid={id}&check=true"
url="https://www.example.com/phpmyadmin/main.php?server=1"

; the name of the parameter, where OpenRat will receive the Id, which will then be checked.
auth_param_name=authid

; is the auth-id serialized?
auth_param_serialized=true

; the auth-id will be used as a cookie
cookie=true

; if the auth-id is no array, use this cookie-name.
cookie_name=

force=true

; leave this blank.
expect=

; this is a regular expression which checks, if the login at the third-party-system is ok.
expect_regexp="/running on/"

; regular expression for find out the username
; this example is used for "PhpMyAdmin"
username_regexp="/running on localhost as ([a-z]+)@localhost/"
