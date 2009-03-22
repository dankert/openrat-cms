page
	form

		window icon:template
			row
				cell
					text text:GLOBAL_NAME
				cell
					text var:name
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
					