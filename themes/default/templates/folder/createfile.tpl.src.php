page
	form enctype:multipart/form-data
		hidden name:type default:file

		window title: name:
			row
				cell class:fx
					text text:global_FILE
				cell class:fx
					upload name:file
			row
				cell class:fx
					text text:global_NAME
				cell class:fx
					input name:name size:50
			row
				cell class:fx
					text text:global_DESCRIPTION
				cell class:fx
					inputarea rows:5 cols:50 name:description
			row
				cell class:act colspan:2
					button type:ok

	focus field:name
