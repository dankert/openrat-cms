dummy
	window
		table
			row class:headline
				cell
					text key:name
				cell
					text key:type
			list list:el extract:true
				row class:data
					cell url:var:url
						image elementtype:var:type
						text var:name
					cell
						text key:var:type prefix:EL_
	
			row
				cell class:data
					link class:action action:template subaction:addel
						text key:menu_template_addel
			if empty:el
				row
					cell colspan:2
						text key:GLOBAL_NOT_FOUND