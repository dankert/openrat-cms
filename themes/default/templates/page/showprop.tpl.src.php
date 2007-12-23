page

	window icon:folder widths:40%,60%
		row
			cell
				text text:global_name
			cell class:name
				text var:name
		row
			cell
				text text:message:global_description
			cell
				text text:var:description
		row
			cell
				text text:global_full_filename
			cell class:filename
				text var:full_filename
		row
			cell colspan:2
				fieldset title:message:additional_info
		row
			cell
				text text:global_template
			cell
				if present:template_url
					link url:var:template_url target:cms_main
						image file:icon_template
						text var:template_name
				if empty:template_url
					image file:icon_template
					text var:template_name
		row
			cell
				text key:FILE_MIMETYPE
			cell class:filename
				text var:mime_type
		row
			cell
				text key:id
			cell
				text var:objectid
		row
			cell colspan:2
				fieldset title:message:prop_userinfo
		row
			cell
				text text:global_created
			cell
				table
					row
						cell
							image icon:el_date
							date date:var:create_date
						cell
							image icon:user
							user user:var:create_user
		row
			cell
				text text:global_lastchange
			cell
				table
					row
						cell
							image icon:el_date
							date date:var:lastchange_date
						cell
							image icon:user
							user user:var:lastchange_user
				