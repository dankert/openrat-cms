page
	form
		window

			row
				cell colspan:2
					fieldset title:message:IMAGE_NEW_SIZE					
			row
				cell
					label for:factor
						text text:FILE_IMAGE_SIZE_FACTOR
				cell
					set var:factor value:1
					selectbox name:factor list:factors
					
			row
				cell
					label for:width
						text text:FILE_IMAGE_NEW_WIDTH
				cell
					input name:width
					
			row
				cell
					label for:height
						text text:FILE_IMAGE_NEW_HEIGHT
				cell
					input name:height

			row
				cell colspan:2
					fieldset title:message:options					
			row
				cell
					label for:format
						text text:FILE_IMAGE_FORMAT
				cell
					selectbox name:format list:formats
					
			row
				cell
					label for:jpeglist_compression 
						text text:FILE_IMAGE_JPEG_COMPRESSION
				cell
					set var:jpeg_compression value:70
					selectbox list:jpeglist name:jpeg_compression
			row
				cell class:act colspan:2
					button type:ok
	focus field:width



