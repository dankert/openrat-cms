page
	window name:TEMPLATE_ELEMENTS
		list list:el extract:true
			row
				cell class:fx
					link url:url title:desc
						image type:type
						text var:name
				cell class:fx
					text text:type

		if empty:el
			row
				cell colspan:2 class:fx
					text text:GLOBAL_NOT_FOUND