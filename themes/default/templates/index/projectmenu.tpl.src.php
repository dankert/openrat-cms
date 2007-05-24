page
	window title:GLOBAL_PROJECTS name:login width:400 icon:project

		row
			cell class:logo colspan:2
				logo name:projectmenu
				
		list list:projects extract:true
			row
				cell
					link url:var:url title:message:TREE_CHOOSE_PROJECT
						set var:project value:project
						image type:project
						text var:name
				cell
					list list:models key:model_id value:model_name
						list list:languages key:language_id value:language_name
							link action:index subaction:project id:var:id var1:languageid value1:var:language_id var2:modelid value2:var:model_id
								text text:var:model_name
								text raw:_-_
								text text:var:language_name
								newline
					newline
									