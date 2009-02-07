page
	form
		window name:USER_MEMBERSHIPS widths:5%,95% width:70%
			list list:memberships extract:true
				row
					cell
						checkbox name:var:var
					cell
						label for:var:var
							image file:icon_group
							text var:name
			row
				cell colspan:2 class:act
					button type:ok 