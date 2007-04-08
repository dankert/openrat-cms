page

	window name:objectName title:global_prop icon:folder widths:50%,50% width:90%
		row
			cell class:fx
				text text:global_name
			cell class:fx
				text var:name
		row
			cell class:fx
				text text:global_filename
			cell class:fx
				text var:filename
		row
			cell class:fx
				text text:global_description
			cell class:fx
				text var:description
		row
			cell class:fx
				text text:global_created
			cell class:fx
				date date:var:create_date
				text raw:,_
				user user:var:create_user
		row
			cell class:fx
				text text:global_lastchange
			cell class:fx
				date date:var:lastchange_date
				text raw:,_
				user user:var:lastchange_user

