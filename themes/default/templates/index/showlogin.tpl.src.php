page
	form action:index subaction:login target:_top
		window title:GLOBAL_LOGIN name:login width:400 icon:user
	
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
					cell class:fx width:50%
						text key:USER_USERNAME
					cell class:fx width:50%
						input type:text name:login_name value: size:25
				row
					cell class:fx width:50%
						text key:USER_PASSWORD
					cell class:fx width:50%
						password name:login_password default: size:25
	
				if true:property:mustChangePassword
					row
						cell class:fx width:50%
							text key:USER_NEW_PASSWORD
						cell class:fx width:50%
							password name:password1 default: size:25

					row
						cell class:fx width:50%
							text key:USER_NEW_PASSWORD_REPEAT
						cell class:fx width:50%
							password name:password2 default: size:25
	
				row
					cell class:fx width:50%
						text key:GLOBAL_DATABASE
					cell class:fx width:50%
						selectbox name:dbid list:dbids default:actdbid
						hidden name:screenwidth default:9999
						#script 
				row
					cell colspan:2 class:act
						button type:ok
RAW
<script name="javascript1.2" type="text/javascript">
<!--
document.forms[0].screenwidth.value=window.innerWidth;
//	-->
</script>
END

	# The GPL licence requires this text, so NEVER remove nor change it.

	newline
	newline
	link url:config:login/gpl/url target:_top
		text value:message:GLOBAL_GPL

	focus field:login_name
