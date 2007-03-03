page
	form method:post
		input type:hidden name:elementid
		window name:element
			row
				cell colspan:2 class:help
					text var:desc

			if value:var:type equals:date
				row
					cell colspan:2 class:fx
						input size:25 maxlength:25 class:ansidate name:ansidate
						focus field:ansidate
					
			if value:var:type equals:text
				row
					cell colspan:2 class:fx
						input size:50 maxlength:255 class:text name:text
						focus field:text

			if value:var:type equals:longtext
				row
					cell colspan:2 class:fx
						inputarea class:longtext name:text rows:25 cols:70
						focus field:text

			if value:var:type equals:link
				row
					cell colspan:2 class:fx
						selectbox list:objects name:linkobjectid
						focus field:linkobjectid

			if value:var:type equals:list
				row
					cell colspan:2 class:fx
						selectbox list:objects name:linkobjectid
						focus field:linkobjectid

			if value:var:type equals:number
				row
					cell colspan:2 class:fx
						hidden name:decimals default:decimals
						input size:15 maxlength:20 name:number
						focus field:number

			if value:var:type equals:select
				row
					cell colspan:2 class:fx
						selectbox list:items name:text
						focus field:text

			if present:release
				row
					cell colspan:2 class:fx
						checkbox name:release
						text raw:_
						text text:GLOBAL_RELEASE

			if present:publish
				row
					cell colspan:2 class:fx
						checkbox name:publish
						text raw:_
						text text:PAGE_PUBLISH_AFTER_SAVE

			row
				cell colspan:2 class:act
					button type:ok
