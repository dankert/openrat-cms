page
	form target:_top
		window title:GLOBAL_password name:login width:400 icon:user columnclasses:x,y rowclasses:fx1,fx2 widths:50%,50%

			row
				cell class:logo colspan:2
					logo name:password
				row
					cell width:50%
						text text:USER_USERNAME
					cell width:50%
						input type:text name:username value: size:30

				row
					cell class:fx width:50%
						text text:GLOBAL_DATABASE
					cell class:fx width:50%
						selectbox name:dbid list:dbids default:actdbid
	
				row
					cell colspan:2 class:act
						button type:ok text:button_next

	focus field:username
