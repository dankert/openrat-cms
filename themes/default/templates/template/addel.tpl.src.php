page
	form
		window name:GLOBAL_TEMPLATES
	
			row
				cell class:fx
					text text:global_name
				cell class:fx
					input name:name
	
			row
				cell class:fx
					text text:global_description
				cell class:fx
					inputarea name:description
	
			row
				cell class:fx
					text text:element_type
				cell class:fx
					set var:text value:text
					selectbox list:types default:text name:type
	
			row
				cell class:act colspan:2
					button type:ok
	
		focus field:name