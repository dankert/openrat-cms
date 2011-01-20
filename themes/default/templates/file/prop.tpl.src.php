page
	form
		window icon:folder widths:40%,60% width:70%
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
					text text:file_extension
				cell class:filename
					input name:extension size:10 class:extension
					
			row
				cell
					text text:global_description
				cell
					inputarea name:description class:description

			row
				cell
				cell
					link action:folder subaction:select id:var:parentid var1:obj{objectid} value1:1 var2:type value2:copy
						text key:COPY
					text raw:,_
					link action:folder subaction:select id:var:parentid var1:obj{objectid} value1:1 var2:type value2:move
						text key:MOVE
					text raw:,_
					link action:folder subaction:select id:var:parentid var1:obj{objectid} value1:1 var2:type value2:link
						text key:LINK
					text raw:,_
					link action:folder subaction:select id:var:parentid var1:obj{objectid} value1:1 var2:type value2:delete
						text key:DELETE
			row
				cell colspan:2
					fieldset title:message:additional_info
			if false:mode:edit
				row
					cell
						text text:global_full_filename
					cell class:filename
						text var:full_filename
			row
				cell
					text text:FILE_SIZE
				cell
					text var:size
			row
				cell
					text text:FILE_mimetype
				cell class:filename
					text var:mimetype

			row
				cell
				cell
					link class:action action:file subaction:size
						text key:menu_file_size
			row
				cell
					text text:message:id
				cell
					text var:objectid
			row
				cell
					text text:CACHE_FILENAME
				cell class:filename
					if present:cache_filename
						text var:cache_filename
			if present:cache_filename
				row
					cell
					cell
						image icon:el_date
						date date:var:cache_filemtime
			row
				cell
					text text:FILE_PAGES
				cell
					table
						list list:pages extract:true
							row
								cell
									link url:var:url target:cms_main
										image type:page
										text var:name
					if empty:pages
						text text:GLOBAL_NOT_FOUND
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
				cell colspan:2
					link class:action action:file subaction:compress
						image file:icon/compress
						text key:menu_file_compress
					link class:action action:file subaction:uncompress
						image file:icon/uncompress
						text key:menu_file_uncompress
					link class:action action:file subaction:extract
						image file:icon/extract
						text key:menu_file_extract
			row
				cell colspan:2 class:act
					button type:ok
	focus field:name