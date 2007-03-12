page
	form
		window title:GLOBAL_password name:login width:400 icon:user columnclasses:x,y rowclasses:fx1,fx2 widths:50%,50%

			row
				cell class:logo colspan:2
					logo name:password
				row
					cell
						text text:password_code
					cell
						input type:text name:code size:30
	
				row
					cell colspan:2 class:act
						button type:ok

	focus field:code
