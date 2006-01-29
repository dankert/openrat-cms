page
	form
		window name:USER_PASSWORD
			row
				cell class:fx
					text text:user_username
				cell class:fx
					text var:name
			row
				cell class:fx
					text text:USER_new_password
				cell class:fx
					password name:password1
			row
				cell class:fx
					text text:USER_new_password_repeat
				cell class:fx
					password name:password2
			if present:mail
				row
					cell class:fx
						text text:user_mail_new_password
					cell class:fx
						checkbox name:mail
			row
				cell class:fx
					text text:user_random_password
				cell class:fx
					checkbox name:random
					
			row
				cell colspan:2 class:act
					button type:ok
	focus field:password1
