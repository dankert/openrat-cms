dummy

	window icon:folder
		fieldset title:message:menu_page_show
			part
				insert url:var:preview_url name:preview
				
		link class:action action:page subaction:preview frame:preview
			image icon:show
			text key:menu_page_show

		link class:action action:page subaction:edit frame:preview
			image icon:show
			text key:menu_page_edit

		link class:action url:var:preview_url frame:_blank
			text key:link_open_in_new_window