page
	form enctype:multipart/form-data
		window title:GLOBAL_NEW name:global_new
			row
				cell colspan:3
					fieldset title:message:folder
			row
				cell
					radio name:type value:folder
				cell class:fx
					label for:type_folder
						text text:global_folder
				cell class:fx
					input name:folder_name size:30 maxlength:250 default: class:name

			row
				cell colspan:3
					fieldset title:message:file
			row
				cell
					radio name:type value:file
				cell class:fx
					label for:type_file
						text text:global_FILE
				cell class:fx
					upload name:file size:30 maxlength:var:maxlength
					newline
					text class:help key:file_max_size
					text raw:_
					text var:max_size

			row
				cell colspan:3
					fieldset title:message:page
			row
				cell
					radio name:type value:page
				cell class:fx
					label for:type_page
						text text:global_TEMPLATE
				cell class:fx
					selectbox name:page_templateid list:templates
			row
				cell
				cell class:fx
					label for:type_page
						text text:global_NAME
				cell class:fx
					input name:page_name size:30 maxlength:250 class:name

			row
				cell colspan:3
					fieldset title:message:link
			row
				cell
					radio name:type value:link
				cell class:fx
					label for:type_link
						text text:global_NAME
				cell class:fx

			row
				cell class:act colspan:3
					button type:ok

