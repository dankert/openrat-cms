page

	window

		list list:projects extract:true
			row
				cell colspan:2
					fieldset title:var:projectname
		
						if empty:acls
							part
								text text:GLOBAL_NOT_FOUND
								
						if not:true empty:acls
							table
								row class:headline
									cell class:help
										text text:GLOBAL_USER
									cell class:help
										text text:GLOBAL_NAME
									cell class:help
										text text:GLOBAL_LANGUAGE
										
									list list:show value:t
										cell class:help
											text key:var:t prefix:acl_ suffix:_abbrev title:message:acl_{t}
				
								list list:rights key:aclid value:acl extract:true
									row class:data
										cell
											if present:username
												image type:user
												text var:username maxlength:20
											if present:groupname
												image type:group
												text var:groupname maxlength:20
											if not:true present:username
												if not:true present:groupname
													image type:group
													text key:global_all
											set var:username
											set var:groupname
										cell
											image type:var:objecttype
											link action:var:objecttype subaction: id:var:objectid
												text var:objectname maxlength:20 title:message:select
										cell
											text var:languagename maxlength:20
						
										list list:show
											cell
												set var:var:list_value value:var:bits key:var:list_value
												checkbox name:var:list_value readonly:true
