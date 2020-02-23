<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="src" data-action="template" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form template">
		<input type="hidden" name="modelid" value="<?php echo encodeHtml(htmlentities(@$modelid)) ?>" class="">
		</input>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<textarea name="source" data-extension="" data-mimetype="" data-mode="htmlmixed" class="editor code-editor">
			</textarea>
		</div></fieldset>
	</form>