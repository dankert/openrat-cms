page
	form
		window icon:project name:GLOBAL_PROJECT
			row
				cell colspan:2
					fieldset title:message:NAME
						part
							label for:name			
								text text:PROJECT_NAME
							input name:name size:30 class:name
					
					fieldset title:message:PUBLISH
					
						part
							label for:filename			
								text text:PROJECT_TARGET_DIR
							input name:target_dir size:50 class:filename
							
						part
							label for:cmd_after_publish
								text text:PROJECT_CMD_AFTER_PUBLISH
							input name:cmd_after_publish class:filename size:50 readonly:!config:publish/project/override_system_command 

					fieldset title:message:project_FTP
						part
							label for:filename			
								text text:PROJECT_FTP_URL
							input name:ftp_url class:filename size:50 readonly:!config:publish/ftp/enable
							
						part
							checkbox name:ftp_passive readonly:!config:publish/ftp/enable
							label for:ftp_passive
								text text:PROJECT_FTP_PASSIVE
					
					fieldset title:message:options
						part			
							checkbox name:content_negotiation
							label for:content_negotiation
								text text:PROJECT_CONTENT_NEGOTIATION
						part
							checkbox name:cut_index
							label for:cut_index
								text text:PROJECT_CUT_INDEX
								
			row
				cell colspan:2 class:act
					button type:ok