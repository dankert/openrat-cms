page
	window icon:template name:pages
		list list:pages value:name key:pageid
			row
				cell
					image icon:page
					link action:main subaction:page id:var:pageid target:cms_main
						text var:name
