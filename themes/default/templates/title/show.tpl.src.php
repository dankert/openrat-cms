part
	// Datenbank anzeigen
	image icon:database align:left
	if present:dbname
		text title:message:database var:dbname maxlength:25
		text raw:_-_
	text var:cms_title title:var:buildinfo
			
if present:projectname
	part
		// Titel anzeigen				
		image icon:project align:left
		text title:message:project var:projectname maxlength:20
		part class:dropdown
			list list:projects key:id value:name
				link class:entry action:tree subaction:load var1:projectid value1:var:id target:tree
					text var:name
		
if present:modelname
	part
		link action:model subaction:listing target:content
			image icon:model align:left
			text title:message:model var:modelname maxlength:20
		part class:dropdown
			list list:models key:id value:name
				link class:entry action:tree subaction:load var1:modelid value1:var:id target:tree
					text var:name
		
if present:languagename
	part
		link action:language subaction:listing target:content
			image icon:language align:left
			text title:message:language var:languagename maxlength:20
		part class:dropdown
			list list:languages key:id value:name
				link class:entry action:tree subaction:load var1:languageid value1:var:id target:tree
					text var:name

if present:dbname
	part class:logout
		link title:message:USER_LOGOUT_DESC action:index subaction:logout target:content
			image icon:close align:left
			text key:USER_LOGOUT
		
part class:user
	// Benutzer-Funktionen
	link title:message:USER_PROFILE_DESC action:profile subaction: target:content
		image icon:user align:left
		text var:userfullname maxlength:20
		
if true:method:userIsAdmin
	part class:user
		// Benutzer-Funktionen
		link action:tree subaction:load target:tree var1:projectid value1:-1
			image icon:administration align:left
			text key:administration
				