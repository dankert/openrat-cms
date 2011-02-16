dummy
	form method:post

		window icon:group name:GLOBAL_GROUPS
			row
				cell
					text text:GLOBAL_NAME
				cell
					input name:name
			row
				cell
					text text:LANGUAGE_ISOCODE
				cell
					input name:isocode
			row
				cell colspan:2 class:act
					button type:ok
	focus field:name			
					
