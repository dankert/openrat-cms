table
	row class:headline
		cell
			text key:name
	if empty:groups
		row class:data
			cell
				text key:NOT_FOUND
	list list:groups value:group
		row class:data
			cell
				text var:group