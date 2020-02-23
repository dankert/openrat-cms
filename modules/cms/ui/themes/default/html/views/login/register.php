<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<?php $if2=(config('login','register')); if($if2) {  ?>
		<form name="" target="_self" data-target="view" action="./" data-method="register" data-action="login" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form login">
			<div class="line logo">
			</div>
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_MAIL'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<input name="mail" type="text" maxlength="256" value="" class="focus">
					</input>
				</div>
			</div>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
				</div>
			</div>
		</form>
	 <?php } ?>
	<?php if(!$if2) {  ?>
		<div class="message error">
			<span class=""><?php echo encodeHtml(htmlentities(@lang('REGISTER_NOT_ENABLED'))) ?>
			</span>
		</div>
	 <?php } ?>