page
	window
		table
			row class:headline
				cell
					text key:name
					
			list list:el extract:true
		
				row class:data
					cell url:var:url
						image file:icon_group
						text var:name
			row
				cell
					link class:action action:group subaction:add
						text key:menu_group_add