page
	form
		window
			row
				cell class:fx
					text text:page_template
				cell class:fx
					link url:template_url
						image type:template
						text var:template_name
			row
				cell
					text text:page_template
				cell
					selectbox name:templateid list:templates
			row
				cell colspan:2 class:act
					button type:ok

	focus field:templateid