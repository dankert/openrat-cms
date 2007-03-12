page
	form method:post
		window icon:user name:user_profile
			row
				cell class:logo colspan:2
					logo name:changepassword
				cell
					text text:user_new_mail
				cell
					input name:mail
			row
				cell colspan:2
					button type:ok
					
	focus field:act_password