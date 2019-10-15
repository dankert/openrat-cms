<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="maintenance" data-action="project" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form project" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="project" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="maintenance" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div class="closable">
				<div>
					<span><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
					
					<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_type_check_limit" name="<?php if ('') echo ''.'_' ?>type<?php if ('') echo '_disabled' ?>" value="check_limit"<?php if('check_limit'==@$type)echo ' checked="checked"' ?> />
					
					<label for="<?php echo REQUEST_ID ?>_type_check_limit" class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'project_check_limit'.'')))); ?></span>
						
					</label>
				</div>
				<div>
					<span><?php echo nl2br(encodeHtml(htmlentities(''))); ?></span>
					
					<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_type_check_files" name="<?php if ('') echo ''.'_' ?>type<?php if ('') echo '_disabled' ?>" value="check_files"<?php if('check_files'==@$type)echo ' checked="checked"' ?> />
					
					<label for="<?php echo REQUEST_ID ?>_type_check_files" class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'project_check_files'.'')))); ?></span>
						
					</label>
				</div>
			</div></fieldset>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="?BUTTON_OK?" /></div></form>
	