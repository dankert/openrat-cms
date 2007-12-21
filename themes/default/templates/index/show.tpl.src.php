frameset-page

	if true:config:interface/application_mode
		set var:menuheight value:24
	else
		set var:menuheight value:54

	if true:config:interface/application_mode

		frameset rows:*
				
			frameset columns:25%,*
				frameset rows:{menuheight},*
					frame file:var:frame_src_tree_title name:cms_treemenu
					frame file:var:frame_src_tree name:cms_tree scrolling:auto
				frame file:var:frame_src_main name:cms_main

	else					
		frameset rows:23,3,*,3,20
			frame file:var:frame_src_title name:cms_title
			frame file:var:frame_src_border
			#frame file:var:frame_src_background
	
			if true:config:interface/application_mode
				set var:menuheight value:24
			else
				set var:menuheight value:54
				
			frameset columns:25%,*
				frameset rows:{menuheight},*
					frame file:var:frame_src_tree_title name:cms_treemenu
					frame file:var:frame_src_tree name:cms_tree scrolling:auto
				frame file:var:frame_src_main name:cms_main
			frame file:var:frame_src_border
			frame file:var:frame_src_status
					
