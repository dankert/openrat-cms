page
	window title:GLOBAL_PROJECTS name:login width:400

		list list:el extract:true
			row
				cell
					link url:url title:TREE_CHOOSE_PROJECT
						set var:project value:project
						image type:project
						text var:name