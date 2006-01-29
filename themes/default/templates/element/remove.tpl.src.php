page
	form

		window
			row
				cell
					text text:ELEMENT_NAME
				cell class:fx
					text var:name
			row
				cell
					text text:GLOBAL_DELETE
				cell
					checkbox name:delete
			row
				cell
					text text:ELEMENT_DELETE_VALUES
				cell
					checkbox name:deletevalues

			row
				cell colspan:2
					button type:ok

	focus field:delete			
					