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
				cell class:fx
					checkbox name:confirm
					label for:confirm
						text text:delete
			row
				cell colspan:2 class:act
					button type:ok
	focus field:name