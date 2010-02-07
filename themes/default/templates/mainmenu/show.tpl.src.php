page class:menu
	table padding:5 space:0 width:100%

		if true:!config:interface/application_mode	
			row class:title
				cell
					if not:true value:var:type equals:empty
						image type:var:type
	
					list list:path extract:true value:xy
	
						link url:var:url title:var:title class:path target:cms_main
							text var:name maxlength:15
						char type:filesep
	
					text var:text title:var:text class:title maxlength:20
					
				cell class:menu style::text-align:right;
					if true:property:search
						form action:search subaction:quicksearch target:cms_main_main
							input class:search name:search size:15
		//					button class:searchbutton type:ok src:search
							if true:config:search/quicksearch/show_button
								button class:searchbutton type:ok text:search
		//				list list:windowIcons extract:true
		//					link url:var:url target:_top
		//						image type:var:type align:middle
						
		row class:menu
			cell colspan:2
				table class:submenu
					row
						# Schleife �ber alle Men�punkte
						list list:windowMenu extract:true value:xy
							if not:true empty:url
								# Menuepunkt
								cell class:action
									link url:var:url target:cms_main_main title:messagevar:title accesskey:var:key
										text key:var:text accesskey:var:key
							else
								cell class:noaction
									text key:var:text
								
