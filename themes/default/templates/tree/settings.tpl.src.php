window
	form
		fieldset title:message:languages
			list list:languages key:id value:name
				part
					radio name:languageid value:var:id
					label for:languageid value:var:id
						text var:name
		fieldset title:message:models
			list list:models key:id value:name
				part
					radio name:modelid value:var:id
					label for:modelid value:var:id
						text var:name
	button type:ok
