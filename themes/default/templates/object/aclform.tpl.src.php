page

	form

		window title:GLOBAL_ADD

			row
				cell colspan:3
					fieldset title:message:users
					
			row
				cell width:10px
					radio name:type value:all
				cell
					label for:type value:all
						text text:GLOBAL_ALL
				cell
					text raw:_
			row
				cell width:10px
					radio name:type value:user
				cell
					label for:type value:user
						text text:GLOBAL_USER
				cell
					selectbox name:userid list:users addempty:true
			if present:groups
				row
					cell width:10px
						radio name:type value:group
					cell
						label for:type value:group
							text text:GLOBAL_GROUP
					cell
						selectbox name:groupid list:groups addempty:true

			row
				cell colspan:3
					fieldset title:message:language
			row
				cell width:10px
					text raw:_
				cell
					label for:languageid
						text text:GLOBAL_LANGUAGE
				cell
					selectbox name:languageid list:languages

			row
				cell colspan:3
					fieldset title:message:acl
	
			list list:show value:t key:k
				row
//					cell
//					cell width:20px
//						label for:var:t
//							text key:var:t prefix:acl_ suffix:_abbrev
					cell width:10px
						if value:var:t equals:read
							set var:var:t value:true
							checkbox name:var:t readonly:true
						else
							set var:var:t value:false
							checkbox name:var:t readonly:false 
					cell colspan:2
						label for:var:t
							text key:var:t prefix:acl_
			row
				cell colspan:3 class:act
					button type:ok

