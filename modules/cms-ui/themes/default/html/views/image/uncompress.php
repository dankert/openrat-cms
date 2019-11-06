<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="uncompress" data-action="image" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form image" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="image" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="uncompress" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
		<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div class="closable">
		</div></fieldset>
		<div class="line">
			<div class="label">
			</div>
			<div class="input">
				<?php $replace= '1'; ?>
				<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_replace_1" name="<?php if ('') echo ''.'_' ?>replace<?php if (false) echo '_disabled' ?>" value="1"<?php if('1'==@$replace)echo ' checked="checked"' ?> />
				<label for="<?php echo REQUEST_ID ?>_replace_1" class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'replace'.'')))); ?></span>
				</label>
				<br/>
				<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_replace_0" name="<?php if ('') echo ''.'_' ?>replace<?php if (false) echo '_disabled' ?>" value="0"<?php if('0'==@$replace)echo ' checked="checked"' ?> />
				<label for="<?php echo REQUEST_ID ?>_replace_0" class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'new'.'')))); ?></span>
				</label>
			</div>
		</div>
	<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>