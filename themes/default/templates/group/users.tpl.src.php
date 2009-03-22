page
	window icon:user name:GROUP_MEMBERSHIPS
		list list:memberships extract:true
			row class:data
				cell class:fx
					image file:icon_user
					text var:name
				cell
					link url:var:delete_url
						text key:GLOBAL_DELETE
