page title:message:MENU_INDEX_APPLICATIONS
	window width:600 icon:project

		row
			cell colspan:2 
				link action:index subaction:projectmenu
					text text:OpenRat

		list list:applications extract:true

			row
				cell 
					link url:var:url
						text text:var:name
				cell 
					text text:var:description

									