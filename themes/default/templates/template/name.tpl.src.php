dummy
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
					text key:file_extension
				cell
					link action:template subaction:extension
						text var:extension
			row
				cell
					text key:file_mimetype
				cell
					link action:template subaction:extension
						text var:mime_type
			row
				cell colspan:2 class:act
					button type:ok

	focus field:name