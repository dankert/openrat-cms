page
	form

		window
			row
				cell
					text text:ELEMENT_NAME
				cell
					text var:name
			row
				cell colspan:2
					fieldset title:message:options
			row
				cell colspan:2
					checkbox name:delete
					label for:delete
						text text:GLOBAL_DELETE
			row
				cell colspan:2
					checkbox name:deletevalues
					label for:deletevalues
						text text:ELEMENT_DELETE_VALUES

			row
				cell colspan:2 class:act
					button type:ok

	focus field:delete			
					