page
	form method:post
		window icon:user name:user_profile
			row
				cell class:logo colspan:2
					logo name:changemail
			row
				cell colspan:2
					fieldset title:message:user_mail
			row
				cell
					text text:user_new_mail
				cell
					input name:mail
			row
				cell colspan:2 class:act
					button type:ok
					
	focus field:mail