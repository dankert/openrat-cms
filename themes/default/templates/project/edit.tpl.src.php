page
	form
		window icon:project name:GLOBAL_PROJECT
			row
				cell colspan:2
					fieldset title:message:NAME			
			row
				cell
					text text:PROJECT_NAME
				cell
					input name:name size:30 class:name
					
			row
				cell colspan:2
					fieldset title:message:PUBLISH			
			row
				cell
					text text:PROJECT_TARGET_DIR
				cell
					input name:target_dir size:50 class:filename
	
			row
				cell
					text text:PROJECT_CMD_AFTER_PUBLISH
				cell
					input name:cmd_after_publish class:filename size:50 readonly:!config:publish/project/override_system_command 

			row
				cell colspan:2
					fieldset title:message:project_FTP			
			row
				cell
					text text:PROJECT_FTP_URL
				cell
					input name:ftp_url class:filename size:50 readonly:!config:publish/ftp/enable
					
			row
				cell
				cell
					checkbox name:ftp_passive readonly:!config:publish/ftp/enable
					label for:ftp_passive
						text text:PROJECT_FTP_PASSIVE
					
			row
				cell colspan:2
					fieldset title:message:options			
			row
//				cell
				cell colspan:2
					checkbox name:content_negotiation
					label for:content_negotiation
						text text:PROJECT_CONTENT_NEGOTIATION
			
			row
//				cell
				cell colspan:2
					checkbox name:cut_index
					label for:cut_index
						text text:PROJECT_CUT_INDEX
			row
				cell colspan:2 class:act
					button type:ok