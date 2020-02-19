<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
		<form name="" target="_self" data-target="view" action="./" data-method="add" data-action="user" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form user">
			<div class="line">
				<div class="label">
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_username'))) ?>
					</label>
				</div>
				<div class="input">
					<input name="name" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="focus">
					</input>
				</div>
			</div>
		</form>