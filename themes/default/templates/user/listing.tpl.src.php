dummy
	window icon:user name:GLOBAL_USERS width:70%
		table
			row class:headline
				cell
					image type:user
					text key:name
				cell
					text raw:
				cell
					text key:LOGIN
					
			list list:el extract:true
				row class:data
					cell url:var:url
						image type:user
						text var:name
					cell url:var:url
						text value:var:fullname
						if true:var:isAdmin
							text raw:_(
							text key:USER_ADMIN
							text raw:)
					cell
						link target:_top action:index subaction:switchuser id:var:userid
							text key:LOGIN
						