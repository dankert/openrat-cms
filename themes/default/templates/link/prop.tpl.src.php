page
	form
		window

			fieldset title:message:global_prop

				part
					label for:name					
						text text:GLOBAL_name
					input name:name class:name

				part
					label for:description				
						text text:GLOBAL_description
					inputarea name:description class:description

			if not:mode:edit
				fieldset title:message:additional_info
					part
						label for:objectid
							text key:id
						text var:objectid
						
				fieldset title:message:prop_userinfo
					part
						label for:
							text text:global_created
						image icon:el_date
						date date:var:create_date
						image icon:user
						user user:var:create_user
					part
						label for:
							text text:global_lastchange
						image icon:el_date
						date date:var:lastchange_date
						image icon:user
						user user:var:lastchange_user
						
			button type:ok

	focus field:name
