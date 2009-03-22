page
	form action:index subaction:login target:_top
		window title:GLOBAL_LOGIN name:login width:400px icon:user
	
			if present:config:login/logo/file
				if false:property:mustChangePassword
					row
						cell colspan:2
							if present:config:login/logo/url
								link url:config:login/logo/url target:_top
									image url:config:login/logo/file
							if empty:config:login/logo/url
								image url:config:login/logo/file

			if present:config:login/motd
				row
					cell class:motd colspan:2
						text raw:config:login/motd

			if true:config:login/nologin
				row
					cell class:help colspan:2 
						text key:LOGIN_NOLOGIN_DESC

			if true:config:security/readonly
				row
					cell class:help colspan:2
						text key:GLOBAL_READONLY_DESC

			if true:config:security/nopublish
				row
					cell class:help colspan:2
						text key:GLOBAL_NOPUBLISH_DESC

			if false:config:login/nologin
				row
					cell class:logo colspan:2
						logo name:login
				row
					cell
						text key:USER_USERNAME
					cell
						if not:true present:force_username
							input type:text name:login_name class:name value: size:20
						else
							input type:hidden name:login_name value:var:force_username
							text value:var:force_username
				row
					cell
						text key:USER_PASSWORD
					cell
						password name:login_password class:name default: size:20
	
				if true:property:mustChangePassword
					row
						cell colspan:2
							fieldset title:message:USER_NEW_PASSWORD
					row
						cell
							text key:USER_NEW_PASSWORD
						cell
							password name:password1 default: size:25

					row
						cell
							text key:USER_NEW_PASSWORD_REPEAT
						cell
							password name:password2 default: size:25
	
				if true:config:security/openid/enable
					row
						cell colspan:2
							fieldset title:message:OPENID
					row
						cell
							if not:true empty:config:security/openid/logo_url
								image url:config:security/openid/logo_url
							text key:openid_user
						cell
							input name:openid_url class:name size:20
				if value:size:dbids greaterthan:1
					row
						row
							cell colspan:2
								fieldset title:message:DATABASE
						cell
							text key:DATABASE
						cell
							selectbox name:dbid list:dbids default:var:actdbid
							hidden name:screenwidth default:9999
							#script 
				row
					cell colspan:2 class:act
						button type:ok
						insert script:screenwidth
		if value:size:dbids lessthan:2
			hidden name:dbid default:var:actdbid
		hidden name:objectid
		hidden name:modelid
		hidden name:projectid
		hidden name:languageid

	# The GPL licence requires this text, so NEVER remove nor change it.

	newline
	newline
	link url:config:login/gpl/url target:_top
		text value:message:GLOBAL_GPL

	if present:force_username
		focus field:login_password
	else
		focus field:login_name
