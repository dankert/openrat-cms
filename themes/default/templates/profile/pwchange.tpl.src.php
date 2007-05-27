page
	form method:post
		window icon:user name:user_profile
			row
				cell class:logo colspan:2
					logo name:changepassword
			row
				cell colspan:2
					fieldset title:message:user_act_password
			row
				cell
					text text:user_password
				cell
					password name:act_password
			row
				cell colspan:2
					fieldset title:message:user_new_password
			row
				cell
					text text:user_new_password
				cell
					password name:password1
			row
				cell
					text text:user_new_password_repeat
				cell
					password name:password2
			row
				cell colspan:2 class:act
					button type:ok
					
	focus field:act_password