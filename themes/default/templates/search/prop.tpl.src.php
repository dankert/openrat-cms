page
	form
		window icon:search 
			row 
				cell
					radio name:type value:create_user
					label for:type value:create_user
						text key:create_user
					newline
					radio name:type value:lastchange_user
					label for:type value:lastchange_user
						text key:lastchange_user
				cell
					selectbox list:users name:userid default:var:act_userid
			row 
				cell
					radio name:type value:id
					label for:type value:id
						text key:id
					newline
					radio name:type value:name default:true
					label for:type value:name
						text key:name
					newline
					radio name:type value:description
					label for:type value:description
						text key:description
					newline
					radio name:type value:filename
					label for:type value:filename
						text key:filename
					newline
				cell
					input name:text
			row class:
				cell colspan:2
					button type:ok
	focus field:name