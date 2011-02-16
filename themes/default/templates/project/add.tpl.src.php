dummy
	form method:post

		window icon:project name:GLOBAL_PROJECTS widths:20px,20%,80% width:70%
			row
				cell colspan:2
					text text:message:name
				cell
					input name:name
			row
				cell colspan:3
					fieldset title:message:options
						part
							radio name:type value:empty
							label for:type_empty
								text key:empty
						part
							radio name:type value:copy
							label for:type_copy
								text key:copy
							selectbox name:projectid list:projects
			row
				cell class:act colspan:3
					button type:ok
	focus field:name