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

		if empty:el
			row
				cell colspan:2
					text key:GLOBAL_NOT_FOUND