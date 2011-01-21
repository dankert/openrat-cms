page
	window icon:group name:GLOBAL_GROUPS width:70%
		list list:el extract:true
			row class:data
				cell
					link url:var:url target:cms_main
						image file:icon_group
						text var:name
		row
			cell
				link class:action action:group subaction:add
					text key:menu_group_add