<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="info" data-action="language" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form language" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="language" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="info" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
		<span class="headline"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
		<div class="line">
			<div class="label">
				<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NAME')))); ?></span>
			</div>
			<div class="input clickable">
				<span class="name"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<span><?php echo nl2br(encodeHtml(htmlentities(lang('LANGUAGE_ISOCODE')))); ?></span>
			</div>
			<div class="input clickable">
				<span><?php echo nl2br(encodeHtml(htmlentities($isocode))); ?></span>
			</div>
		</div>
		<div class="line">
			<div class="label">
			</div>
			<div class="input clickable">
				<a class="or-link-btn" target="_self" data-type="edit" data-action="language" data-method="prop" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#/language/">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit'.'')))); ?></span>
				</a>
			</div>
		</div>
	<div class="or-form-actionbar"></div></form>