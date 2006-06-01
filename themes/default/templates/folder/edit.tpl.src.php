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
					cell class:fx
						image type:icon
						text var:name
						text raw:_

			if present:folder
				row
					cell class:fx		
						selectbox name:targetobjectid list:folder

			if present:ask_filename
				row
					cell class:fx		
						input name:filename

			if present:ask_commit
				row
					cell class:fx		
						checkbox name:commit

			row
				cell class:act colspan:2
					button type:ok
			
	dummy
			
