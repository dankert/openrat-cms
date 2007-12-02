page
	table padding:5 space:0 width:100% rowclasses:a,b columnclasses:a,b

		if true:!config:interface/application_mode	
			row
				cell class:menu
					image type:var:type
	
					list list:path extract:true value:xy
	
						link url:var:url title:var:title class:path target:cms_main
							text value:var:name maxlength:20
						char type:filesep
	
					text text:var:text title:var:text class:title
				cell class:menu style::text-align:right;
					form action:search subaction:quicksearch target:cms_main_main
						input class:search name:search size:15
	//					button class:searchbutton type:ok src:search
						if true:config:search/quicksearch/show_button
							button class:searchbutton type:ok text:search
	//				list list:windowIcons extract:true
	//					link url:var:url target:_top
	//						image type:var:type align:middle
						
		row
			cell class:subaction colspan:2
			
				# Schleife über alle Menüpunkte
				list list:windowMenu extract:true value:xy
			
					if not:true empty:url
					# Menüpunkt
						link url:var:url target:cms_main_main title:var:title accesskey:var:key class:menu
							text var:text accesskey:var:key
					if empty:url
							text var:text class:menu_disabled
						
					# Trenner zwischen Menüpunkten
					text raw:__
