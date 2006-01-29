page

	window name:x title:TEMPLATE_ELEMENTS widths:30%,50%,20%
		if empty:el invert:true
			row
				cell class:help
					text text:PAGE_ELEMENT_NAME
				cell class:help
					text text:PAGE_ELEMENT_VALUE
				cell class:help
					text text:GLOBAL_ARCHIVE
		if empty:el
			row
				cell 
					text text:GLOBAL_NOT_FOUND
		list list:el extract:true
			row
				cell class:fx
					link url:url title:desc
						image elementtype:type align:left
						text var:name
				cell class:fx
					text var:value
					text raw:_
				cell class:fx
					link url:archive_url
						text text:GLOBAL_ARCHIVE
					text raw:_(
					text var:archive_count
					text raw:)
		row
			cell class:help colspan:3
				text text:PAGE_ELEMENTS_DESC
		row
			cell colspan:3
				text raw:_
