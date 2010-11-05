; <?php exit('direct access denied') ?>

; Security settings for Openrat - be careful :)



; All is readonly (for maintanance jobs)
; true|false, default:false
readonly=false

; Disable publishing
nopublish=false

; Unix-UMask for all created files
; Default: none (uses system default)
; Example: '0022' (means '-rw-r--r--')
; Example: '0002' (means '-rw-rw-r--')
umask=

; CHMOD for created files
; Default: none
; Example: '0644' (means '-rw-r--r--')
; Example: '0755' (means '-rwxr-xr-x')
chmod=

; CHMOD for created directories
; Default: none
; Example: '0755' (means 'drwxr-xr-x')
; Example: '0770' (means 'drwxrwx---')
chmod_dir=

; You may disable dynamic code.
; dynamic code ("CODE"-Elements in templates) are dangerous, because they may
; interact with the file system (and much more!).
;
; Hint: only admin users are allowed to save dynamic code.
; Enable, if admin users are trustful.
; Disable, if admin users are anonym (f.e. demo-installations).
; Default: true (for secure default installation).
disable_dynamic_code = true


; Enable or disable the displaying of system information
show_system_info = true


; Useful against CSRF-attacks, this adds a token to all POST request.
use_post_token=true

; Creates a new Session on login.
; Useful against session fixation attacks.
renew_session_login=false

; Creates a new Session on logout.
; Useful against session fixation attacks. 
renew_session_logout=false



; Default Login
; These values are used for the login form.
[default]

; default: ''
username=

; default: ''
password=



; Guest Login
; if enabled, a named guest user is automatically logged in.
[guest]

; enable auto-login for a guest user.
enable=false

; Name of the guest user, who is automatically logged in.
; This user must exist in your user database.
user=guest



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
; 'ldap'     uses an external LDAP directory for password checking, see file "ldap.ini.php".
; 'http'     uses an HTTP-Auth Server for password checking 
type=database

; per-user setting of the LDAP DN.
; 'true'  users which have there LDAP-DN explicitly stored are authenticated against LDAP.
; 'false' no LDAP-DN storage per user.
userdn=false



[authorize]
; A user belongs to certain groups. This information can be stored in 2 ways.
; 'database' uses the internal database for the user-group-relation. (default)
; 'ldap' reads the user-group-relations in a LDAP-Directory
;        (in this case, /security/auth/type has to be set to "ldap", too!)
;        (see /ldap/authorize!)
type=database
;type=ldap



; password settings
[password]

; length of automatic generated password
random_length=8

; minimum passwort length
min_length=5

; Password "salt"
; ''        : no salt (default)
; 'id'      : salt the password with userid
; 'username': salt the password with username
; 'custom'  : use the 'salt_text'-setting
salt = ""

salt_text = "somerandomtext"



; this section is needed if the setting "auth/type" is 'http'.
; passwords are checked against another HTTP-Server with Basic Authorization.
[http]

; The URL where an HTTP basic authorization ist required.
url = "http://example.net/restricted-area"



; this section is needed if the setting "auth/type" is 'authdb'.
; passwords are stored against an external database table.
; This is quite useful, if you have another software running (f.e. a forum system)
; and so the user must only remember 1 password.
[authdb]

; 'mysql', 'postgresql' or 'sqlite'
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



; Open-ID
; see http://openid.net/ for specifications and more informations.
[openid]

; Enable Open-ID
; default=false
enable=false

; Should authenticated users, which are not in your user database, automatically be added?
; default=false
add=false

; Open-Id Logo
; The specification recommends the original Open-Id logo. 
;logo_url=
logo_url="http://openid.net/login-bg.gif"

; Trust-Root
; URL-Prefix in which your OpenRat installations are running.
; default=<empty> (OpenRat tries to use its own server name) 
;trust_root=http://your.server.example/openrat/
trust_root=

; Trustful servers
; Default='' (all)
;trusted_server=openid1.example.com,openid2.example.com
trusted_server=

; Should Users fullname and e-mail updated from the OpenId-Server?
update_user=true

; Using User-Identitys?
user_identity=true

; List of OpenId-Provider to use
; Special name "identity" for user defined identitys
;provider=example
provider=google

; location of the providers Yadis-document (XRDS-file)
provider.example.xrds_uri=http://google.com/accounts
; which attribute is used for mappin to the internal database
;provider.example.map_attribute=email
; which attribut of internal user database is used
; valid values are 'mail', 'username'
;provider.example.map_internal=mail

; Google supports Open-Id 2.0
provider.google.xrds_uri=http://google.com/accounts/o8/id
provider.google.map_attribute=email
provider.google.map_internal=mail

; Yahoo
provider.yahoo.xrds_uri=http://??????
provider.yahoo.map_attribute=usename
provider.yahoo.map_internal=mail



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



; Settings for a new user
[newuser]

; These groups are automatically added while a new user is inserted.
groups=YourGroup,AnotherGroup



; Logout settings
[logout]

; Redirect to this URL after logout
; <blank>= Show Login.
; Default: ""
;redirect_url="http://your.intranet.example/"
redirect_url=



[user]

; Show E-Mail-Adress in Administration-Interface.
; Default=true. If admin users should not know the mail adresses, set this to false.
; Useful for Demo-Installations where a lot of users may have administration rights. 
show_admin_mail=true

; Show users e-mail-address to other users.
; Default=true. 
show_mail=true

; Users are able to send mesages to another users via e-mail
; (not yet implemented)
send_message=true
