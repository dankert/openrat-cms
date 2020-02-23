<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<?php $if2=(config('login','send_password')); if($if2) {  ?>
		<form name="" target="_self" data-target="view" action="./" data-method="password" data-action="login" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form login">
			<div class="line logo">
			</div>
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_USERNAME'))) ?>
					</span>
				</div>
				<div class="input">
					<input name="username" autofocus="autofocus" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$username)) ?>" class="">
					</input>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_DATABASE'))) ?>
					</span>
				</div>
				<div class="input">
					<input name="dbid" value="actdbid" size="1" class="">
					</input>
				</div>
			</div>
		</form>
	 <?php } ?>
	<?php if(!$if2) {  ?>
		<div class="message error">
			<span class=""><?php echo encodeHtml(htmlentities(@lang('PASSWORD_NOT_ENABLED'))) ?>
			</span>
		</div>
	 <?php } ?>