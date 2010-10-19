page class:title

	table padding:5 space:0 width:100%
		row
			// Datenbank anzeigen
			cell class:title width:20%
				image icon:database align:left
				text title:message:database var:dbname maxlength:25
				text raw:_-_
				text var:cms_title title:var:buildinfo
					

			// Titel anzeigen				
			cell class:title width:20%
				if present:projectname
					image icon:project align:left
					text title:message:project var:projectname maxlength:20
					
			cell class:title width:10%
				image icon:model align:left
				if present:modelname
					text title:message:model var:modelname maxlength:20
					
			cell class:title width:25%
				if present:languagename
					image icon:language align:left
					text title:message:language var:languagename maxlength:20

			// Benutzer-Funktionen
			cell class:title width:15%

				link title:message:USER_PROFILE_DESC url:var:profile_url target:cms_main_main
					image icon:user align:left
					text var:userfullname maxlength:20
					
			cell class:title width:10%

				link title:message:USER_LOGOUT_DESC url:var:logout_url target:_top
					image icon:close align:left
					text key:USER_LOGOUT
					
					