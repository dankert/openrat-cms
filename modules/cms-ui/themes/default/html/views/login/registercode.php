<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="registercode" data-action="login" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form login">
		<div class="line logo">
		</div>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_REGISTER_CODE'))) ?>
				</span>
			</div>
			<div class="input">
				<input name="code" disabled="" type="text" maxlength="256" value="" class="focus">
				</input>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_USERNAME'))) ?>
				</span>
			</div>
			<div class="input">
				<input name="username" disabled="" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$username)) ?>" class="">
				</input>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_PASSWORD'))) ?>
				</span>
			</div>
			<div class="input">
				<div class="inputholder"><input type="password" name="password" size="25" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$password)) ?>" class="">
				</input></div>
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