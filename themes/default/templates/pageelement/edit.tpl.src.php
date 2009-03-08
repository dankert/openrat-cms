page
	form method:post
		input type:hidden name:elementid
		window name:element
			row
				cell colspan:2 class:help
					text var:desc

			if value:var:type equals:date
				row
					cell colspan:2
						fieldset title:message:calendar
				row
					cell colspan:2
						table width:85% class:calendar
							row
								cell colspan:8 class:help
									if true:mode:edit
										link url:var:lastmonthurl
											image file:left align:middle
										text raw:_
									text var:monthname
									if true:mode:edit
										text raw:_
										link url:var:nextmonthurl
											image file:right align:middle
									text raw:_____
									if true:mode:edit
										link url:var:lastyearurl
											image file:left align:middle
										text raw:_
									text var:yearname
									if true:mode:edit
										text raw:_
										link url:var:nextyearurl
											image file:right align:middle
							row
								cell
									text key:week
								list list:weekdays value:weekday
									cell
										text var:weekday
		
							list list:weeklist key:weeknr value:week
								row
									cell width:12%
										text var:weeknr
									list list:week extract:true
										cell width:12%
											if empty:url
												text raw:__
												text var:nr
												text raw:__
											if not:true empty:url
												link url:var:url
													text raw:__
													text var:nr
													text raw:__
											if true:var:today
												text raw:*
		
		
					row
						cell colspan:2
							fieldset title:message:date
					row
						cell
							text key:date
						cell
							selectbox name:year list:all_years
							text raw:_-_
							selectbox name:month list:all_months
							text raw:_-_
							selectbox name:day list:all_days
							
					row
						cell
							text key:date_time
						cell
							selectbox name:hour list:all_hours
							text raw:_-_
							selectbox name:minute list:all_minutes
							text raw:_-_
							selectbox name:second list:all_seconds


#			if value:var:type equals:date
#				row
#					cell colspan:2 class:fx
#						input size:25 maxlength:25 class:ansidate name:ansidate
#						focus field:ansidate
					
			if value:var:type equals:text
				row
					cell colspan:2 class:fx
						input size:50 maxlength:255 class:text name:text
						focus field:text

			if value:var:type equals:longtext
				row
					cell colspan:2 class:fx
						//focus field:text

						if value:var:editor equals:html
							editor type:html name:text

						if value:var:editor equals:wiki
						
							editor type:wiki name:text
							#inputarea class:longtext name:text rows:25 cols:70
							
							if true:mode:edit
								fieldset title:message:help
								table
									cell
										text value:config:editor/text-markup/strong-begin
										text key:text_markup_strong
										text value:config:editor/text-markup/strong-end
										newline
										text value:config:editor/text-markup/emphatic-begin
										text key:text_markup_emphatic
										text value:config:editor/text-markup/emphatic-end
									cell
										text value:config:editor/text-markup/list-numbered
										text key:text_markup_numbered_list
										newline
										text value:config:editor/text-markup/list-numbered
										text raw:...
										newline
									cell
										text value:config:editor/text-markup/list-unnumbered
										text key:text_markup_unnumbered_list
										newline
										text value:config:editor/text-markup/list-unnumbered
										text raw:...
										newline
									cell
										text value:config:editor/text-markup/table-cell-sep
										text key:text_markup_table
										text value:config:editor/text-markup/table-cell-sep
										text raw:...
										text value:config:editor/text-markup/table-cell-sep
										text raw:...
										text value:config:editor/text-markup/table-cell-sep
										newline
										text value:config:editor/text-markup/table-cell-sep
										text raw:...
										text value:config:editor/text-markup/table-cell-sep
										text raw:...
										text value:config:editor/text-markup/table-cell-sep
										text raw:...
										text value:config:editor/text-markup/table-cell-sep
										newline


						if value:var:editor equals:text
							inputarea class:longtext name:text rows:25 cols:70
							focus field:text
										
	

			if value:var:type equals:link
				row
					cell
						text key:link_target
					cell
						selectbox list:objects name:linkobjectid
						focus field:linkobjectid
				if true:mode:edit
					row
						cell
							text key:link_url
						cell
							input name:linkurl

			if value:var:type equals:list
				row
					cell colspan:2
						selectbox list:objects name:linkobjectid
						focus field:linkobjectid

			if value:var:type equals:number
				row
					cell colspan:2
						hidden name:decimals default:decimals
						input size:15 maxlength:20 name:number
						focus field:number

			if value:var:type equals:select
				row
					cell colspan:2
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
