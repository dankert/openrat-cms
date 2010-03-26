page class:main

	window icon:folder
		list list:notices extract:true
			row
				cell colspan:2
					text key:var:key
					newline
				
		if present:up_url
			row
				cell width:50% colspan:8
					link url:var:up_url
						image type:folder
						text raw:__.._____________________
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
					link url:var:url title:var:desc class:var:class
						image type:var:icon
						text var:name
						text raw:_
				cell
					date date:var:date

		if empty:object
		
			row
				cell colspan:2
					text text:GLOBAL_NOT_FOUND

		if true:var:writable							
			row
				cell class:act colspan:2
					newline
					form action:filebrowser subaction:upload id:var:id enctype:multipart/form-data
						hidden name:CKEditorFuncNum
						text key:file
						text raw:__
						upload name:file
						text raw:__
						button type:ok text:add
					newline
					newline
					set var:name value:
					form action:filebrowser subaction:addfolder id:var:id
						hidden name:CKEditorFuncNum
						text key:folder
						text raw:__
						input name:name
						text raw:__
						button type:ok text:add
		