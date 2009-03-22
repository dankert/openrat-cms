page class:main
	window widths:75%,25%
		if present:up_url
			row
				cell width:50% colspan:8
					link url:var:up_url target:cms_main
						image type:folder
						text raw:__.._____________
		row
			cell class:help
				text text:GLOBAL_TYPE
				text raw:_/_
				text text:GLOBAL_NAME
			cell class:help
				text text:GLOBAL_LASTCHANGE
				
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