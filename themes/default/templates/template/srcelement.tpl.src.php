page

	form
		window
			if present:elements
				row
					cell class:fx
						checkbox name:addelement
					cell class:fx
						selectbox name:elementid list:elements
						
			if present:icon_elements
				row
					cell class:fx
						checkbox name:addicon
					cell class:fx
						selectbox name:iconid list:icon_elements
						
			if present:ifempty_elements
				row
					cell class:fx
						checkbox name:addifempty
					cell class:fx
						selectbox name:ifemptyid list:ifempty_elements
						
			if present:ifnotempty_elements
				row
					cell class:fx
						checkbox name:addifnotempty
					cell class:fx
						selectbox name:ifnotemptyid list:ifnotempty_elements
			
			row
				cell colspan:2 class:act
					button type:ok