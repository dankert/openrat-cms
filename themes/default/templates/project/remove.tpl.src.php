page
	form method:post

		window icon:group name:GLOBAL_PROJECT widths:20%,80%
			row
				cell
					text text:GLOBAL_NAME
				cell
					text var:name class:name
			row
				cell colspan:2
					fieldset title:message:options
			row
				cell colspan:2
					checkbox name:delete
					label for:delete
						text text:CONFIRM_DELETE
			row
				cell colspan:2 class:act
					button type:ok
	focus field:delete			
					