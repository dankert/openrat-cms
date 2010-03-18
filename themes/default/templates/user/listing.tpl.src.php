page
	window icon:user name:GLOBAL_USERS width:70%
		list list:el extract:true
			row class:data
				cell
					link url:var:url target:cms_main title:desc
						image type:user
						text var:name
				cell
					text value:var:fullname
					if true:var:isAdmin
						text raw:_(
						text key:USER_ADMIN
						text raw:)
				cell
					link target:_top action:index subaction:switchuser id:var:userid
						text key:LOGIN
						