<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="self" action="./" data-method="src" data-action="page" data-id="<?php echo OR_ID ?>" method="GET" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="1" class="or-form page">
		<input name="languageid" value="<?php echo encodeHtml(htmlentities(@$languageid)) ?>" size="1" class="">
		</input>
		<input name="modelid" value="<?php echo encodeHtml(htmlentities(@$modelid)) ?>" size="1" class="">
		</input>
	</form>
	<fieldset class="or-group toggle-open-close open show"><div class="closable">
		<textarea name="src" data-extension="" data-mimetype="" data-mode="html" class="editor code-editor">
		</textarea>
	</div></fieldset>