insert file:header

form action:link subaction:save

window name:GLOBAL_PROP title:global_link icon:link width:90% widths:40%,60%

	row
		cell class:fx
			text text:GLOBAL_name
		cell class:fx
			text var:name
	row
		cell class:fx
			text text:GLOBAL_description
		cell class:fx
			text var:desc
	row
		cell colspan:2 class:fx
			text url:editprop_url text:GLOBAL_CHANGE	
	row
		cell colspan:2 class:help
			text raw:_	
	row
		cell class:fx
			text text:global_created
		cell class:fx
			date date:create_date
			text raw:,_
			user user:create_user
	row
		cell class:fx
			text text:global_lastchange
		cell class:fx
			date date:lastchange_date
			text raw:,_
			user user:lastchange_user

focus field:name

insert file:footer