page
	form
		window widths:5%,5%,5%,15%,15%,35%,10%,10%
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
					cell class:fx colspan:8
						text text:GLOBAL_NOT_FOUND

			list list:el extract:true
				row
					cell class:fx
						text text:var:lfd_nr
					cell class:fx
						if present:compareid
							radio name:compareid value:var:id
					cell class:fx
						if present:compareid
							radio name:withid value:var:id
					cell class:fx
						date date:var:date
					cell class:fx
						text text:user
					cell class:fx
						text text:var:value
					cell class:fx
						if true:var:public
							text text:message:GLOBAL_PUBLIC type:strong
						else
							if present:releaseUrl 
								link url:var:releaseUrl title:message:GLOBAL_RELEASE_DESC
									text text:message:GLOBAL_RELEASE type:strong
							else
								text text:message:GLOBAL_INACTIVE type:emphatic
							
					cell class:fx
						if true:var:active
							text text:message:GLOBAL_ACTIVE type:emphatic
						else
							if present:useUrl
								link url:var:useUrl title:message:GLOBAL_USE_DESC
									text text:message:GLOBAL_USE

			if present:compareid
				row
					cell colspan:8 class:act
						button type:ok