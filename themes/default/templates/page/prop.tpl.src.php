dummy
	header views:changetemplate

	form
		window
			fieldset
				part
					label for:name
						text text:global_name
					input name:name size:50 class:name
			
				part
					label for:filename
						text text:global_filename
					input name:filename class:filename
					
				part
					label for:description
						text text:global_description
					inputarea name:description class:description

			if false:mode:edit
				fieldset title:message:additional_info
					part
						label for:full_filename
							text text:global_full_filename
						text var:full_filename class:filename
						
					part
						label for:template_name
							text text:global_template
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
					part
						label for:mime_type
							text key:FILE_MIMETYPE
						text var:mime_type class:filename
						
					part
						label for:objectid
							text key:id
						text var:objectid
						
				fieldset title:message:prop_userinfo
					part
						label for:create_date
							text text:global_created
						image icon:el_date
						date date:var:create_date
						image icon:user
						user user:var:create_user
					part
						label for:lastchange_date
							text text:global_lastchange
						image icon:el_date
						date date:var:lastchange_date
						image icon:user
						user user:var:lastchange_user
						
			button type:ok
				
	focus field:name