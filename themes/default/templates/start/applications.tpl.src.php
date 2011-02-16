dummy
	window width:600 icon:project

		row
			cell colspan:2 
				link action:index subaction:projectmenu
					text raw:OpenRat

		list list:applications extract:true

			row
				cell 
					link url:var:url
						text var:name
				cell 
					text var:description

									