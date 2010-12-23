part
	// Datenbank anzeigen
	image icon:database align:left
	text title:message:database var:dbname maxlength:25
	text raw:_-_
	text var:cms_title title:var:buildinfo
			
part
	// Titel anzeigen				
	if present:projectname
		image icon:project align:left
		text title:message:project var:projectname maxlength:20
		
part
	image icon:model align:left
	if present:modelname
		text title:message:model var:modelname maxlength:20
		
if present:languagename
	part
		image icon:language align:left
		text title:message:language var:languagename maxlength:20

part class:logout
	link title:message:USER_LOGOUT_DESC action:index subaction:logout target:content
		image icon:close align:left
		text key:USER_LOGOUT
		
part class:user
	// Benutzer-Funktionen
	link title:message:USER_PROFILE_DESC action:profile subaction: target:content
		image icon:user align:left
		text var:userfullname maxlength:20
		