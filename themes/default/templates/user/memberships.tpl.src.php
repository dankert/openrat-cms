form
	window
		table
			row class:headline
				cell width:10%
				cell
					text key:name
			list list:memberships extract:true
				row class:data
					cell
						checkbox name:var:var
					cell
						label for:var:var
							image file:icon_group
							text var:name
			row
				cell colspan:2 class:act
					button type:ok 