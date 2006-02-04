page
	form
		window
			row
				cell class:fx
					if present:pages
						if present:subdirs
							checkbox name:pages
							text raw:_
							text text:global_pages
							newline
					if present:files
						if true:subdirs
							checkbox name:files
							text raw:_
							text text:global_files
							newline
			row
				cell class:fx
					if present:subdirs
						checkbox name:subdirs
						text raw:_
						text text:GLOBAL_PUBLISH_WITH_SUBDIRS
						newline
					if present:clean
						checkbox name:clean
						text raw:_
						text text:global_CLEAN_AFTER_PUBLISH
						newline
			row
				cell class:help
					text text:GLOBAL_MUCH_TIME
			row
				cell class:act
					button type:ok