page
	form
		window name:GLOBAL_USER
			row
				cell
					text text:user_username
				cell
					text var:name
			row
				cell
				cell
					checkbox name:confirm
					label for:confirm
						text text:delete
			row
				cell colspan:2 class:act
					button type:ok
	focus field:name