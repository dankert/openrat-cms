dummy
	form
		window name:GLOBAL_PROP
			row
				cell
					text text:TEMPLATE_extension
				cell
					radio name:type value:list
				cell
					selectbox list:mime_types name:extension addempty:true
			row
				cell
				cell
					radio name:type value:text
				cell
					input name:extensiontext size:10
			row
				cell colspan:3 class:act
					button type:ok

	focus field:extension