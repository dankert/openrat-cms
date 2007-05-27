page
	form
		window name:GLOBAL_USER widths:50%,50%
			row
				cell
					text text:user_username
				cell
					input name:name size:20 class:name
			row
				cell colspan:2
					fieldset title:message:ADDITIONAL_INFO
			row
				cell
					text text:user_fullname
				cell
					input name:fullname
			row
				cell
					text text:user_mail
				cell
					input name:mail
			row
				cell
					text text:user_desc
				cell
					input name:desc
			row
				cell
					text text:user_tel
				cell
					input name:tel
			row
				cell colspan:2
					fieldset title:message:options
			row
//				cell colspan:2
				cell
				cell
					checkbox name:is_admin
					label for:is_admin
						text text:user_admin
			row
				cell
					text text:user_ldapdn
				cell
					input name:ldap_dn size:50
			row
				cell
					text text:user_style
				cell
					selectbox list:allstyles name:style default:config:interface/style/default
			row
				cell colspan:2 class:act
					button type:ok
	focus field:name