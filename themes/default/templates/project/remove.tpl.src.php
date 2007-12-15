page
	form method:post

		window icon:group name:GLOBAL_PROJECT widths:20%,80%
			row
				cell
					text text:GLOBAL_NAME
				cell class:fx
					text var:name
			row
				cell
					text text:CONFIRM_DELETE
				cell
					checkbox name:delete
			row
				cell colspan:2 class:help
					text text:GROUP_DELETE_DESC

			row
				cell colspan:2
					button type:ok
	focus field:delete			
					