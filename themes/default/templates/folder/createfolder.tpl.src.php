dummy
	form

		window title: name:
			row
				cell
					text text:global_FOLDER
				cell
					input name:name size:20 default:
			row
				cell
					text text:global_DESCRIPTION
				cell
					inputarea rows:5 cols:50 name:description
			row
				cell class:act colspan:2
					button type:ok

	focus field:name