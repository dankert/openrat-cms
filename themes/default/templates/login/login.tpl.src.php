dummy
	form action:login subaction:login target:_top
		#window title:GLOBAL_LOGIN name:login width:400px icon:user
		dummy
	
			fieldset
				if present:config:login/logo/file
					if false:property:mustChangePassword
						if present:config:login/logo/url
							link url:config:login/logo/url target:_top
								image url:config:login/logo/file
						if empty:config:login/logo/url
							image url:config:login/logo/file
	
				if not: empty:config:login/motd
					text raw:config:login/motd
	
				if true:config:login/nologin
					text key:LOGIN_NOLOGIN_DESC
	
				if true:config:security/readonly
					text key:GLOBAL_READONLY_DESC class:help
	
				if true:config:security/nopublish
					text key:GLOBAL_NOPUBLISH_DESC class:help
	
				if false:config:login/nologin
					logo name:login
					
					part
						label for:login_name
							text key:USER_USERNAME
						if not:true present:force_username
							input type:text name:login_name class:name value: size:20
						else
							input type:hidden name:login_name value:var:force_username
							text value:var:force_username
							
					part
						label for:login_password
							text key:USER_PASSWORD
						password name:login_password class:name default: size:20
		
				if true:property:mustChangePassword
					part
						fieldset title:message:USER_NEW_PASSWORD
					part
						label for:password1
							text key:USER_NEW_PASSWORD
						password name:password1 default: size:25

					part
						label for:password2
							text key:USER_NEW_PASSWORD_REPEAT
						password name:password2 default: size:25
		
				link class:action action:login subaction:password
					text key:menu_login_password
				link class:action action:login subaction:register
					text key:menu_login_register
							
			if true:config:security/openid/enable
				fieldset title:message:OPENID
					part
						if not:true empty:config:security/openid/logo_url
							image url:config:security/openid/logo_url
						text key:openid_user
						radiobox name:openid_provider list:openid_providers
						if true:var:openid_user_identity
							radio name:openid_provider value:identity
							input name:openid_url class:name size:20
			if value:size:dbids greaterthan:1
				fieldset title:message:DATABASE icon:database
					part
						label for:dbid
							text key:DATABASE
						selectbox name:dbid list:dbids default:var:actdbid
						hidden name:screenwidth default:9999
						#script
			else 
				hidden name:dbid default:var:actdbid
			button type:ok
			#insert script:screenwidth
			
		hidden name:objectid
		hidden name:modelid
		hidden name:projectid
		hidden name:languageid

	# The GPL licence requires this text, so NEVER remove nor change it.

	newline
	newline
	link url:config:login/gpl/url target:_top class:copyright
		text value:message:GPL

	if present:force_username
		focus field:login_password
	else
		focus field:login_name
