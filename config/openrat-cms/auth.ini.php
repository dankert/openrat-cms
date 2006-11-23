; <?php exit('direct access denied') ?>

; Type of authorization.
; 'http' uses the HTTP Basic Authrization.
;        Only available if PHP is used in the module version.
;        Not available, if PHP is used via the CGI way.
;        Only the default database is available (because there is no way to select another one)
; 'form' shows a login form via a HTML page (default).

type=form
;type=http
