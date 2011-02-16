dummy
	form
		window name:element
			row
				cell colspan:2 class:help
					text var:desc

			row
				cell colspan:2
					hidden name:decimals default:decimals
					input size:15 maxlength:20 name:number

			row
				cell
					text text:global_decimals
				cell
					text var:decimals

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

	focus field:text