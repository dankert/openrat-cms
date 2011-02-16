dummy

	window name:x title:TEMPLATE_ELEMENTS widths:30%,50%,20%
		table
			if not: empty:el
				row class:headline
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
				row class:data
					cell
						link url:var:url title:var:desc
							image elementtype:var:type align:left
							text var:name
					cell
						text var:value
						text raw:_
					cell
						if present:archive_url
							link url:var:archive_url title:message:GLOBAL_ARCHIVE_DESC
								text text:GLOBAL_ARCHIVE
							text raw:_(_
							text var:archive_count
							text raw:_)
						else
							text text:GLOBAL_NO_ARCHIVE type:emphatic title:message:GLOBAL_NO_ARCHIVE_DESC
						set var:archive_url
			row
				cell class:help colspan:3
					text text:PAGE_ELEMENTS_DESC
					
		link action:page subaction:form title:message:menu_page_form_desc class:action 
			text key:menu_page_form
