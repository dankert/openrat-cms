page
	form target:_top
		window title:GLOBAL_CHOOSE name:login width:400 icon:user columnclasses:x,y rowclasses:fx1,fx2 

			row
				cell class:logo colspan:2
					logo name:changepassword
				row
					cell width:50%
						text text:USER_PASSWORD
					cell width:50%
						password name:password_old default: size:25
				row
					cell width:50%
						text text:USER_NEW_PASSWORD
					cell width:50%
						password name:password_new_1 default: size:25
				row
					cell width:50%
						text text:USER_NEW_PASSWORD_REPEAT
					cell width:50%
						password name:password_new_2 default: size:25
	
				row
					cell colspan:2 class:act
						button type:ok

	focus field:password_old
