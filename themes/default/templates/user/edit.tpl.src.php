dummy
	form
		window name:GLOBAL_USER widths:50%,50%
			if not: empty:image
				row
					cell
					cell
						newline
						image url:var:image size:80x80 title:var:fullname
			row
				cell colspan:2
					fieldset title:message:NAME
						part
							label for:name
								text text:user_username
							input name:name size:20 class:name
						
					fieldset title:message:ADDITIONAL_INFO
						part
							label for:fullname
								text text:user_fullname
							input name:fullname
						if true:config:security/user/show_admin_mail
							part
								label for:mail
									text text:user_mail
								input name:mail
						part
							label for:desc
								text text:user_desc
							input name:desc
						part
							label for:tel
								text text:user_tel
							input name:tel
							
					fieldset title:message:options
						part
							checkbox name:is_admin
							label for:is_admin
								text text:user_admin
						part
							label for:ldap_dn
								text text:user_ldapdn
							input name:ldap_dn size:50
						part
							label for:style
								text text:user_style
							selectbox list:allstyles name:style default:config:interface/style/default
			row
				cell colspan:2 class:act
					button type:ok
	focus field:name