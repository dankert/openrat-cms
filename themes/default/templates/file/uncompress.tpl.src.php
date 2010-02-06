page
	form
		window name:asdf title:asdfdfs
			#row
			#	cell
			#		text text:type
			#	cell
			#		set var:gz value:gz
			#		selectbox list:formats name:format default:gz
			row
				cell colspan:2
					fieldset title:message:options
			row
				cell
				cell
					set var:replace value:1
					radio name:replace value:1
					label for:replace_1
						text key:replace
					newline
					radio name:replace value:0
					label for:replace_0
						text key:new
			row
				cell class:act colspan:2
					button type:ok