page
	form method:post

		window icon:group name:GLOBAL_GROUPS
			row
				cell
					text text:GLOBAL_NAME
				cell
					text var:name
			row
				cell
					text text:GLOBAL_DELETE
				cell
					checkbox name:confirm
			row
				cell colspan:2 class:help
					text text:GROUP_DELETE_DESC

			row
				cell colspan:2
					button type:ok
	focus field:delete			
					