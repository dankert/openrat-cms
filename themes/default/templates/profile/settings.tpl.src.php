dummy
	form method:post
		window
			row
				cell
					fieldset title:message:settings
						part
							checkbox name:always_edit
							label for:always_edit
								text key:setting_always_edit
						part
							checkbox name:ignore_ok_notices
							label for:ignore_ok_notices
								text key:setting_ignore_ok_notices

					fieldset title:message:timezone
						selectbox name:timezone_offset list:timezone_list addempty:true

					fieldset title:message:language
						selectbox name:language list:language_list addempty:true

			row
				cell colspan:2 class:act
					button type:ok
