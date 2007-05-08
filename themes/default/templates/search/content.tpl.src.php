page
	form
		window icon:search 
			row 
				cell
					radio name:type value:lastchange_user
					label for:type value:lastchange_user
						text key:user_lastchange_user
				cell
					selectbox list:users name:lastchange_user default:var:act_userid
			row
				cell
					radio name:type value:value default:true
					label for:type value:value
						text key:value
				cell
					input name:text
			row
				cell colspan:2 class:act
					button type:ok
	focus field:name