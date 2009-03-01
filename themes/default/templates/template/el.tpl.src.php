page
	window name:TEMPLATE_ELEMENTS
		list list:el extract:true
			row
				cell class:fx
					link url:var:url title:var:desc
						image elementtype:var:type
						text var:name
				cell class:fx
					text key:var:type prefix:EL_

		if empty:el
			row
				cell colspan:2 class:fx
					text key:GLOBAL_NOT_FOUND