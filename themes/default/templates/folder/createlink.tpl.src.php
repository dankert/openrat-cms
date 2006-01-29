page
	form

		window title: name:
			row
				cell class:fx
					text text:global_NAME
				cell class:fx
					input name:name size:20 default:
			row
				cell class:fx
					text text:global_DESCRIPTION
				cell class:fx
					inputarea rows:5 cols:50 name:description
			row
				cell class:act colspan:2
					button type:ok

	focus field:name