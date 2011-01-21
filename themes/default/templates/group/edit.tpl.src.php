page
	form method:post

		window icon:group name:GLOBAL_GROUPS
			row
				cell
					text text:GLOBAL_NAME
				cell
					input name:name
			row
				cell colspan:2 class:act
					button type:ok
					
					if false:mode:edit
						link class:action action:group subaction:remove
							text key:menu_group_remove					
	focus field:name			
					
