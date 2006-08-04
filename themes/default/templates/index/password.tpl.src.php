page
	form action:index subaction:login target:_top
		window title:GLOBAL_password name:login width:400 icon:user

			row
				cell class:logo colspan:2
					logo name:password
				row
					cell class:fx width:50%
						text text:USER_USERNAME
					cell class:fx width:50%
						input type:text name:login_name value: size:25
				row
					cell class:fx width:50%
						text text:USER_EMAIL
					cell class:fx width:50%
						password name:login_password default: size:25
	
				row
					cell colspan:2 class:act
						button type:ok

	focus field:login_name
