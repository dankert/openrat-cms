page
	form enctype:multipart/form-data
		hidden name:type default:file

		window title: name:
			row
				cell colspan:2
					fieldset title:message:file
			row
				cell class:fx
					text text:global_FILE
				cell class:fx
					upload name:file maxlength:var:maxlength
			row
				cell colspan:2
					text class:help text:message:file_max_size
					text raw:_
					text text:var:max_size
					newline
					newline
			row
				cell colspan:2
					fieldset title:message:description
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
					newline
			row
				cell class:act colspan:2
					button type:ok

	focus field:name
