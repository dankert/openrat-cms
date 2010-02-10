page
	form action:folder subaction:multiple
		hidden name:ids
		hidden name:type
		
		window name:bla title:titelso widths:5%,75%
			row
				cell class:help
					text raw:_
				cell class:help
					text text:GLOBAL_NAME
					
			list list:objectlist extract:true
				row class:data
					cell
						image icon:var:type
					cell
						text var:name
						text raw:_

			if present:folder
				//row
					//cell colspan:2
						//text key:folder_select_target_folder
						//text raw::_		
						//selectbox name:targetobjectid list:folder
				row
					cell colspan:2
						fieldset title:message:folder_select_target_folder
				list list:folder
					row class:data
						cell
							radio name:targetobjectid value:var:list_key
						cell
							label for:targetobjectid_{list_key}
								text var:list_value

			if present:ask_filename
				row
					cell colspan:2		
						input name:filename

			if present:ask_commit
				row
					cell colspan:2
						fieldset title:message:options
				row
					cell colspan:2
						checkbox name:commit
						label for:commit
							text raw:_
							text key:FOLDER_SELECT_DELETE_COMMIT

			row
				cell class:act colspan:2
					button type:ok
			
	dummy
			
