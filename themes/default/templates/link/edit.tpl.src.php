dummy
	form
		window
			fieldset
	
				part
					radio name:type value:url
					label for:type_url
						text text:link_url
					input name:url
				part
					radio name:type value:link
					label for:type_link
						text text:link_target
					selectbox list:objects name:targetobjectid
					
			button type:ok

	focus field:name
