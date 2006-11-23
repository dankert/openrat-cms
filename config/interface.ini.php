; <?php exit('direct access denied') ?>

tree_width           = "25%"        ; width of navigation frame (tree)  (actually outdated!)
file_separator       = " &raquo; "  ; chars between directory names
nice_urls            = false        ; be aware: if 'true' you need special rewrite rules in a .htaccess file!
url_sessionid        = false        ; only needed if cookies and transid not available 
theme                = default      ;
show_duration        = false        ; Show duration on every page. Only useful for developers.
timeout              =              ; Request timeout in seconds (blank=system default)
override_title       =              ; Replace the default title (Program name+version) with this text
min_width            = 950          ; Minimal Width of the browser window. If smaller, then tree is initally disabled.

redirect             = false        ; use redirects before going to view (actually in testing)


[url]

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
