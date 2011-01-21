page
	form
		window name:USER_PASSWORD columnclasses:fx rowclasses:rx
			row
				cell
					text text:user_username
				cell
					text var:name class:name
			row
				cell colspan:2
					fieldset title:message:USER_new_password
						part
							label for:password1
								text text:USER_new_password
							password name:password1
						part
							label for:password2
								text text:USER_new_password_repeat
							password name:password2
					fieldset title:message:options
						if present:mail
							part
								checkbox name:email
								label for:email
									text text:user_mail_new_password
							part
								checkbox name:random
								label for:random
									text text:user_random_password
							part
								checkbox name:timeout
								label for:timeout
									text text:user_password_timeout
					
			row
				cell colspan:2 class:act
					button type:ok
	focus field:password1
