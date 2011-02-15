page
	window icon:language
		table
			row class:headline
				cell
					text key:name
				cell
					text raw:
				cell
					text raw:
				cell
					text raw:
			list list:el extract:true
			
				row class:data
					cell url:var:url
						image file:icon_language
						text var:name maxlength:25
	
					cell
						text var:isocode
	
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
							