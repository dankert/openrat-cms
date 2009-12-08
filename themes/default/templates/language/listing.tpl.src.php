page
	window icon:language
		list list:el extract:true
			row class:data
				cell
					link url:var:url target:cms_main
						image file:icon_language
						text var:name maxlength:25

				cell
					text var:isocode

				cell
					if present:default_url
						link url:var:default_url target:cms_main_main
							text text:GLOBAL_make_default
					else
						text text:GLOBAL_is_default
				cell
					if present:select_url
						link url:var:select_url target:config:interface/frames/top
							text text:GLOBAL_select
					else
						text text:GLOBAL_selected
			set var:select_url
			set var:default_url
						