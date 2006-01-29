insert file:header
	form action:page subaction:saveform
		window title:TEMPLATE_ELEMENTS name:TEMPLATE_ELEMENTS widths:30%,5%,65%

			if empty:el
				row
					cell colspan:4 class:fx
						text text:GLOBAL_NOT_FOUND
			if empty:el invert:true
				row
					cell class:help
						text text:PAGE_ELEMENT_NAME
					cell class:help
						text text:GLOBAL_CHANGE
					cell class:help
						text text:GLOBAL_VALUE
						
				list list:el extract:true
					row
						cell class:fx
							image elementtype:type
							text var:name
						cell class:fx
							checkbox name:id prefix:saveid default:false readonly:false
						cell class:fx
							if var:type contains:text,date,number
								input index:true type:text name:id prefix:id value:value size:40 maxlength:255 onchange:onchange
							if var:type value:longtext
								inputarea index:true name:id prefix:id rows:7 cols:50 onchange:onchange value:value
							if var:type contains:select,link,list
								selectbox name:id list:list default:value

				if true:release
					row
						cell class:fx
							text raw:_
						cell class:fx colspan:2
							checkbox name:release default:true
							text raw:_
							text text:GLOBAL_RELEASE
				if true:publish
					row
						cell class:fx
							text raw:_
						cell class:fx colspan:2
							checkbox name:publish default:false
							text raw:_
							text text:PAGE_PUBLISH_AFTER_SAVE
	
				row
					cell class:act colspan:4
						button type:ok
						
insert file:footer