page
	form
		window name:USER_PASSWORD columnclasses:fx rowclasses:rx
			row
				cell
					text text:user_username
				cell
					text var:name
			row
				cell colspan:2
					fieldset title:message:USER_new_password
			row
				cell
					text text:USER_new_password
				cell
					password name:password1
			row
				cell
					text text:USER_new_password_repeat
				cell
					password name:password2
			row
				cell colspan:2
					fieldset title:message:options
			if present:mail
				row
					cell
						text text:user_mail_new_password
					cell
						checkbox name:email
				row
					cell
						text text:user_random_password
					cell
						checkbox name:random
			row
				cell
					text text:user_password_timeout
				cell
					checkbox name:timeout
					
			row
				cell colspan:2 class:act
					button type:ok
	focus field:password1
