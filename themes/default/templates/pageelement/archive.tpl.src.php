page
	form
		window widths:5%,5%,5%,15%,15%,35%,10%,10%
			row
				cell class:help
					text text:GLOBAL_NR
				cell class:help colspan:2
					text text:GLOBAL_COMPARE
				cell class:help
					text text:DATE
				cell class:help
					text text:GLOBAL_USER
				cell class:help
					text text:GLOBAL_VALUE
				cell class:help
					text raw:_
				cell class:help
					text raw:_

			if empty:el
				row
					cell class:fx colspan:8
						text text:GLOBAL_NOT_FOUND

			list list:el extract:true
				row
					cell class:fx
						text var:lfd_nr
					cell class:fx
						radio name:compareid value:lfd_nr
					cell class:fx
						radio name:withid value:lfd_nr
					cell class:fx
						text var:date
					cell class:fx
						text var:user
					cell class:fx
						text var:value
					cell class:fx
						if true:public
							text text:GLOBAL_PUBLIC
						if present:releaseUrl
							link url:releaseUrl
								text text:GLOBAL_RELEASE
					cell class:fx
						if true:active
							text text:GLOBAL_ACTIVE
						if present:useUrl
							link url:useUrl
								text text:GLOBAL_USE

			row
				cell colspan:8 class:act
					button type:ok