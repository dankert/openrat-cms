page

	form
		window widths:10px,150px
			if present:elements
				row
					cell
						radio name:type value:addelement
					cell
						label for:type_addelement
							text key:value
					cell
						selectbox name:elementid list:elements
						
			if present:writable_elements
				row
					cell colspan:3
						fieldset
				row
					cell
						radio name:type value:addicon
					cell
						label for:type_addicon
							text key:GLOBAL_ICON
					cell rowspan:3
						selectbox name:writable_elementid list:writable_elements
				row
					cell
						radio name:type value:addifempty
					cell
						label for:type_addifempty
							text key:TEMPLATE_SRC_IFEMPTY
				row
					cell
						radio name:type value:addifnotempty
					cell
						label for:type_addifnotempty
							text key:TEMPLATE_SRC_IFEMPTY
			
			row
				cell colspan:3 class:act
					button type:ok