<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="add" data-action="languagelist" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form languagelist">
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('LANGUAGE_ISOCODE'))) ?>
				</span>
			</div>
			<div class="input">
				<input name="isocode" value="<?php echo encodeHtml(htmlentities(@$isocode)) ?>" size="1" class="">
				</input>
			</div>
		</div>
	</form>