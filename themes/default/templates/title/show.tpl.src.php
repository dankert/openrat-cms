page class:title

	table padding:5 space:0 width:100%
		row
			// Datenbank anzeigen
			cell class:title width:30%
				image icon:database align:left
				text title:message:database var:dbname maxlength:25
				text raw:_-_
				text var:cms_title
					

			// Titel anzeigen				
			cell class:title width:40% style::text-align:center;
				if present:projectname
					text title:message:project var:projectname maxlength:20
				if present:modelname
					text raw:_(
					text title:message:model var:modelname maxlength:20
					text raw:,
					text title:message:language var:languagename maxlength:20
					text raw:)

			// Benutzer-Funktionen
			cell class:title width:20% style::text-align:right;

				link title:message:USER_PROFILE_DESC url:var:profile_url target:cms_main_main
					image icon:user align:right
					text var:userfullname maxlength:20
					
			cell class:title width:10% style::text-align:right;

				link title:message:USER_LOGOUT_DESC url:var:logout_url target:_top
					image icon:close align:right
					text key:USER_LOGOUT
					
					