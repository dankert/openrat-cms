page
	window name:TEMPLATE_ELEMENTS
		list list:el extract:true
			row class:data
				cell
					link url:var:url title:var:desc
						image elementtype:var:type
						text var:name
				cell
					text key:var:type prefix:EL_

		row
			cell
				link class:action action:template subaction:addel
					text key:menu_template_addel
		if empty:el
			row
				cell colspan:2
					text key:GLOBAL_NOT_FOUND