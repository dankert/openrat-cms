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
					cell colspan:2
						checkbox name:email
						label for:email
							text text:user_mail_new_password
				row
					cell colspan:2
						checkbox name:random
						label for:random
							text text:user_random_password
			row
				cell colspan:2
					checkbox name:timeout
					label for:timeout
						text text:user_password_timeout
					
			row
				cell colspan:2 class:act
					button type:ok
	focus field:password1
