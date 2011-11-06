dummy
	form method:post
		window icon:user name:user_profile
			row
				cell class:logo colspan:2
					logo name:changepassword
			row
				cell colspan:2
					fieldset title:message:user_act_password
						label for:act_password
							text text:user_password
						password name:act_password
					fieldset title:message:user_new_password
						label for:password1
							text text:user_new_password
						password name:password1
						newline
						label for:password2
							text text:user_new_password_repeat
						password name:password2
			row
				cell colspan:2 class:act
					button type:ok
					
	focus field:act_password