dummy
	form
		window
			row
				cell
					text text:page_template_old
				cell
					link url:var:template_url target:cms_main
						image type:template
						text var:template_name
			row
				cell
					text text:page_template_new
				cell
					selectbox name:templateid list:templates
			row
				cell colspan:2 class:act
					button type:ok text:button_next

	focus field:templateid