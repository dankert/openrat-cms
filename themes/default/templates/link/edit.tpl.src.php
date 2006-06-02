page
	form
		window name:GLOBAL_PROP title:global_link icon:link width:90% widths:40%,60%
	
			row
				cell class:fx
					radio name:type value:url
				cell class:fx
					text text:link_url
				cell class:fx
					input name:url
			row
				cell class:fx
					radio name:type value:link
				cell class:fx
					text text:link_target
				cell class:fx
					selectbox list:objects name:targetobjectid
					
			row
				cell colspan:3 class:act
					button type:ok

	focus field:name
