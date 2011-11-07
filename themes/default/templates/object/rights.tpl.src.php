dummy

	form
		window
			table
				row class:headline
					cell class:help
						text key:GLOBAL_NAME
					cell class:help
						text key:GLOBAL_LANGUAGE
						
					list list:show value:t
						cell class:help
							text key:var:t prefix:acl_ suffix:_abbrev
	
					cell class:help
						if true:mode:edit
							text key:global_delete
							
				if empty:acls
					row class:data
						cell
							text text:GLOBAL_NOT_FOUND
							
				if not:true empty:acls
		
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
					if value:var:type equals:folder
						row
							cell colspan:15
								fieldset title:message:options
						row
							cell colspan:15
								set var:inherit value:1
								input type:checkbox name:inherit
								label for:inherit
									text key:inherit_rights
				row
					cell class:act colspan:15
						button type:ok
						link class:action action:var:actionName subaction:aclform
							image icon:add
							text key:add