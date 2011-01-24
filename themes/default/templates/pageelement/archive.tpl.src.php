page
	form
		window
			fieldset
				table widths:5%,5%,5%,15%,15%,35%,10%,10%
					row
						cell class:help
							text text:GLOBAL_NR
						cell class:help colspan:2
							if present:compareid
								text text:GLOBAL_COMPARE
						cell class:help
							text text:DATE
						cell class:help
							text text:GLOBAL_USER
						cell class:help
							text text:GLOBAL_VALUE
						cell class:help
							text text:GLOBAL_STATE
						cell class:help
							text text:GLOBAL_ACTION
		
					if empty:el
						row
							cell colspan:8
								text text:GLOBAL_NOT_FOUND
		
					list list:el extract:true
						row class:data
							cell
								text var:lfd_nr
							cell
								if present:compareid
									radio name:compareid value:var:id
							cell
								if present:compareid
									radio name:withid value:var:id
							cell
								date date:var:date
							cell
								text var:user
							cell
								text var:value
							cell
								if true:var:public
									text key:GLOBAL_PUBLIC type:strong
								else
									if present:releaseUrl 
										link url:var:releaseUrl title:message:GLOBAL_RELEASE_DESC
											text key:GLOBAL_RELEASE type:strong
									else
										text key:GLOBAL_INACTIVE type:emphatic
									
							cell
								if true:var:active
									text key:GLOBAL_ACTIVE type:emphatic
								else
									if present:useUrl
										link url:var:useUrl title:message:GLOBAL_USE_DESC
											text key:GLOBAL_USE
		
			if present:compareid
				row
					cell colspan:8 class:act
						button type:ok