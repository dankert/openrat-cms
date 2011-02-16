dummy
	window icon:template name:pages
		table
			row class:headline
				cell
					text key:name
				
			list list:pages value:name key:pageid
				row class:data
					cell
						image icon:page
						link action:main subaction:page id:var:pageid target:cms_main
							text var:name
