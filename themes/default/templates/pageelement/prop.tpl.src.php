dummy

	form
		window icon:folder widths:40%,60%
			row
				cell
					text text:name
				cell class:name
					text var:name
			row
				cell
					text text:description
				cell
					text var:description
			row
				cell
					text text:type
				cell class:filename
					image elementtype:var:element_type
					text key:el_{element_type}
			row
				cell colspan:2
					fieldset title:message:additional_info
			row
				cell
					text key:template
				cell
					if present:template_url
						link url:var:template_url target:cms_main_main
							image file:icon_template
							text var:template_name
					if empty:template_url
						image file:icon_template
						text var:template_name
			row
				cell
					text key:element
				cell
					if present:element_url
						link url:var:element_url target:cms_main_main
							image elementtype:var:element_type
							text var:element_name
					if empty:element_url
						image icon:element
						text var:element_name
			if present:text
				row
					cell colspan:2
						fieldset title:message:DOCUMENT_TREE
				row
					cell colspan:2
						editor type:dom name:text
			row
				cell colspan:2
					fieldset title:message:prop_userinfo
			row
				cell
					text text:lastchange
				cell
					table
						row
							cell
								image icon:el_date
								date date:var:lastchange_date
							cell
								image icon:user
								user user:var:lastchange_user
