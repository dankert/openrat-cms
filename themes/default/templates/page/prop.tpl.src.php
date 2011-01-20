page

	form
		window icon:folder widths:40%,60%
			row
				cell
					text text:global_name
				cell class:name
					input name:name size:50 class:name
			row
				cell
					text text:global_filename
				cell class:filename
					input name:filename class:filename
			row
				cell
					text text:global_description
				cell
					inputarea name:description class:description
			row
				cell colspan:2
					fieldset title:message:additional_info
			row
				cell
					text text:global_full_filename
				cell class:filename
					text var:full_filename
			row
				cell
					text text:global_template
				cell
					if present:template_url
						link url:var:template_url target:cms_main
							image icon:template
							text var:template_name
					if empty:template_url
						image file:icon_template
						text var:template_name
					newline
					if false:mode:edit
						link class:action action:page subaction:changetemplate
							image icon:template
							text key:menu_page_changetemplate
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
			row
				cell colspan:2 class:act
					button type:ok
				
	focus field:name