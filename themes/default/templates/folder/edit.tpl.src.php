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
				row
					cell
						image icon:var:type
					cell
						text var:name
						text raw:_

			if present:folder
				row
					cell colspan:2
						text text:message:folder_select_target_folder
						text raw::_		
						selectbox name:targetobjectid list:folder

			if present:ask_filename
				row
					cell colspan:2		
						input name:filename

			if present:ask_commit
				row
					cell colspan:2
						checkbox name:commit
						label for:commit
							text raw:_
							text text:message:FOLDER_SELECT_DELETE_COMMIT

			row
				cell class:act colspan:2
					button type:ok
			
	dummy
			
