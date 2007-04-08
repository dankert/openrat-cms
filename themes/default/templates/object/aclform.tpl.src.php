page

	form

		window title:GLOBAL_ADD
	
			row
				cell class:fx
					text text:GLOBAL_ALL
				cell class:fx
					radio name:type value:all default:true
				cell class:fx
					text raw:_
			row
				cell class:fx
					text text:GLOBAL_USER
				cell class:fx
					radio name:type value:user
				cell class:fx
					selectbox name:userid list:users
			if present:groups
				row
					cell class:fx
						text text:GLOBAL_GROUP
					cell class:fx
						radio name:type value:group
					cell class:fx
						selectbox name:groupid list:groups
			row
				cell colspan:3 class:help
					text raw:_
			row
				cell class:fx
					text text:GLOBAL_LANGUAGE
				cell class:fx
					text raw:_
				cell class:fx
					selectbox name:languageid list:languages
			row
				cell colspan:3 class:help
					text raw:_
	
			list list:show value:t key:k
				row
					cell
						text key:var:t prefix:acl_
					cell width:20px
						text key:var:t prefix:acl_ suffix:_abbrev
					cell
						if value:var:t equals:read
							set var:var:t value:true
							checkbox name:var:t readonly:true
						else
							set var:var:t value:false
							checkbox name:var:t readonly:false 
			row
				cell colspan:3 class:act
					button type:ok

