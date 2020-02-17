<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<div class="line logo">
	</div>
	<form name="" target="_self" data-target="view" action="./" data-method="confirmmail" data-action="profile" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form profile">
		<div class="line">
			<div class="label">
				<label class="label"><?php echo encodeHtml(htmlentities(@lang('mail_code'))) ?>
				</label>
			</div>
			<div class="input">
				<input name="code" disabled="" required="required" autofocus="autofocus" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$code)) ?>" class="">
				</input>
			</div>
		</div>
	</form>