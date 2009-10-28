page
	form method:post
		window
			row
				cell
					newline
					fieldset title:message:settings
						checkbox name:always_edit
					#cell
						label for:always_edit
							text key:setting_always_edit

			row
				cell
					newline
					fieldset title:message:timezone
						selectbox name:timezone_offset list:timezone_list addempty:true
					newline
			row
				cell
					newline
					fieldset title:message:language
						selectbox name:language list:language_list addempty:true
					newline

			row
				cell colspan:2 class:act
					button type:ok
