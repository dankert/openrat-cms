<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="settings" data-action="object" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form object" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="object" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="settings" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
		<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('validity') ?></legend><div class="closable">
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_validity_from_date" class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'from'.'')))); ?></span>
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_valid_from_date" name="<?php if ('') echo ''.'_' ?>valid_from_date<?php if (false) echo '_disabled' ?>" type="date" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$valid_from_date) ?>" /><?php if (false) { ?><input type="hidden" name="valid_from_date" value="<?php $valid_from_date ?>"/><?php } ?></div>
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_valid_from_time" name="<?php if ('') echo ''.'_' ?>valid_from_time<?php if (false) echo '_disabled' ?>" type="time" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$valid_from_time) ?>" /><?php if (false) { ?><input type="hidden" name="valid_from_time" value="<?php $valid_from_time ?>"/><?php } ?></div>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_validity_until_date" class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'until'.'')))); ?></span>
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_valid_until_date" name="<?php if ('') echo ''.'_' ?>valid_until_date<?php if (false) echo '_disabled' ?>" type="date" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$valid_until_date) ?>" /><?php if (false) { ?><input type="hidden" name="valid_until_date" value="<?php $valid_until_date ?>"/><?php } ?></div>
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_valid_until_time" name="<?php if ('') echo ''.'_' ?>valid_until_time<?php if (false) echo '_disabled' ?>" type="time" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$valid_until_time) ?>" /><?php if (false) { ?><input type="hidden" name="valid_until_time" value="<?php $valid_until_time ?>"/><?php } ?></div>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('settings') ?></legend><div class="closable">
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_settings" class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'SETTINGS'.'')))); ?></span>
					</label>
				</div>
				<div class="input">
					<textarea  name="<?php if ('') echo ''.'_' ?>settings<?php if (false) echo '_disabled' ?>" data-extension="" data-mimetype="" data-mode="yaml" class="editor code-editor"><?php echo htmlentities(${'settings'}) ?></textarea>
				</div>
			</div>
		</div></fieldset>
	<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>