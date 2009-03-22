page
	form
		window name:GLOBAL_TEMPLATES
	
			row
				cell
					text text:global_name
				cell
					input name:name
	
			row
				cell
					text text:element_type
				cell
					set var:text value:text
					selectbox list:types default:text name:type
	
			row
				cell class:act colspan:2
					button type:ok
	
		focus field:name