dummy
	form
		window name:GLOBAL_USER widths:30%,70%
			row
				cell colspan:2
					fieldset title:message:NAME	
			row
				cell
					text text:user_username
				cell
					text var:name class:name
			row
				cell colspan:2
					fieldset title:message:options
			row
				cell colspan:2
					checkbox name:confirm
					label for:confirm
						text text:delete
			row
				cell colspan:2 class:act
					button type:ok
	focus field:name