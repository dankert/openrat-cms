frameset-page

	frameset rows:20,5,*,5
		frame file:frame_src_title name:cms_title
		frame file:frame_src_background

		frameset columns:5,3,25%,3,5,3,*,3,5
			frame file:frame_src_background
			frame file:frame_src_border
			frameset rows:3,69,*,3
				frame file:frame_src_border
				frame file:frame_src_treemenu name:cms_treemenu
				frame file:frame_src_tree name:cms_tree scrolling:auto
				//frame file:frame_src_clipboard name:cms_clipboard
				frame file:frame_src_border
			frame file:frame_src_border
			frame file:frame_src_background
			frame file:frame_src_border
			frame file:frame_src_main name:cms_main
			frame file:frame_src_border
			frame file:frame_src_background
		frame file:frame_src_background
				