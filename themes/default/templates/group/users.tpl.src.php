dummy
	form
		window icon:user name:GROUP_MEMBERSHIPS
			list list:memberships extract:true
				row class:data
					cell
						checkbox name:var:var
					cell
						label for:var:var
							image file:icon_user
							text var:name
			row
				cell colspan:2 class:act
					button type:ok 