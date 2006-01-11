page
	form action:index subaction:login target:_top
		window title:GLOBAL_LOGIN name:login width:400

			if present:logo
				row
					cell colspan:2
						if present:logo_url
							link url:logo_url target:_top
								image url:logo
						if empty:logo
							image url:logo

			if present:motd
				row
					cell class:motd colspan:2
						text var:motd

			if true:nologin
				row
					cell class:help colspan:2
						text text:LOGIN_NOLOGIN_DESC

			if true:readonly
				row
					cell class:help colspan:2
						text text:GLOBAL_READONLY_DESC

			if true:nopublish
				row
					cell class:help colspan:2
						text text:GLOBAL_NOPUBLISH_DESC

			if false:nologin
				row
					cell class:fx width:50%
						text text:USER_USERNAME
					cell class:fx width:50%
						input type:text name:login_name value: size:25
				row
					cell class:fx width:50%
						text text:USER_PASSWORD
					cell class:fx width:50%
						input type:password name:login_password value: size:25

				row
					cell class:fx width:50%
						text text:GLOBAL_DATABASE
					cell class:fx width:50%
						selectbox name:dbid list:dbids default:actdbid
						input type:hidden name:screenwidth default:9999
						#script 
				row
					cell colspan:2 class:act
						button type:ok
RAW
<script name="javascript1.2" type="text/javascript">
<!--
document.forms[0].screenwidth.value=window.innerWidth;
//-->
</script>
END

	# The GPL licence requires this text, so NEVER remove nor change it.

	newline
	newline
	link url:http://www.gnu.org/copyleft/gpl.html target:_top
		text text:GLOBAL_GPL

	focus field:login_name
