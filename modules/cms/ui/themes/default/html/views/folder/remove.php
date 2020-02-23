<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="remove" data-action="folder" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form folder">
		<label class="or-form-row"><span class="or-form-input"><span class=""><?php echo encodeHtml(htmlentities(@$name)) ?>
		</span></span></label>
		<label class="or-form-row or-form-checkbox"><input type="checkbox" name="delete" value="1" <?php if(''.@$delete.''){ ?>checked="1"<?php } ?> class="">
		</input></label>
		<label class="or-form-row or-form-checkbox"><input type="checkbox" name="withChildren" disabled="disabled" value="1" <?php if(''.@$withChildren.''){ ?>checked="1"<?php } ?> class="">
		</input></label>
	</form>