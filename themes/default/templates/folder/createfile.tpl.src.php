page
	form enctype:multipart/form-data
		hidden name:type default:file

		window title: name:
			#row
			#	cell colspan:2
			#		fieldset title:message:file
			row
				cell
					text text:global_FILE
				cell
					upload name:file maxlength:var:maxlength
			row
				cell colspan:2
					text class:help key:file_max_size
					text raw:_
					text var:max_size
					newline
					newline
			row
				cell
					text key:HTTP_URL
				cell
					input name:url size:50
			row
				cell colspan:2
					fieldset title:message:description
			row
				cell
					text text:global_NAME
				cell
					input name:name size:50
			row
				cell
					text text:global_DESCRIPTION
				cell
					inputarea rows:5 cols:50 name:description
					newline
			row
				cell class:act colspan:2
					button type:ok

	focus field:name
