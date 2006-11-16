page
	form
		window name:USER_PASSWORD columnclasses:fx rowclasses:rx
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
						checkbox name:email
				row
					cell class:fx
						text text:user_random_password
					cell class:fx
						checkbox name:random
			row
				cell class:fx
					text text:user_password_timeout
				cell class:fx
					checkbox name:timeout
					
			row
				cell colspan:2 class:act
					button type:ok
	focus field:password1
