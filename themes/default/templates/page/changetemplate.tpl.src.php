page
	form
		window
			row
				cell class:fx
					text text:page_template_old
				cell class:fx
					link url:template_url
						image type:template
						text var:template_name
			row
				cell
					text text:page_template_new
				cell
					selectbox name:templateid list:templates
			row
				cell colspan:2 class:act
					button type:ok text:message:button_next

	focus field:templateid