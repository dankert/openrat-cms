page
	form
		window name:GLOBAL_USER
			row
				cell class:fx
					text text:user_username
				cell class:fx
					text var:name
			row
				cell class:fx
					text text:user_delete
				cell class:fx
					checkbox name:delete
			row
				cell colspan:2 class:act
					button type:ok
	focus field:name