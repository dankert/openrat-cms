dummy
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
					checkbox name:confirm
					label for:confirm
						text text:CONFIRM_DELETE
			row
				cell colspan:2
					label for:type_value
						text raw:_____
						radio name:type value:value default:value
						text text:ELEMENT_DELETE_VALUES
					newline
					label for:type_all
						text raw:_____
						radio name:type value:all
						text text:DELETE

			row
				cell colspan:2 class:act
					button type:ok

	focus field:delete			
					