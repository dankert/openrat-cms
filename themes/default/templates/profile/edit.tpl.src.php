page
	form method:post
		window icon:user name:user_profile
			row
				cell
					text text:user_username
				cell class:name
					text var:name class:name

			row
				cell
					text text:user_mail
				cell
					#link action:profile subaction:mail title:message:menu_mail_desc
					text var:mail class:filename
					if false:mode:edit
						newline
						link class:action action:profile subaction:mail
							text key:edit
					
			row
				cell colspan:2
					fieldset
			row
				cell
					text text:user_fullname class:name
				cell
					input name:fullname size:40 maxlength:128
				
			row
				cell
					text text:user_tel
				cell
					input name:tel size:40 maxlength:128
			row
				cell
					text text:user_desc
				cell
					input name:desc size:40 maxlength:128

			row
				cell
					text text:user_style
				cell
					selectbox name:style list:allstyles default:config:interface/style/default
			
			row
				cell colspan:2 class:act
					button type:ok
	focus field:fullname