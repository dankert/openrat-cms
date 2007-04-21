page
	form
		window name:GLOBAL_USER widths:50%,50%
			row
				cell class:fx
					text text:user_username
				cell class:fx
					input name:name size:20
			row
				cell class:fx
					text text:user_fullname
				cell class:fx
					input name:fullname size:
			row
				cell class:fx
					text text:user_mail
				cell class:fx
					input name:mail size:
			row
				cell class:fx
					text text:user_desc
				cell class:fx
					input name:desc size:
			row
				cell class:fx
					text text:user_tel
				cell class:fx
					input name:tel size:
			row
				cell class:fx
					text text:user_ldapdn
				cell class:fx
					input name:ldap_dn size:
			row
				cell class:fx
					text text:user_style
				cell class:fx
					selectbox list:allstyles name:style default:config:interface/style/default
			row
				cell class:fx
					text text:user_admin
				cell class:fx
					checkbox name:is_admin
			row
				cell colspan:2 class:act
					button type:ok
	focus field:name