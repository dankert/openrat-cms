page
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
			row
				cell
					radio name:type value:empty
				cell
					label for:type_empty
						text key:empty
			row
				cell
					radio name:type value:copy
				cell
					label for:type_copy
						text key:copy
				cell
					selectbox name:projectid list:projects
			row
				cell class:act colspan:3
					button type:ok
	focus field:name