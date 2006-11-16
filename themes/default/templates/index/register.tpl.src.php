page
	form target:_top
		window title:GLOBAL_REGISTER name:login width:400 icon:user columnclasses:x

			row
				cell class:logo colspan:2
					logo name:register
				row
					cell class:fx width:50%
						text text:USER_MAIL
					cell class:fx width:50%
						input name:register_mail default: size:25


				row
					cell colspan:2 class:act
						button type:ok

	focus field:register_mail
