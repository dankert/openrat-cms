page class:menu
	table padding:5 space:0 width:100%

		if true:!config:interface/application_mode	
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
			# Men�leiste
			cell class:subaction
				# Schleife �ber alle Men�punkte
				list list:windowMenu extract:true
					if not:true empty:url
						link url:var:url title:messagevar:title target:_parent accesskey:messagevar:key class:menu
							text text:var:text accesskey:messagevar:key
					else
						text text:var:text class:menu_disabled accesskey:messagevar:key
					text raw:__
					set var:url value:
