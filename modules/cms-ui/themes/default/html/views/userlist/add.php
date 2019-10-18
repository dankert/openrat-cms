<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<form name="" target="_self" data-target="view" action="./" data-method="add" data-action="userlist" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" class="or-form userlist" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="userlist" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="add" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_name" class="label"><?php echo lang('user_username') ?>
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_name" name="<?php if ('') echo ''.'_' ?>name<?php if ('') echo '_disabled' ?>" type="text" maxlength="128" class="focus" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
					
				</div>
			</div>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
	