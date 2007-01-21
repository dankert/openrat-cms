page
	window icon:group name:GLOBAL_MODELS widths:50%,25%,25%
		list list:el extract:true
			row
				cell class:fx
					link url:var:url target:cms_main
						image file:icon_model
						text var:name
				cell class:fx
					link url:var:default_url target:cms_main
						image file:icon_model
						text text:GLOBAL_make_default
				cell class:fx
					link url:var:select_url target:config:interface/frame/top
						image file:icon_model
						text text:GLOBAL_selected
