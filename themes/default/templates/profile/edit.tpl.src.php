page
	form method:post
		window icon:user name:user_profile
			row
				cell
					text text:user_username
				cell class:fx
					text var:name
					
			row
				cell
					text text:user_fullname
				cell class:fx
					input name:fullname size:40 maxlength:128
				
			row
				cell
					text text:user_tel
				cell class:fx
					input name:tel size:40 maxlength:128
			row
				cell
					text text:user_desc
				cell class:fx
					input name:desc size:40 maxlength:128

			row
				cell
					text text:user_style
				cell class:fx
					selectbox name:style list:allstyles default:style
			
			row
				cell colspan:2 class:act
					button type:ok
	focus field:fullname