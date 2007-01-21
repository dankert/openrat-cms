; <?php exit('direct access denied') ?>

; Openrat is able to check passwords against a LDAP-based directory.

host="localhost"      ; host of ldap server  
port="389"            ; port of ldap server
protocol="2"          ; protocol version ('2' or '3')


; Settings for authentication against a LDAP directory
; This is only activated, if the setting '/security/auth/type' is 'ldap'.
[search]

; use of anonymous bind ('true' or 'false')
; if 'true', the following user and password settings are ignored.
anonymous = true

; if 'anonymous' is 'false': DN of technical user for searching the real user DN
user      = "uid=openrat,ou=users,dc=example,dc=com"

; if 'anonymous' is 'false': password of technical user
password  = "verysecret"

; Base-DN of the subtree where the search begins
basedn    = "dc=example,dc=com"

; Filter setting for searching the user objects.
; The string {user} will be replaced by the user name.
filter    = "(uid={user})"

; Aliases are dereferenced ('true' or 'false')
aliases   = true

; Timeout in seconds
timeout   = 30

; If the user is found in the LDAP tree, but is not yet stored in the internal database.
; 'true'  the user will be logged in and automatically inserted in the internal database.
; 'false' login will be rejected, all users must exist in the internal database.
add       = true

