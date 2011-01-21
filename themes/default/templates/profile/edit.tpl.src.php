page
	form method:post
		window icon:user name:user_profile
			row
				cell colspan:2
					fieldset title:message:name
						part
							label for:name
								text key:user_username
							text var:name class:name

					fieldset title:message:MENU_PROFILE_MAIL
						part
							label for:mail
								text text:user_mail
							#link action:profile subaction:mail title:message:menu_mail_desc
							text var:mail class:filename
							if false:mode:edit
								newline
								link class:action action:profile subaction:mail
									text key:edit
					
					fieldset title:message:GLOBAL_PROP
						part
							label for:fullname
								text text:user_fullname class:name
							input name:fullname size:40 maxlength:128
						part
							label for:tel
								text text:user_tel
							input name:tel size:40 maxlength:128
							
						part
							label for:desc
								text text:user_desc
							input name:desc size:40 maxlength:128

						part
							label for:style
								text text:user_style
							selectbox name:style list:allstyles default:config:interface/style/default
			
			row
				cell colspan:2 class:act
					button type:ok
	focus field:fullname