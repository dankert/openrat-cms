<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="remove" data-action="page" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form page">
		<label class="or-form-row"><span class="or-form-input"><span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
		</span></span></label>
		<label class="or-form-row or-form-checkbox"><input type="checkbox" name="delete" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$delete)) ?>" class="">
		</input></label>
	</form>