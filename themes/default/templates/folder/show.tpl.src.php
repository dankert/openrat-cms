page class:main
	window widths:75%,25%
		if present:up_url
			row
				cell width:50% colspan:8
					link url:var:up_url target:cms_main
						image type:folder
						text raw:__.._____________
		row class:headline
			cell class:help
				text key:GLOBAL_TYPE
				text raw:_/_
				text key:GLOBAL_NAME
			cell class:help
				text key:GLOBAL_LASTCHANGE
				
		list list:object extract:true
			row class:data
				cell
					link url:var:url target:cms_main title:var:desc class:var:class
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