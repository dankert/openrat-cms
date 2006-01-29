page
	window icon:group name:GLOBAL_MODELS widths:50%,25%,25%
		list list:el extract:true
			row
				cell class:fx
					link url:url target:cms_main
						image file:icon_model
						text var:name
				cell class:fx
					link url:default_url target:cms_main
						image file:icon_model
						text text:GLOBAL_make_default
				cell class:fx
					link url:select_url target:cms_main
						image file:icon_model
						text text:GLOBAL_selected
