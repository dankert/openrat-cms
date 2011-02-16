dummy

	window icon:folder
		row
			cell colspan:2
				insert url:var:preview_url

				link class:action action:file subaction:edit
					image file:icon/edit
					text key:menu_file_edit
				link class:action action:file subaction:editvalue
					image file:icon/editvalue
					text key:menu_file_editvalue
					