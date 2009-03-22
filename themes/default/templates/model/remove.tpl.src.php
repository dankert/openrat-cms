page
	form method:post

		window icon:group name:GLOBAL_GROUPS
			row
				cell
					text text:GLOBAL_NAME
				cell
					text var:name
			row
				cell colspan:2 class:help
					text text:GROUP_DELETE_DESC
			row
				cell colspan:2
					fieldset title:message:options
			row
				cell
					checkbox name:confirm
					label for:confirm
						text text:CONFIRM_DELETE
				cell

			row
				cell colspan:2 class:act
					button type:ok
	focus field:delete			
					