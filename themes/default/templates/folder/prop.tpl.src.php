page

	form
		window name:objectName title:global_prop icon:folder widths:35%,65% width:70%
			row
				cell
					text text:global_name
				cell class:name
					input name:name size:50 class:name
			row
				cell
					text text:global_filename
				cell class:filename
					input name:filename class:filename
			row
				cell
					text text:global_description
				cell
					inputarea name:description class:description

			row
				cell colspan:2
					fieldset title:message:additional_info
						if false:mode:edit
							label for:full_filename
								text key:FULL_FILENAME
							text var:full_filename
							newline
						label for:objectid
							text key:id
						text var:objectid
			row
				cell colspan:3
					fieldset title:message:PROP_USERINFO
						part class:label
							text text:global_created
						image icon:el_date
						date date:var:create_date
						image icon:user
						user user:var:create_user
						
						newline
						part class:label
							image icon:el_date
							date date:var:lastchange_date
						image icon:user
						user user:var:lastchange_user
	

			row
				cell colspan:2 class:act
					button type:ok
	focus field:name