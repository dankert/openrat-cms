page
	form action:folder subaction:createnew

		window title: name:
			row
				cell class:fx
					text text:global_FOLDER
				cell class:fx
					input name:foldername size:20 default:
			row
				cell class:act colspan:2
					button type:ok

	focus field:foldername