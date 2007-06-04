page
	window icon:search widths:50%,50%
		list list:result extract:true 
			row 
				cell
					link url:var:url target:cms_main
						image type:var:type
						text text:var:name title:var:desc
				cell
					date date:var:lastchange_date
						