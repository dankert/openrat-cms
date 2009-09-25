page
	form
		window icon:search 
			row 
				cell colspan:2
					fieldset title:message:global_user
			row
				cell
					radio name:type value:lastchange_user
					label for:type value:lastchange_user
						text key:lastchange_user
				cell
					selectbox list:users name:userid default:var:act_userid
								
			row 
				cell colspan:2
					fieldset title:message:SEARCH_CONTENT
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