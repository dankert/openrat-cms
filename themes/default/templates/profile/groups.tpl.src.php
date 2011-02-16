dummy
	window icon:user name:user_groups
		row
			cell
				fieldset title:message:groups
					if empty:groups
						newline
						image notice:warning
						text key:NOT_FOUND
						newline
						newline
					list list:groups value:group
						text var:group
						newline
