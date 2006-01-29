page
	window icon:user name:GLOBAL_USERS
		list list:el extract:true
			row
				cell class:fx
					link url:url target:cms_main title:desc
						image type:icon_user
						text var:name
				cell class:fx
					text var:fullname
					if true:isAdmin
						text raw:_(
						text text:USER_ADMIN
						text raw:)
