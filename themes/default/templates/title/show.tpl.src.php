page class:title

	table padding:5 space:0 width:100%
		row
			// Datenbank anzeigen
			cell class:title width:30%
				image icon:database align:left
				text title:message:database var:dbname
				text raw:_-_
				text var:cms_title

			// Titel anzeigen				
			cell class:title width:40% style::text-align:center;
				if present:projectname
					text title:message:project var:projectname
				if present:modelname
					text raw:_(
					text title:message:model var:modelname
					text raw:,
					text title:message:language var:languagename
					text raw:)

			// Benutzer-Funktionen
			cell class:title width:30% style::text-align:right;

				image icon:user align:right
				link title:message:USER_LOGOUT_DESC url:var:logout_url target:_top
					text key:USER_LOGOUT
				text raw:_(
				link title:message:USER_PROFILE_DESC url:var:profile_url target:cms_main_main
					text var:userfullname
					text raw:)
