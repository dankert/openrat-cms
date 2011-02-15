page
	window name:GLOBAL_TEMPLATES

		table
			row class:headline
				cell
					text key:name
			list list:templates extract:true
				row class:data
					cell url:var:url 
						text var:name

		if empty:templates
			text text:GLOBAL_NO_TEMPLATES_AVAILABLE_DESC

		link class:action action:template subaction:add
			text key:menu_template_add
				
