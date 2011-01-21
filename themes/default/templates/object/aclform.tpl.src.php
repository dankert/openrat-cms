page

	form

		window title:GLOBAL_ADD

			row
				cell colspan:3
					fieldset title:message:users
					
						part
							radio name:type value:all
							label for:type value:all
								text text:GLOBAL_ALL
						part
							radio name:type value:user
							label for:type value:user
								text text:GLOBAL_USER
							selectbox name:userid list:users addempty:true
						part
							if present:groups
								radio name:type value:group
								label for:type value:group
									text text:GLOBAL_GROUP
								selectbox name:groupid list:groups addempty:true

			row
				cell colspan:3
					fieldset title:message:language
						label for:languageid
							text text:GLOBAL_LANGUAGE
						selectbox name:languageid list:languages
			row
				cell colspan:3
					fieldset title:message:acl
	
						list list:show value:t key:k
							part
								if value:var:t equals:read
									set var:var:t value:true
									checkbox name:var:t readonly:true
								else
									set var:var:t value:false
									checkbox name:var:t readonly:false
								label for:var:t value:
									text key:var:t prefix:acl_
			row
				cell colspan:2 class:act
					button type:ok

