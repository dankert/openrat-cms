dummy
	form
		window name:GLOBAL_NAME
			row
				cell
					text text:ELEMENT_NAME
				cell
					input name:name
			row
				cell
					text text:GLOBAL_DESCRIPTION
				cell
					inputarea name:description rows:5 cols:50
			row
				cell colspan:2 class:act
					button type:ok

	focus field:name