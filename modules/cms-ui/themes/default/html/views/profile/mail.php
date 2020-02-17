<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="mail" data-action="profile" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form profile">
		<div class="line logo">
		</div>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('user_new_mail'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<input name="mail" disabled="" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$mail)) ?>" class="">
					</input>
				</div>
			</div>
		</div></fieldset>
		<div class="clickable">
			<a target="_self" data-type="dialog" data-action="profile" data-method="confirmmail" data-id="" data-extra="{'dialogAction':'profile','dialogMethod':'confirmmail'}" href="/#/profile/" class="">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('mail_code'))) ?>
				</span>
			</a>
		</div>
	</form>