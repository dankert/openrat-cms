page
	form
		window name:GLOBAL_PROP title:global_link icon:link width:90% widths:40%,60%
	
			row
				cell
					text text:GLOBAL_name
				cell
					input name:name class:name
			row
				cell
					text text:GLOBAL_description
				cell
					inputarea name:description class:description
					
			row
				cell colspan:2 class:act
					button type:ok

	focus field:name
