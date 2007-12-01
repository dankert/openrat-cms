; <?php exit('direct access denied') ?>

motd=""                                  ; Message of the day, shown in login mask 
nologin=false                            ; Disable Login (for maintanance jobs)
register=false
send_password=false

[gpl]
url="http://www.gnu.org/copyleft/gpl.html"

[logo]
file="./themes/default/images/logo.jpg"  ; logo (url to image) in login mask 
url="http://www.openrat.de"              ; linked url in login mask 


[start]
; After Login, start with the last changed object.
; If 'true', the project menu is not displayed.
start_lastchanged_object=true