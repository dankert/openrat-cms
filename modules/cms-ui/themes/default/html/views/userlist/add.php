<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="add" data-action="userlist" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form userlist">
		<div class="line">
			<div class="label">
				<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_username'))) ?>
				</label>
			</div>
			<div class="input">
				<input name="name" disabled="" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="focus">
				</input>
			</div>
		</div>
	</form>