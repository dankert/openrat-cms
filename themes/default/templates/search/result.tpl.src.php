dummy
	window icon:search widths:70%,30%
		row
			cell class:help
				text key:GLOBAL_NAME
			cell class:help
				text key:GLOBAL_LASTCHANGE
				
		list list:result extract:true 
			row class:data
				cell
					link url:var:url target:cms_main
						image type:var:type
						text var:name title:var:desc
				cell
					date date:var:lastchange_date
						