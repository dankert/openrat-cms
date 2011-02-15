page class:main
	window
		table
			row class:headline
				cell class:help
					text key:GLOBAL_TYPE
					text raw:_/_
					text key:GLOBAL_NAME
				cell class:help
					text key:GLOBAL_LASTCHANGE
					
			if present:up_url
				row class:data
					cell url:var:up_url
						image type:folder
						text raw:..
					cell
						text raw:
							
			list list:object extract:true
				row class:data
					cell url:var:url title:var:desc class:var:class
						image type:var:icon
						text var:name
						text raw:_
					cell
						date date:var:date
	
			if empty:object
			
				row
					cell colspan:2
						text text:GLOBAL_NOT_FOUND
						
			row
				cell
					link class:action action:folder subaction:select
						image file:icon/select
						text key:menu_folder_select
					link class:action action:folder subaction:order
						image file:icon/order
						text key:menu_folder_order
					link class:action action:folder subaction:create
						image file:icon/create
						text key:menu_folder_create