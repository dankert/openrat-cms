dummy
	window
		table
			row
				cell colspan:7 class:help
					text text:GLOBAL_FOLDER_DESC
	
			row class:headline
				cell class:help colspan:4
					link url:var:flip_url title:message:FOLDER_FLIP
						text key:FOLDER_ORDER
				cell class:help
					link url:var:orderbytype_url title:message:FOLDER_ORDERBYTYPE
						text key:GLOBAL_TYPE
					text raw:_/_
					link url:var:orderbyname_url title:message:FOLDER_ORDERBYNAME
						text key:GLOBAL_NAME
				cell class:help
					link url:var:orderbylastchange_url title:message:FOLDER_ORDERBYLASTCHANGE
						text key:GLOBAL_LASTCHANGE
			
			list list:object extract:true
				row class:data
					cell width:3%
						if present:upurl
							link url:var:upurl title:GLOBAL_UP
								set var:bild value:arrow_up
								image file:var:bild
						if empty:upurl
							text raw:_	
					cell width:3%			
						if present:topurl
							link url:var:topurl title:GLOBAL_TOP
								set var:bild value:arrow_top
								image file:var:bild
						if empty:topurl
							text raw:_	
					cell width:3%			
						if present:bottomurl
							link url:var:bottomurl title:GLOBAL_BOTTOM
								set var:bild value:arrow_bottom
								image file:var:bild
						if empty:bottomurl
							text raw:_	
					cell width:3%			
						if present:downurl
							link url:var:downurl title:GLOBAL_DOWN
								set var:bild value:arrow_down
								image file:var:bild
						if empty:downurl
							text raw:_	
					cell width:40%
						image type:var:icon
						text var:name
					cell width:18%
						date date:var:date
							