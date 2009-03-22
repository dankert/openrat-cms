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
			row
				cell
					text key:id
				cell
					text var:objectid
			row
				cell colspan:2
					fieldset title:message:prop_userinfo
			row
				cell
					text text:global_created
				cell
					table
						row
							cell
								image icon:el_date
								date date:var:create_date
							cell
								image icon:user
								user user:var:create_user
			row
				cell
					text text:global_lastchange
				cell
					table
						row
							cell
								image icon:el_date
								date date:var:lastchange_date
							cell
								image icon:user
								user user:var:lastchange_user
						
			row
				cell colspan:2 class:act
					button type:ok

	focus field:name
