dummy

	window
		form
			fieldset title:message:GLOBAL_PROP
				part
					label for:name
						text text:global_name
					input name:name size:50 class:name
					
				part
					label for:filename
						text text:global_filename
					input name:filename class:filename
					
				part
					label for:description
						text text:global_description
					inputarea name:description class:description

			if false:mode:edit
				fieldset title:message:additional_info
					if false:mode:edit
						label for:full_filename
							text key:FULL_FILENAME
						text var:full_filename
						newline
					label for:objectid
						text key:id
					text var:objectid
					
				fieldset title:message:PROP_USERINFO
					part
						label for:create_user
							text text:global_created
						image icon:el_date
						date date:var:create_date
						image icon:user
						user user:var:create_user
					
					part
						label for:lastchange_user
							text text:global_lastchange
						image icon:el_date
						date date:var:lastchange_date
						image icon:user
						user user:var:lastchange_user


			button type:ok
			focus field:name