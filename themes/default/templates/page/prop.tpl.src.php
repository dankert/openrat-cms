page

	form
		window icon:page widths:50%,50%
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