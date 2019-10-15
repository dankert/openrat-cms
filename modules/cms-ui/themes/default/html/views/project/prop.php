<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="project" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form project" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="project" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="prop" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('NAME') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_name" class="label"><?php echo lang('PROJECT_NAME') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_name" name="<?php if ('') echo ''.'_' ?>name<?php if ('') echo '_disabled' ?>" type="text" maxlength="128" class="name" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_url" class="label"><?php echo lang('PROJECT_HOSTNAME') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_url" name="<?php if ('') echo ''.'_' ?>url<?php if ('') echo '_disabled' ?>" type="text" maxlength="255" class="" value="<?php echo Text::encodeHtml(@$url) ?>" /><?php if ('') { ?><input type="hidden" name="url" value="<?php $url ?>"/><?php } ?></div>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('PUBLISH') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_target_dir" class="label"><?php echo lang('PROJECT_TARGET_DIR') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_target_dir" name="<?php if ('') echo ''.'_' ?>target_dir<?php if ('') echo '_disabled' ?>" type="text" maxlength="255" class="filename" value="<?php echo Text::encodeHtml(@$target_dir) ?>" /><?php if ('') { ?><input type="hidden" name="target_dir" value="<?php $target_dir ?>"/><?php } ?></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_cmd_after_publish" class="label"><?php echo lang('PROJECT_CMD_AFTER_PUBLISH') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input<?php if (!config('publish','project','override_system_command')) echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_cmd_after_publish" name="<?php if ('') echo ''.'_' ?>cmd_after_publish<?php if (!config('publish','project','override_system_command')) echo '_disabled' ?>" type="text" maxlength="255" class="filename" value="<?php echo Text::encodeHtml(@$cmd_after_publish) ?>" /><?php if (!config('publish','project','override_system_command')) { ?><input type="hidden" name="cmd_after_publish" value="<?php $cmd_after_publish ?>"/><?php } ?></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php { $tmpname     = 'publishFileExtension';$default  = '';$readonly = '';$required = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

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
						<?php { $tmpname     = 'publishPageExtension';$default  = '';$readonly = '';$required = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						
						<label for="<?php echo REQUEST_ID ?>_publishPageExtension" class="label"><?php echo lang('PROJECT_publish_page_Extension') ?>
						</label>
					</div>
				</div>
				<label class="or-form-row"><span class="or-form-label"></span><span class="or-form-input"><input  class="" type="radio" id="<?php echo REQUEST_ID ?>_linksAbsolute_0" name="<?php if ('') echo ''.'_' ?>linksAbsolute<?php if ('') echo '_disabled' ?>" value="0"<?php if('0'==@$linksAbsolute)echo ' checked="checked"' ?> />&nbsp;?LINKS_RELATIVE? </span></label>
				
				<label class="or-form-row"><span class="or-form-label"></span><span class="or-form-input"><input  class="" type="radio" id="<?php echo REQUEST_ID ?>_linksAbsolute_1" name="<?php if ('') echo ''.'_' ?>linksAbsolute<?php if ('') echo '_disabled' ?>" value="1"<?php if('1'==@$linksAbsolute)echo ' checked="checked"' ?> />&nbsp;?LINKS_ABSOLUTE? </span></label>
				
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('project_FTP') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_ftp_url" class="label"><?php echo lang('PROJECT_FTP_URL') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input<?php if (!config('publish','ftp','enable')) echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_ftp_url" name="<?php if ('') echo ''.'_' ?>ftp_url<?php if (!config('publish','ftp','enable')) echo '_disabled' ?>" type="text" maxlength="256" class="filename" value="<?php echo Text::encodeHtml(@$ftp_url) ?>" /><?php if (!config('publish','ftp','enable')) { ?><input type="hidden" name="ftp_url" value="<?php $ftp_url ?>"/><?php } ?></div>
						
						<br/>
						
						<?php { $tmpname     = 'ftp_passive';$default  = '';$readonly = !config('publish','ftp','enable');$required = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

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
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php { $tmpname     = 'content_negotiation';$default  = '';$readonly = '';$required = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

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
						<?php { $tmpname     = 'cut_index';$default  = '';$readonly = '';$required = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

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
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="?BUTTON_OK?" /></div></form>
	