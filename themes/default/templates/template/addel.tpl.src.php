dummy
	form
		window name:GLOBAL_TEMPLATES
	
			row
				cell
					text text:global_name
				cell
					input name:name
	
			row
				cell
					text text:element_type
				cell
					set var:text value:text
					selectbox list:types default:text name:type lang:true
					
			row
				cell colspan:2
					fieldset title:message:options
			row
				cell
				cell
					label for:addtotemplate
						checkbox name:addtotemplate default:true
						text key:menu_template_srcelement
	
			row
				cell class:act colspan:2
					button type:ok
	
		focus field:name