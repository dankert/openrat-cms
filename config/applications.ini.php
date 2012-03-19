; <?php exit('direct access denied') ?>


; Start other applications out of OpenRat.
;
; Other applications are able to authenticate the user with an ticket id (Single Signon)

; Insert a new section for every application here
;[phpmyadmin]

; The Name of the application
;name=PHPYourAdmin

; URL
;url="https://example.com/anotherapplication/index.cgi"

; Name of the HTTP-Parameter for the Ticket-Id.
; OpenRat puts the session-id into this parameter.
;param="ticketidforopenrat"

; Groups
; Only User, who are in this group, may see the application
; (optional)
;group=

; A brief description of this application.
description="Your database administration"
