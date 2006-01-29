page
	form action:file subaction:douncompress
		window name:asdf title:asdfdfs
			#row
			#	cell
			#		text text:type
			#	cell
			#		set var:gz value:gz
			#		selectbox list:formats name:format default:gz
			row
				cell
				cell
					set var:field value:replace
					radio name:field value:true
					text text:replace
					newline
					radio name:field value:false
					text text:createnew
			row
				cell colspan:2
					button type:ok