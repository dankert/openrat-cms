page
	window title:GLOBAL_PROJECTS name:login width:400 icon:project

		row
			cell class:logo colspan:2
				logo name:projectmenu
				
		list list:el extract:true
			row
				cell
					link var:url title:TREE_CHOOSE_PROJECT
						set var:project value:project
						image type:project
						text var:name