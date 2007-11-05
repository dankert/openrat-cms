; <?php exit('direct access denied') ?>

; E-Mail Settings

; Does your server send e-mails?
; 'true' or 'false'
enabled=true

; The "from"-Adress. Creates a "From: "-Header.
; This is not neccecary. Hint: Most MTAs require a valid email adress.
;from="OpenRat <user@example.com>"

; This signature is appended at the end of a mail. Use ';' for line-breaks.
; A useful information is maybe the URL of your OpenRat installation.
signature="http://www.openrat.de"

; Copy Recipient
;cc=

; Blind Copy recipient
;bcc=

; Priority of the mail (creates an "X-Priority"-Header)
; 1=Highest, 2=High, 3=Normal, 4=Low, 5=Lowest
; Hint: Most MUAs ignore this header.
priority=3


; Non-7-bit-chars are not allowed in Mailheaders (see RFC 822, 2045, 2047)
; and must be encoded. Openrat supports 3 types of encoding:
; 'Quoted-printable' (default),
; 'Base64'
; '' (blank) no encoding.
header_encoding="Quoted-printable"


; Which SMTP client you want to use.
; 'php' : Internal PHP function mail().
; 'smtp': OpenRat internal SMTP-client
; If unsure, use the builtin PHP function. 
;client=smtp
client=php



; Settings for the internal SMTP client.
; If client='php', you have no need to change anything in this section.
[smtp]

; Relay host
; It is useful, to have your own relay host, as servers doing greylisting
; *will* deny our smtp try.
; If this is blank, the mail is delivered directly to the destination MX host.
; I repeat, it is better to always use a relay host!
;host="mail.yourdomain.example"
host="locahost"

; SMTP-Port is '25' in most environments
port="25"

; SMTP Authentication
; (only needed if using a relay host)
; (FYI: The client makes use of the SMTP "AUTH LOGIN" method.
auth_username="your.user@something.example"
auth_password="notsecret"

; Timeout in seconds
timeout="45"

; Your fully-qualified hostname (FQDN)
; if empty, Openrat will use your simple hostname
localhost=
;localhost="your.fully.qualified.hostname.example"

; Use TLS
; The client will send a "STARTTLS" command after HELO.
; TLS is not tested, use at your own risk!
tls=false

; Use SSL
; The client will connection using the SSL-protocol.
; This is not tested, use at your own risk!
ssl=false
