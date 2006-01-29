page
	form
		window name:GLOBAL_PROP title:global_link icon:link width:90% widths:40%,60%
	
			row
				cell class:fx
					text text:GLOBAL_name
				cell class:fx
					input name:name
			row
				cell class:fx
					text text:GLOBAL_description
				cell class:fx
					inputarea name:description
					
			row
				cell colspan:2 class:act
					button type:ok

	focus field:name
