page
	form
		window width:70% widths:5%,40%,55%

			row
				cell colspan:2
					text text:IMAGE_OLD_SIZE
				cell
					text text:var:width
					text raw:_*_
					text text:var:height
			if true:mode:edit
				row
					cell colspan:3
						fieldset title:message:IMAGE_NEW_SIZE					
				row
					cell
						radio name:type value:factor
					cell
						label for:type_factor
							text text:FILE_IMAGE_SIZE_FACTOR
					cell
						selectbox name:factor list:factors
						set var:factor value:1
						
				row
					cell
						radio name:type value:input
					cell
						label for:type_input
							text text:FILE_IMAGE_NEW_WIDTH_HEIGHT
					cell
						input name:width size:10
						text raw:_*_
						input name:height size:10
	
				row
					cell colspan:3
						fieldset title:message:options					
				row
					cell colspan:2
						label for:format
							text text:FILE_IMAGE_FORMAT
					cell
						selectbox name:format list:formats
						
				row
					cell colspan:2
						label for:jpeglist_compression 
							text text:FILE_IMAGE_JPEG_COMPRESSION
					cell
						set var:jpeg_compression value:70
						selectbox list:jpeglist name:jpeg_compression
				row
					cell
					cell
					cell
						checkbox name:copy
						label for:copy 
							text text:message:copy
			row
				cell class:act colspan:3
					button type:ok
		focus field:width