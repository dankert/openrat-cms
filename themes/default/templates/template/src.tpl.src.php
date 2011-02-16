dummy

	form
		window name:TEMPLATE_SOURCE
			row
				cell
					inputarea rows:25 cols:80 name:src class:editor
			
			row
				cell class:act
					button type:ok
					if false:mode:edit
						link class:action action:template subaction:srcelement
							text key:menu_template_srcelement
			
	focus field:src