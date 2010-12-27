frameset-page

	if true:config:interface/application_mode
		set var:menuheight value:30
	else
		set var:menuheight value:60

	if true:config:interface/application_mode

		frameset rows:*
				
			frameset columns:25%,*
				frameset rows:{menuheight},*
					frame file:var:frame_src_tree_title name:cms_treemenu
					frame file:var:frame_src_tree name:cms_tree scrolling:auto
				frame file:var:frame_src_main name:cms_main

	else					
		frameset rows:23,*
			frame file:var:frame_src_title name:cms_title
	
			frameset columns:25%,*
				frameset rows:{menuheight},*
					frame file:var:frame_src_tree_title name:cms_treemenu
					frame file:var:frame_src_tree name:cms_tree scrolling:auto
				frame file:var:frame_src_main name:cms_main
			#frame file:var:frame_src_status
					
