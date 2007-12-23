page
	window icon:link width:70% widths:40%,60%
	
		row
			cell
				text text:GLOBAL_name
			cell class:name
				text var:name
		row
			cell
				text text:GLOBAL_description
			cell
				text var:desc
		row
			cell colspan:2
				fieldset title:message:additional_info
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
