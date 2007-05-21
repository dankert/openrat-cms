page

	form
		window name:objectName title:global_prop icon:folder widths:50%,50% width:90%
			row
				cell
					text text:global_name
				cell
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
				cell colspan:2
					button type:ok
	focus field:name