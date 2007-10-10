page
	form
		window name:GLOBAL_TEMPLATES
	
			row
				cell
					text text:message:name
				cell
					input name:name
			row
				cell
					text text:message:copy
				cell
					selectbox name:templateid list:templates addempty:true 
			row
				cell colspan:2 class:act
					button type:ok
	
	focus field:name