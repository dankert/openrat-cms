page
	window name:GLOBAL_TEMPLATES

		list list:templates extract:true
			row class:data
				cell
					link url:var:url target:cms_main
						text var:name

		if empty:templates
			row
				cell class:help
					text text:GLOBAL_NO_TEMPLATES_AVAILABLE_DESC

