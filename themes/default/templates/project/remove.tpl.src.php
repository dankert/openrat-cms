page
	form method:post

		window
			row
				cell
					text text:GLOBAL_NAME
				cell
					text var:name class:name
			row
				cell colspan:2
					fieldset title:message:options
						part
							checkbox name:delete
							label for:delete
								text text:CONFIRM_DELETE
			row
				cell colspan:2 class:act
					button type:ok
	focus field:delete			
					