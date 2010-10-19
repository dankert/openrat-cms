frameset-page
	if true:config:interface/application_mode
		set var:menuheight value:30
	else
		set var:menuheight value:60
#	frameset rows:3,{menuheight},*,3
	frameset rows:{menuheight},*
#		frame file:frame_src_border
		frame file:var:frame_src_main_menu name:cms_main_menu
		frame file:var:frame_src_main_main name:cms_main_main scrolling:auto
#		frame file:frame_src_border