page
	window
		row
			cell colspan:7 class:help
				text text:GLOBAL_FOLDER_DESC

		row
			cell class:help
				link url:orderbytype_url title:FOLDER_ORDERBYTYPE
					text text:GLOBAL_TYPE
				text raw:_/_
				link url:orderbyname_url title:FOLDER_ORDERBYNAME
					text text:GLOBAL_NAME
			cell class:help
				link url:orderbylastchange_url title:FOLDER_ORDERBYLASTCHANGE
					text text:GLOBAL_LASTCHANGE
			cell class:help colspan:4
				link url:flip_url title:FOLDER_FLIP
					text text:FOLDER_ORDER
		
		list list:object extract:true
			row
				cell width:40% class:fx
					image type:icon
					text var:name
				cell width:18% class:fx
					text var:date
				cell width:3% class:fx
					if present:upurl
						link url:upurl title:GLOBAL_UP
							set var:bild value:arrow_up
							image file:bild
					if empty:upurl
						text raw:_	
				cell width:3% class:fx			
					if present:topurl
						link url:topurl title:GLOBAL_TOP
							set var:bild value:arrow_top
							image file:bild
					if empty:topurl
						text raw:_	
				cell width:3% class:fx			
					if present:bottomurl
						link url:bottomurl title:GLOBAL_BOTTOM
							set var:bild value:arrow_bottom
							image file:bild
					if empty:bottomurl
						text raw:_	
				cell width:3% class:fx			
					if present:downurl
						link url:downurl title:GLOBAL_DOWN
							set var:bild value:arrow_down
							image file:bild
					if empty:downurl
						text raw:_	
