<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="group" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form group">
		<div class="line">
			<div class="label">
				<label class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
					</span>
				</label>
			</div>
			<div class="input">
				<input name="name" type="text" maxlength="100" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="name focus">
				</input>
			</div>
		</div>
	</form>