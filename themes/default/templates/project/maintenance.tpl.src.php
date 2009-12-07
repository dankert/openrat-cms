page
	form
		window icon:project name:GLOBAL_PROJECT
			row
				cell colspan:2
					fieldset title:message:options
			row
				cell colspan:2
					label for:type_check_limit
						radio name:type value:check_limit
						text key:project_check_limit
			row
				cell colspan:2
					label for:type_check_files
						radio name:type value:check_files
						text key:project_check_files
			row
				cell colspan:2 class:act
					button type:ok