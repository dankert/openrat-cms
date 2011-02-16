dummy
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
					label for:extension
						text text:file_extension
					input name:extension size:10 class:extension

				part					
					label for:description
						text text:global_description
					inputarea name:description class:description

				
			if false:mode:edit
				link class:action action:folder subaction:select id:var:parentid var1:obj{objectid} value1:1 var2:type value2:copy
					text key:COPY
				link class:action action:folder subaction:select id:var:parentid var1:obj{objectid} value1:1 var2:type value2:move
					text key:MOVE
				link class:action action:folder subaction:select id:var:parentid var1:obj{objectid} value1:1 var2:type value2:link
					text key:LINK
				link class:action action:folder subaction:select id:var:parentid var1:obj{objectid} value1:1 var2:type value2:delete
					text key:DELETE
				newline
				newline
				newline
					
				fieldset title:message:additional_info
					part
						label for:full_filename
							text text:global_full_filename
						text var:full_filename
						
					part
						label for:size
							text text:FILE_SIZE
						text var:size
					
					part
						label for:mimetype
							text text:FILE_mimetype
						text var:mimetype
						
						link class:action action:file subaction:size
							text key:menu_file_size
							
					part
						text text:message:id
						text var:objectid
						
					if present:cache_filename
						part
							label for:cache_filename
								text text:CACHE_FILENAME
							text var:cache_filename
							image icon:el_date
							date date:var:cache_filemtime
							
					part
						label for:pages
							text text:FILE_PAGES
							table
								list list:pages extract:true
									row
										cell
											link url:var:url target:cms_main
												image type:page
												text var:name
							if empty:pages
								text text:GLOBAL_NOT_FOUND
								
				fieldset title:message:prop_userinfo
					part
						text text:global_created
						image icon:el_date
						date date:var:create_date
						image icon:user
						user user:var:create_user
						
					part
						text text:global_lastchange
						image icon:el_date
						date date:var:lastchange_date
						image icon:user
						user user:var:lastchange_user
						
	


				link class:action action:file subaction:compress
					image file:icon/compress
					text key:menu_file_compress
				link class:action action:file subaction:uncompress
					image file:icon/uncompress
					text key:menu_file_uncompress
				link class:action action:file subaction:extract
					image file:icon/extract
					text key:menu_file_extract
				
			button type:ok
	focus field:name