page class:menu
	table padding:5 space:0 width:100%

		if true:!config:interface/application_mode	
			row class:title
				cell
					image type:var:type
	
					list list:path extract:true value:xy
						#image type:icon
						link url:var:url title:title class:path target:cms_main
							text var:name maxlength:20
						char type:filesep
	
					text var:text title:var:text class:title maxlength:20
		row class:menu
			# Menueleiste
			cell
				table class:submenu
					row
						# Schleife ueber alle Menuepunkte
						list list:windowMenu extract:true
							if not: empty:url
								cell class:action
									link url:var:url title:messagevar:title target:_parent accesskey:messagevar:key class:menu
										text key:var:text accesskey:messagevar:key
							else
								cell class:noaction
									text key:var:text accesskey:messagevar:key
							set var:url value:
