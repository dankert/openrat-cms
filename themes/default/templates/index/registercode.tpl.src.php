page
	form target:_top
		window title:GLOBAL_REGISTER name:login width:400 icon:user columnclasses:x,y rowclasses:fx1,fx2 

			row
				cell class:logo colspan:2
					logo name:register
				row
					cell class:fx width:50%
						text text:USER_REGISTER_CODE
					cell class:fx width:50%
						input name:register_code default: size:25
				row
					cell class:fx width:50%
						text text:USER_USERNAME
					cell class:fx width:50%
						input type:text name:register_name value: size:25
				row
					cell class:fx width:50%
						text text:USER_PASSWORD
					cell class:fx width:50%
						password name:register_password default: size:25
				row
					cell class:fx width:50%
						text text:GLOBAL_DATABASE
					cell class:fx width:50%
						selectbox name:dbid list:dbids default:actdbid
	
				row
					cell colspan:2 class:act
						button type:ok

	focus field:register_code
