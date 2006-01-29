page
	window icon:project name:GLOBAL_PROJECT
		row
			cell
				text text:PROJECT_NAME
			cell class:fx
				input name:name size:50
				
		row
			cell
				text text:PROJECT_TARGET_DIR
			cell class:fx
				input class:filename name:target_dir size:50
		
		row
			cell
				text text:PROJECT_FTP_URL
			cell class:fx
				input name:ftp_url
				
		row
			cell
				text text:PROJECT_FTP_PASSIVE
			cell class:fx
				checkbox name:ftp_passive

		row
			cell
				text text:PROJECT_CMD_AFTER_PUBLISH
			cell class:fx
				input name:cmd_after_publish
				
		row
			cell
				text text:PROJECT_CONTENT_NEGOTIATION
			cell class:fx
				checkbox name:content_negotiation
		
		row
			cell
				text text:PROJECT_CUT_INDEX
			cell class:fx
				checkbox name:cut_index
		row
			cell colspan:2
				button type:ok