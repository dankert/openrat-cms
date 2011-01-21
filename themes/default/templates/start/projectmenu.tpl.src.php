page title:MENU_INDEX_PROJECTMENU
	window title:GLOBAL_PROJECTS

		row
			cell class:logo colspan:2
				logo name:projectmenu
				
		list list:projects extract:true
			row
				cell colspan:2
					fieldset title:var:name
						link url:var:url title:message:TREE_CHOOSE_PROJECT
							set var:project value:project
							image type:project
							text var:name maxlength:30
//						list list:models key:model_id value:model_name
//							list list:languages key:language_id value:language_name
//								link action:index subaction:project id:var:id var1:languageid value1:var:language_id var2:modelid value2:var:model_id
//									text text:var:model_name
//									text raw:_-_
//									text text:var:language_name
//									newline
						form action:index subaction:project id:var:id
							table widths:150px,150px
								row
									cell
										radiobox list:models name:modelid default:var:defaultmodelid
									cell
										radiobox list:languages name:languageid default:var:defaultlanguageid
									cell
										button type:ok text:message:start
									