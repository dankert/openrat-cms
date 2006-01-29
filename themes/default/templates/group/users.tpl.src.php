page
	window icon:user name:GROUP_MEMBERSHIPS
		list list:memberships extract:true
			row
				cell class:fx
					image file:icon_user
					text var:name
				cell
					link action:group subaction:deluser id:groupid
						text text:GLOBAL_DELETE
