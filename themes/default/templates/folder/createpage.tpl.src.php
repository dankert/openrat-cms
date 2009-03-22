page
	form

		window title: name:
			row
				cell
					text text:global_TEMPLATE
				cell
					selectbox name:templateid list:templates
			row
				cell
					text text:global_NAME
				cell
					input name:name size:20
			row
				cell
					text text:global_DESCRIPTION
				cell
					inputarea rows:5 cols:50 name:description
			row
				cell class:act colspan:2
					button type:ok

	focus field:name
