<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="add" data-action="grouplist" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form grouplist" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="grouplist" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="add" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
		<div class="line">
			<div class="label">
				<label for="<?php echo REQUEST_ID ?>_name" class="label"><?php echo lang('name') ?>
				</label>
			</div>
			<div class="input">
				<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_name" name="<?php if ('') echo ''.'_' ?>name<?php if (false) echo '_disabled' ?>" type="text" maxlength="256" class="focus" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if (false) { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
			</div>
		</div>
	<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary or-form-btn--save" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>