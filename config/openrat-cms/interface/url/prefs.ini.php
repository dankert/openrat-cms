; <?php exit() ?>

; faking urls
; for faking urls you HAVE TO create a url rewriting rule!
; If unsure, set to "false"
fake_url = false

; abc,xyz.1
;url_format= "%s,%s.%i"

; looks like Jakarta Struts: abc,xyz,1.do
url_format= "%s,%s,%d.do"

; You can create funny urls which look like asp,jsp,jsf and other crap :)
; Hint: Hiding the PHP interpreter *can* increase security.
; But remember, Security by obscurity is lame :)

; add the session ID as an URL-Parameter.
; useful, if you do not want cookies and trans_sid is not installed.
; if unsure, set to "false"
add_sessionid = false
