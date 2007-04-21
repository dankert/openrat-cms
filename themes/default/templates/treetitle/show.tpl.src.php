page
	table padding:5 space:0 width:100%
	
		row
			cell class:menu
				image type:var:type

				list list:path extract:true value:xy
					#image type:icon
					link url:var:url title:title class:path target:cms_main
						text var:name maxlength:20
					char type:filesep

				text text:var:text title:var:text class:title
		row
			# Menüleiste
			cell class:subaction
				# Schleife über alle Menüpunkte
				list list:windowMenu extract:true
					link url:var:url title:var:title target:_parent accesskey:messagevar:key class:menu
						text text:var:text accesskey:messagevar:key
					text raw:__
