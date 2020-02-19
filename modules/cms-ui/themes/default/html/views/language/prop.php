<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="language" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form language">
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
				</span>
			</div>
			<div class="input">
				<input name="name" type="text" maxlength="50" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="focus">
				</input>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('LANGUAGE_ISOCODE'))) ?>
				</span>
			</div>
			<div class="input">
				<input name="isocode" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$isocode)) ?>" class="">
				</input>
			</div>
		</div>
		<div class="line">
			<div class="label">
			</div>
			<div class="input">
				<input type="checkbox" name="is_default" disabled="disabled" value="1" <?php if(''.@$is_default.''){ ?>checked="1"<?php } ?> class="">
				</input>
				<label class="label"><?php echo encodeHtml(htmlentities(@lang('GLOBAL_is_default'))) ?>
				</label>
			</div>
		</div>
	</form>