page
	form
		window name:GLOBAL_PROP title:global_link icon:link width:70% widths:40%,60%
	
			row
				cell
					text text:GLOBAL_name
				cell class:name
					input name:name class:name
			row
				cell
					text text:GLOBAL_description
				cell
					inputarea name:description class:description

			row
				cell colspan:2
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
						
			row
				cell colspan:2 class:act
					button type:ok

	focus field:name
