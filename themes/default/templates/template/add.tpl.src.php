dummy
	form
		window name:GLOBAL_TEMPLATES widths:10px,40px
	
			row
				cell colspan:2
					text text:message:name
				cell
					input name:name
			row
				cell colspan:3
					fieldset title:message:options
			row
				cell
					radio name:type value:empty
				cell
					label for:type_empty
						text key:empty
			row
				cell
					radio name:type value:copy
				cell
					label for:type_copy
						text key:copy
				cell
					selectbox name:templateid list:templates
			row
				cell
					radio name:type value:example
				cell
					label for:type_example
						text key:example
				cell
					selectbox name:example list:examples
			row
				cell colspan:3 class:act
					button type:ok
	
	focus field:name