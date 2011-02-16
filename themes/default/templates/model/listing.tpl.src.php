dummy
	window icon:group name:GLOBAL_MODELS widths:50%,25%,25%
		table
			row class:headline
				cell
					text key:name
				cell
					text raw:
				cell
					text raw:
			list list:el extract:true
				row class:data
					cell url:var:url 
						link target:cms_main
							image file:icon_model
							text var:name maxlength:25
					cell url:var:default_url
						if present:default_url
							text text:GLOBAL_make_default
						else
							text text:GLOBAL_is_default
					cell url:var:select_url 
						if present:select_url
							text text:GLOBAL_select
						else
							text text:GLOBAL_selected
				set var:select_url
				set var:default_url
