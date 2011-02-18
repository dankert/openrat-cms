part class:title

	// Datenbank anzeigen
	image icon:database align:left
	if present:dbname
		text title:message:database var:dbname maxlength:25
#		text raw:_-_
#		part class:dropdown
#			list list:databases key:id value:name
#				link class:entry action:index subaction:logout var1:dbid value1:var:id target:content
#					text var:name
	text var:cms_title title:var:buildinfo
			
		
#if present:modelname
#	part
#		link action:model subaction:listing target:content
#			image icon:model align:left
#			text title:message:model var:modelname maxlength:20
#		part class:dropdown
#			list list:models key:id value:name
#				link class:entry action:tree subaction:load var1:modelid value1:var:id target:tree
#					text var:name
#		
#if present:languagename
#	part
#		link action:language subaction:listing target:content
#			image icon:language align:left
#			text title:message:language var:languagename maxlength:20
#		part class:dropdown
#			list list:languages key:id value:name
#				link class:entry action:tree subaction:load var1:languageid value1:var:id target:tree
#					text var:name

#if present:dbname
#	part class:logout
#		link title:message:USER_LOGOUT_DESC action:login subaction:logout target:content
#			image icon:close align:left
#			text key:USER_LOGOUT
		
part class:search
	form
		image icon:search
		input name:text value:message:search
		part class:dropdown
			text raw:
		
part class:user
	// Benutzer-Funktionen
	link title:message:USER_PROFILE_DESC action:profile subaction: target:content
		image icon:user align:left
		text var:userfullname maxlength:20
	part class:dropdown
		link title:message:USER_PROFILE_DESC action:profile subaction: target:content
			image icon:user align:left
			text key:profile
		
		if true:method:userIsAdmin
			link class:entry action:tree subaction:content target:tree var1:projectid value1:-1
				image icon:administration align:left
				text key:administration
				
		link class:entry title:message:USER_LOGOUT_DESC action:login subaction:logout target:content
			image icon:close align:left
			text key:USER_LOGOUT

part class:history
	// Benutzer-Funktionen
	image icon:history align:left
	text key:history maxlength:20
	part class:dropdown
		text raw:

part class:projects
	// Titel anzeigen				
	image icon:project align:left
	text key:projects
	part class:dropdown
		list list:projects key:id value:name
			image icon:project
			link class:entry action:tree subaction:content var1:projectid value1:var:id target:tree
				text var:name maxlength:20
