dummy
	form target:_top
		window title:GLOBAL_REGISTER name:login width:400 icon:user columnclasses:x

			row
				cell class:logo colspan:2
					logo name:register
				row
					cell width:50%
						text text:USER_MAIL
					cell width:50%
						input name:mail default: size:25


				row
					cell colspan:2 class:act
						button type:ok text:button_next

	focus field:mail
