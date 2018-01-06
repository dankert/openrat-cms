
	
		<div class="headermenu"><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_REMOVE') ?>" data-type="dialog" data-name="<?php echo lang('MENU_REMOVE') ?>" data-method="remove"><img src="./themes/default/images/icon/action/remove.svg" title="<?php echo lang('MENU_remove_DESC') ?>" /><?php echo lang('MENU_remove') ?></a></div><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_EXPORT') ?>" data-type="dialog" data-name="<?php echo lang('MENU_EXPORT') ?>" data-method="export"><img src="./themes/default/images/icon/action/export.svg" title="<?php echo lang('MENU_export_DESC') ?>" /><?php echo lang('MENU_export') ?></a></div><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_MAINTENANCE') ?>" data-type="dialog" data-name="<?php echo lang('MENU_MAINTENANCE') ?>" data-method="maintenance"><img src="./themes/default/images/icon/action/maintenance.svg" title="<?php echo lang('MENU_maintenance_DESC') ?>" /><?php echo lang('MENU_maintenance') ?></a></div></div>
		
		<form name="" target="_self" action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('NAME') ?></legend><div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_name" class="label"><?php echo lang('PROJECT_NAME') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_name" name="name<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="name" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('PUBLISH') ?></legend><div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_target_dir" class="label"><?php echo lang('PROJECT_TARGET_DIR') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_target_dir" name="target_dir<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="filename" value="<?php echo Text::encodeHtml(@$target_dir) ?>" /><?php if ('') { ?><input type="hidden" name="target_dir" value="<?php $target_dir ?>"/><?php } ?></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_cmd_after_publish" class="label"><?php echo lang('PROJECT_CMD_AFTER_PUBLISH') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input<?php if (!@$conf['publish']['project']['override_system_command']) echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_cmd_after_publish" name="cmd_after_publish<?php if (!@$conf['publish']['project']['override_system_command']) echo '_disabled' ?>" type="text" maxlength="256" class="filename" value="<?php echo Text::encodeHtml(@$cmd_after_publish) ?>" /><?php if (!@$conf['publish']['project']['override_system_command']) { ?><input type="hidden" name="cmd_after_publish" value="<?php $cmd_after_publish ?>"/><?php } ?></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php { $tmpname     = 'publishFileExtension';$default  = '';$readonly = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						
						<label for="<?php echo REQUEST_ID ?>_publishFileExtension" class="label"><?php echo lang('PROJECT_publish_File_Extension') ?>
						</label>
					</div>
				</div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php { $tmpname     = 'publishPageExtension';$default  = '';$readonly = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						
						<label for="<?php echo REQUEST_ID ?>_publishPageExtension" class="label"><?php echo lang('PROJECT_publish_page_Extension') ?>
						</label>
					</div>
				</div>
			</div></fieldset>
			<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('project_FTP') ?></legend><div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_ftp_url" class="label"><?php echo lang('PROJECT_FTP_URL') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input<?php if (!@$conf['publish']['ftp']['enable']) echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_ftp_url" name="ftp_url<?php if (!@$conf['publish']['ftp']['enable']) echo '_disabled' ?>" type="text" maxlength="256" class="filename" value="<?php echo Text::encodeHtml(@$ftp_url) ?>" /><?php if (!@$conf['publish']['ftp']['enable']) { ?><input type="hidden" name="ftp_url" value="<?php $ftp_url ?>"/><?php } ?></div>
						
						<br/>
						
						<?php { $tmpname     = 'ftp_passive';$default  = '';$readonly = !@$conf['publish']['ftp']['enable'];		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						
						<label for="<?php echo REQUEST_ID ?>_ftp_passive" class="label"><?php echo lang('PROJECT_FTP_PASSIVE') ?>
						</label>
					</div>
				</div>
			</div></fieldset>
			<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('options') ?></legend><div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php { $tmpname     = 'content_negotiation';$default  = '';$readonly = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						
						<label for="<?php echo REQUEST_ID ?>_content_negotiation" class="label"><?php echo lang('PROJECT_CONTENT_NEGOTIATION') ?>
						</label>
					</div>
				</div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php { $tmpname     = 'cut_index';$default  = '';$readonly = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						
						<label for="<?php echo REQUEST_ID ?>_cut_index" class="label"><?php echo lang('PROJECT_CUT_INDEX') ?>
						</label>
					</div>
				</div>
			</div></fieldset>
		<div class="bottom"><div class="command "><input type="button" class="submit ok" value="OK" /></div></div></form>
	