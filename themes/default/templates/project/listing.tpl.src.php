page
	window icon:project name:GLOBAL_PROJECTS
		list list:el extract:true
			row
				cell
					link url:var:url target:cms_main
						image file:icon_project
						text value:var:name
				cell
					link url:var:use_url target:config:interface/frames/top
						text value:message:GLOBAL_SELECT
