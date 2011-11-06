dummy
	window
		form
			if present:pages
				if present:subdirs
					checkbox name:pages
					label for:pages
						text raw:_
						text text:global_pages
					newline
			if present:files
				if true:subdirs
					checkbox name:files
					label for:files
						text raw:_
						text text:global_files
					newline
					
			fieldset title:message:options
				if present:subdirs
					part
						checkbox name:subdirs
						label for:subdirs
							text raw:_
							text text:GLOBAL_PUBLISH_WITH_SUBDIRS
				if present:clean
					part
						checkbox name:clean
						label for:clean
							text raw:_
							text text:global_CLEAN_AFTER_PUBLISH
						newline
						
			text text:GLOBAL_MUCH_TIME class:help
			newline
			
			button type:ok