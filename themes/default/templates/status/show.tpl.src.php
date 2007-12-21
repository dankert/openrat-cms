page class:status
	table
		row
			if present:projects
				cell
					form target:_top action:index subaction:project method:post
						input type:hidden name:idvar default:text:projectid
						image icon:project
						selectbox list:projects name:projectid addempty:projects onchange:submit()
						button type:ok text:message:>
			if value:size:models greaterthan:1
				cell
					form target:_top action:index subaction:model method:get
						input type:hidden name:idvar default:text:modelid
						image icon:model
						selectbox list:models name:modelid addempty:model onchange:submit()
						button type:ok text:>
			if value:size:languages greaterthan:1
				cell
					form target:_top action:index subaction:language method:get
						input type:hidden name:idvar default:text:languageid
						image icon:language
						selectbox list:languages name:languageid addempty:language onchange:submit()
						button type:ok text:>
			if present:templates
				cell
					form target:cms_main action:main subaction:template method:get
						input type:hidden name:idvar default:text:templateid
						image icon:template
						selectbox list:templates name:templateid addempty:template onchange:submit()
						button type:ok text:>
			if present:users
				cell
					form target:cms_main action:main subaction:user method:get
						input type:hidden name:idvar default:text:userid
						image icon:user
						selectbox list:users name:userid addempty:user onchange:submit()
						button type:ok text:>
			if present:groups
				cell
					form target:cms_main action:main subaction:group method:get
						input type:hidden name:idvar default:text:groupid
						image icon:group
						selectbox list:groups name:groupid addempty:group onchange:submit()
						button type:ok text:>