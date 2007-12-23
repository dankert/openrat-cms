page

	form
		window name:objectName title:global_prop icon:folder widths:35%,65% width:70%
			row
				cell
					text text:global_name
				cell class:name
					input name:name size:50 class:name
			row
				cell
					text text:global_filename
				cell
					input name:filename class:filename
			row
				cell
					text text:global_description
				cell
					inputarea name:description class:description
			row
				cell colspan:2 class:act
					button type:ok
	focus field:name