<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="model" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form model">
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
				</span>
			</div>
			<div class="input">
				<input name="name" disabled="" autofocus="autofocus" type="text" maxlength="50" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="">
				</input>
			</div>
		</div>
		<div class="line">
			<div class="label">
			</div>
			<div class="input">
				<input type="checkbox" name="is_default" disabled="<?php echo encodeHtml(htmlentities(@$is_default)) ?>" value="1" checked="<?php echo encodeHtml(htmlentities(@$is_default)) ?>" class="">
				</input>
				<label class="label"><?php echo encodeHtml(htmlentities(@lang('GLOBAL_is_default'))) ?>
				</label>
			</div>
		</div>
	</form>