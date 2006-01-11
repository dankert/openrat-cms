page
	form action:folder subaction:createnew enctype:multipart/form-data

		window title: name:
			row
				cell class:fx
					text text:global_NAME
				cell class:fx
					input type:file name:file
			row
				cell class:act colspan:2
					button type:ok

	focus field:file
