; <!-- $Id$ -->
; <?php exit('direct access denied') ?>

; WEBDAV-settings

enable=false

; Creation of new folders, files.
create=true

; Maximum filesize for uploaded files (in kB)
max_file_size=1000

; Readonly-Access.
readonly=true

; Set "X-powered-by"-Header?
expose_openrat = true

; Redirecting from "http://server/path/webdav.php"
;               to "http://server/<prefix><session-id>/webdav.php"
; This is a must-have for clients who do not use cookies.
; If 'true', a rewriting rule (.htaccess) is needed.
session_in_uri = false

; the prefix before the session id.
session_in_uri_prefix = ors

; Make some Microsoft-specific stuff (they cannot read RFCs):
; - Set "MS-Author-Via:"-Header
; Set to 'true', if you want to use lame clients like MS-Office, MS-IE, ...
; Set to 'false' for strict WEBDAV, but no MS-clients are doing the job...
;
compliant_to_redmond = true
