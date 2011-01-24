page
	form
		window
			table
				if empty:el
					row
						cell colspan:4
							text text:GLOBAL_NOT_FOUND
				if not: empty:el
					row
						cell class:help
							text text:PAGE_ELEMENT_NAME
						cell class:help
							text text:GLOBAL_CHANGE
						cell class:help
							text text:GLOBAL_VALUE
							
					list list:el extract:true
						row class:data
							cell
								label for:var:saveid
									image elementtype:var:type
									text var:name
							cell
								checkbox name:var:saveid default:false readonly:false
							cell
								if value:var:type contains:text,date,number
									input index:true type:text name:var:id default:var:value size:40 maxlength:255 onchange:onchange
								if value:var:type equals:longtext
									inputarea index:true name:var:id rows:7 cols:50 onchange:onchange default:var:value
								if value:var:type contains:select,link,list
									selectbox name:var:id list:list default:var:value


			fieldset title:message:options
	
				if present:release
					part
						checkbox name:release
						label for:release
							text raw:_
							text text:GLOBAL_RELEASE
	
				if present:publish
					part
						checkbox name:publish
						label for:publish
							text raw:_
							text text:PAGE_PUBLISH_AFTER_SAVE

			button type:ok
						