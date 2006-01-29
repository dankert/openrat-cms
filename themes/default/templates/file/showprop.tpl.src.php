page

	window icon:folder widths:50%,50%
		row
			cell class:fx
				text text:global_name
			cell class:fx
				text var:name
		row
			cell class:fx
				text text:global_filename
			cell class:fx
				text var:filename
		row
			cell class:fx
				text text:file_extension
			cell class:fx
				text var:extension
		row
			cell class:fx
				text text:global_description
			cell class:fx
				text var:description
		row
			cell class:fx
				text text:global_created
			cell class:fx
				date date:create_date
				text raw:,_
				user user:create_user
		row
			cell class:fx
				text text:global_lastchange
			cell class:fx
				date date:lastchange_date
				text raw:,_
				user user:lastchange_user

		row
			cell class:fx
				text text:FILE_SIZE
			cell class:fx
RAW
<?php echo number_format($size/1000,0,',','.') ?> kB
END

		row
			cell class:fx
				text text:FILE_mimetype
			cell class:fx
				text var:mimetype

		row
			cell class:fx
				text text:FILE_PAGES
			cell class:fx
				list list:pages extract:true
					link url:url target:cms_main
						image type:page
						text var:name
					newline
				if empty:pages
					text text:GLOBAL_NOT_FOUND
