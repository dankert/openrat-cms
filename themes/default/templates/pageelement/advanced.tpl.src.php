dummy
	form

		window name:element
			row
				cell colspan:2 class:help
					text var:desc



			if value:var:type equals:date
				table width:85%
					row
						cell colspan:7 class:help
							link url:var:lastmonthurl
								image file:left align:middle
							text raw:_
							text var:monthname
							text raw:_
							link url:var:nextmonthurl
								image file:right align:middle
							text raw:_____
							link url:var:lastyearurl
								image file:left align:middle
							text raw:_
							text var:yearname
							text raw:_
							link url:var:nextyearurl
								image file:right align:middle
					row
						cell
							text key:global_nr
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
							text key:date
						cell colspan:5
							selectbox name:year list:all_years
							text raw:_-_
							selectbox name:month list:all_months
							text raw:_-_
							selectbox name:day list:all_days
							
					row
						cell colspan:2
							text key:date_time
						cell colspan:5
							selectbox name:hour list:all_hours
							text raw:_-_
							selectbox name:minute list:all_minutes
							text raw:_-_
							selectbox name:second list:all_seconds





					
			if value:var:type equals:text
				row
					cell colspan:2
						input size:50 maxlength:255 class:text name:text
						focus field:text

			if value:var:type equals:longtext

				row
					cell colspan:2
						if value:var:editor equals:html
							editor type:html name:text
					
						if value:var:editor equals:wiki
							if present:preview_text
								text var:preview_text
								newline
						
							editor type:wiki name:text

						if value:var:editor equals:text
							inputarea class:longtext name:text rows:25 cols:70
							focus field:text

			if value:var:type equals:link
				row
					cell colspan:2
						selectbox list:objects name:linkobjectid
						focus field:linkobjectid

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


			if present:release
				if present:publish
					row
						cell colspan:2
							fieldset title:message:options
							
			if present:release
				row
					cell colspan:2
						checkbox name:release
						label for:release
							text text:GLOBAL_RELEASE

			if present:publish
				row
					cell colspan:2
						checkbox name:publish
						label for:publish
							text text:PAGE_PUBLISH_AFTER_SAVE

			row
				cell colspan:2 class:act
					button type:ok

	focus field:text