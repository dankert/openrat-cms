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
				text text:global_description
			cell class:fx
				text var:description
		row
			cell class:fx
				text text:page_template
			cell class:fx
				if present:template_url
					link url:var:template_url target:cms_main
						image file:icon_template
						text var:template_name
				if empty:template_url
					image file:icon_template
					text var:template_name
		row
			cell class:fx
				text text:global_full_filename
			cell class:fx
				text var:full_filename
		row
			cell
				text key:FILE_MIMETYPE
			cell
				text var:mime_type
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
