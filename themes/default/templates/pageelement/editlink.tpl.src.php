page
	form
		window name:element
			row
				cell colspan:2 class:help
					text var:desc

			row
				cell colspan:2
					selectbox list:objects name:linkobjectid

			if present:release
				row
					cell colspan:2
						checkbox name:release
						text raw:_
						text text:GLOBAL_RELEASE

			if present:publish
				row
					cell colspan:2
						checkbox name:publish
						text raw:_
						text text:PAGE_PUBLISH_AFTER_SAVE

			row
				cell colspan:2 class:act
					button type:ok

	focus field:linkobjectid