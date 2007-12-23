page
	form
		window icon:folder widths:40%,60% width:70%
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
					text text:file_extension
				cell
					input name:extension size:10 class:extension
			row
				cell
					text text:global_description
				cell
					inputarea name:description class:description
			row
				cell colspan:2 class:act
					button type:ok
	focus field:name