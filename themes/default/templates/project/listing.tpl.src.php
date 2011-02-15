page
	window icon:project name:GLOBAL_PROJECTS width:70%
		table
			row class:headline
				cell
					text key:name
				cell
					text key:GLOBAL_SELECT
					
			list list:el extract:true
				row class:data
					cell url:var:url
						image file:icon_project
						text value:var:name maxlength:30
					cell url:var:use_url 
						text key:GLOBAL_SELECT
