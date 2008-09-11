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
						//focus field:text

						//if value:var:editor equals:wiki
//						if present:preview_text
//							text var:preview_text
//							newline
						
//						editor type:wiki name:text
						inputarea class:longtext name:text rows:25 cols:70
						
						if true:mode:edit
							fieldset title:message:help
							table
								cell
									text text:config:editor/text-markup/strong-begin
									text text:message:text_markup_strong
									text text:config:editor/text-markup/strong-end
									newline
									text text:config:editor/text-markup/emphatic-begin
									text text:message:text_markup_emphatic
									text text:config:editor/text-markup/emphatic-end
								cell
									text text:config:editor/text-markup/list-numbered
									text text:message:text_markup_numbered_list
									newline
									text text:config:editor/text-markup/list-numbered
									text text::...
									newline
								cell
									text text:config:editor/text-markup/list-unnumbered
									text text:message:text_markup_unnumbered_list
									newline
									text text:config:editor/text-markup/list-unnumbered
									text text::...
									newline
								cell
									text text:config:editor/text-markup/table-cell-sep
									text text:message:text_markup_table
									text text:config:editor/text-markup/table-cell-sep
									text text::...
									text text:config:editor/text-markup/table-cell-sep
									text text::...
									text text:config:editor/text-markup/table-cell-sep
									newline
									text text:config:editor/text-markup/table-cell-sep
									text text::...
									text text:config:editor/text-markup/table-cell-sep
									text text::...
									text text:config:editor/text-markup/table-cell-sep
									text text::...
									text text:config:editor/text-markup/table-cell-sep
									newline
									


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

			if true:mode:edit
				if present:release
					if present:publish
						row
							cell colspan:2
								fieldset title:message:options
	
				if present:release
					row
						cell colspan:2 class:fx
							checkbox name:release
							label for:release
								text text:GLOBAL_RELEASE
	
				if present:publish
					row
						cell colspan:2 class:fx
							checkbox name:publish
							label for:publish
								text text:PAGE_PUBLISH_AFTER_SAVE
	
			row
				cell colspan:2 class:act
					button type:ok
