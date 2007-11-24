page
	form
		window name:GLOBAL_PROP
			row
				cell
					text text:TEMPLATE_NAME
				cell
					input name:name
			row
				cell colspan:2
					fieldset
			row
				cell
					text text:message:file_extension
				cell
					link action:template subaction:extension
						text text:var:extension
			row
				cell
					text text:message:file_mimetype
				cell
					link action:template subaction:extension
						text text:var:mime_type
			row
				cell colspan:2 class:act
					button type:ok

	focus field:name