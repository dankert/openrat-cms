page
	form
		window

			row
				cell class:fx
					label for:factor
						text text:FILE_IMAGE_SIZE_FACTOR
				cell class:fx
					set var:factor value:1
					selectbox name:factor list:factors
					
			row
				cell class:fx
					label for:width
						text text:FILE_IMAGE_NEW_WIDTH
				cell class:fx
					input name:width
					
			row
				cell class:fx
					label for:height
						text text:FILE_IMAGE_NEW_HEIGHT
				cell class:fx
					input name:height
					
			row
				cell class:fx
					label for:format
						text text:FILE_IMAGE_FORMAT
				cell class:fx
					selectbox name:format list:formats
					
			row
				cell class:fx
					label for:jpeglist_compression 
						text text:FILE_IMAGE_JPEG_COMPRESSION
				cell class:fx
					set var:jpeg_compression value:70
					selectbox list:jpeglist name:jpeg_compression
			row
				cell class:act colspan:2
					button type:ok
	focus field:width



