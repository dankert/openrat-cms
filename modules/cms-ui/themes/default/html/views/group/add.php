<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
		<form name="" target="_self" data-target="view" action="./" data-method="add" data-action="group" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form group">
			<div class="line">
				<div class="label">
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('name'))) ?>
					</label>
				</div>
				<div class="input">
					<input name="name" disabled="" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="focus">
					</input>
				</div>
			</div>
		</form>