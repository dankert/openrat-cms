<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="name" data-action="object" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form object">
		<input type="hidden" name="languageid" value="<?php echo encodeHtml(htmlentities(@$languageid)) ?>" class="">
		</input>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<label class="or-form-row or-form-input"><input name="name" disabled="" required="required" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="">
			</input></label>
			<label class="or-form-row or-form-checkbox"><textarea name="description" disabled="" maxlength="255" class="description"><?php echo encodeHtml(htmlentities(@$description)) ?>
			</textarea></label>
		</div></fieldset>
	</form>