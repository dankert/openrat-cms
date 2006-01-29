page
	form
		window

			row
				cell class:fx
					text text:FILE_IMAGE_NEW_WIDTH
				cell class:fx
					input name:width
					
			row
				cell class:fx
					text text:FILE_IMAGE_NEW_HEIGHT
				cell class:fx
					input name:height
					
			row
				cell class:fx
					text text:FILE_IMAGE_FORMAT
				cell class:fx
					selectbox name:format list:formats
					
			row
				cell class:fx
					text text:FILE_IMAGE_JPEG_COMPRESSION
				cell class:fx
RAW
<?php
	$jpeglist = array();
	for ($i=10; $i<=95; $i+=5)
		$jpeglist[$i]=$i.'%';
?>
END
					set var:jpeg_compression value:70
					selectbox list:jpeglist name:jpeg_compression
			row
				cell class:act colspan:2
					button type:ok
	focus field:width



