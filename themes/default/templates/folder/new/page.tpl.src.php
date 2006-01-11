page
	form action:folder subaction:createnew

		window title: name:
			row
				cell class:fx
					text text:global_TEMPLATE
				cell class:fx
					selectbox name:templateid list:templates
			row
				cell class:fx
					text text:global_NAME
				cell class:fx
					input name:pagename size:20 default:
			row
				cell class:act colspan:2
					button type:ok

	focus field:pagename
