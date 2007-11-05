page
	window icon:user name:GROUP_MEMBERSHIPS
		list list:memberships extract:true
			row
				cell class:fx
					image file:icon_user
					text text:var:name
				cell
					link url:var:delete_url
						text text:message:GLOBAL_DELETE
