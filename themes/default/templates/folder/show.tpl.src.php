page class:main
	window widths:75%,25%
		row
			cell colspan:7 class:help
				text text:GLOBAL_FOLDER_DESC
		if present:up_url
			row
				cell width:50% colspan:8 class:fx
					link url:up_url target:cms_main
						image type:folder
						text raw:_...
		row
			cell class:help
				text text:GLOBAL_TYPE
				text raw:_/_
				text text:GLOBAL_NAME
			cell class:help
				text text:GLOBAL_LASTCHANGE
				
		list list:object extract:true
			row
				cell class:fx
					link url:var:url target:cms_main title:desc
						image type:var:icon
						text text:var:name
						text raw:_
				cell class:fx
					text date:var:date

		if empty:object
		
			row
				cell class:fx colspan:2
					text text:GLOBAL_NOT_FOUND