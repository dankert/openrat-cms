page
	form method:post

		window icon:group name:GLOBAL_GROUPS
			row
				cell
					text text:GLOBAL_NAME
				cell class:fx
					input name:name
			row
				cell
					text text:LANGUAGE_ISOCODE
				cell class:fx
					input name:isocode
			row
				cell colspan:2
					button type:ok
	focus field:name			
					
