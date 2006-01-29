page
	form
		window name:element
			row
				cell colspan:2 class:help
					text var:desc

			row
				cell class:fx
					text text:date
				cell class:fx
					selectbox name:year list:all_years
					text raw:_-_
					selectbox name:month list:all_months
					text raw:_-_
					selectbox name:day list:all_days
					
			row
				cell class:fx
					text text:date_time
				cell class:fx
					selectbox name:hour list:all_hours
					text raw:_:_
					selectbox name:minute list:all_minutes
					text raw:_:_
					selectbox name:second list:all_seconds
			
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

	focus field:text

