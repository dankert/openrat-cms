page
	form
		window name:GLOBAL_PROP title:global_link icon:link width:90% widths:5%,30%,65%
	
			row
				cell
					radio name:type value:url
				cell
					label for:type_url
						text text:link_url
				cell
					input name:url
			row
				cell
					radio name:type value:link
				cell
					label for:type_link
						text text:link_target
				cell
					selectbox list:objects name:targetobjectid
					
			row
				cell colspan:3 class:act
					button type:ok

	focus field:name
