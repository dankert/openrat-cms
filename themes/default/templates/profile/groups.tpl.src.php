page
	window icon:user name:user_groups
		if empty:groups
			row
				cell class:help
					newline
					image notice:warning
					text key:NOT_FOUND
					newline
					newline
		list list:groups value:group
			row
				cell
					text var:group
