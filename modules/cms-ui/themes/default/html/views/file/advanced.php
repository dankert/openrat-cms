<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="advanced" data-action="file" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form file">
		<label class="or-form-row or-form-input"><input name="extension" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$extension)) ?>" class="extension">
		</input></label>
		<label class="or-form-row or-form-input"><input name="type" value="<?php echo encodeHtml(htmlentities(@$type)) ?>" size="1" class="">
		</input></label>
	</form>