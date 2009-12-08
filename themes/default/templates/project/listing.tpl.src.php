page
	window icon:project name:GLOBAL_PROJECTS width:70%
		list list:el extract:true
			row class:data
				cell
					link url:var:url target:cms_main
						image file:icon_project
						text value:var:name maxlength:30
				cell
					link url:var:use_url target:config:interface/frames/top
						text key:GLOBAL_SELECT
