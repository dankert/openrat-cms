page
	window icon:user name:GLOBAL_USERS width:70%
		list list:el extract:true
			row
				cell class:fx
					link url:var:url target:cms_main title:desc
						image type:user
						text var:name
				cell class:fx
					text value:var:fullname
					if true:var:isAdmin
						text raw:_(
						text key:USER_ADMIN
						text raw:)
