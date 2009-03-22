page

	form
		window title:ACL name:x
	
			if empty:acls
				row
					cell
						text text:GLOBAL_NOT_FOUND
			if not:true empty:acls
				row
					cell class:help
						text text:GLOBAL_NAME
					cell class:help
						text text:GLOBAL_LANGUAGE
						
					list list:show value:t
						cell class:help
							text key:var:t prefix:acl_ suffix:_abbrev
	
					cell class:help
						if true:mode:edit
							text text:global_delete
	
			list list:acls key:aclid value:acl extract:true
				row class:data
					cell
						if present:username
							image type:user
							text var:username
						if present:groupname
							image type:group
							text var:groupname
						if not:true present:username
							if not:true present:groupname
								image type:group
								text key:global_all
					cell
						text var:languagename
	
					list list:show value:t
						cell
							checkbox name:var:t default:false readonly:true
					cell
						if true:mode:edit
							if present:delete_url
									link url:var:delete_url
										text key:GLOBAL_DELETE
	
			if true:mode:edit
				row
					cell colspan:15
						set var:inherit value:1
						input type:checkbox name:inherit
						label for:inherit
							text key:inherit_rights
				row
					cell class:act colspan:15
						button type:ok