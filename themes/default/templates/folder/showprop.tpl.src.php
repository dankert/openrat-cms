page

	window name:objectName title:global_prop icon:folder widths:40%,20%,30% width:70%
		row
			cell
				text text:global_name
			cell colspan:2 class:name
				text var:name
		row
			cell
				text text:global_description
			cell colspan:2
				text var:description
		row
			cell
				text key:FULL_FILENAME
			cell colspan:2 class:filename
				text var:full_filename
		row
			cell colspan:2
				fieldset title:message:additional_info
		row
			cell
				text key:id
			cell
				text var:objectid
		row
			cell colspan:3
				fieldset title:message:PROP_USERINFO
		row
			cell
				text text:global_created
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
				image icon:el_date
				date date:var:lastchange_date
			cell
				image icon:user
				user user:var:lastchange_user

