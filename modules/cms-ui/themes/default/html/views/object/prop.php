<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="object" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form object">
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<label class="or-form-row or-form-input"><input name="filename" disabled="" autofocus="autofocus" type="text" maxlength="150" value="<?php echo encodeHtml(htmlentities(@$filename)) ?>" class="filename">
			</input></label>
			<label class="or-form-row or-form-input"><input name="alias_filename" disabled="" type="text" maxlength="150" value="<?php echo encodeHtml(htmlentities(@$alias_filename)) ?>" class="filename">
			</input></label>
			<label class="or-form-row or-form-input"><input name="alias_folderid" value="<?php echo encodeHtml(htmlentities(@$alias_folderid)) ?>" size="1" class="">
			</input></label>
		</div></fieldset>
	</form>