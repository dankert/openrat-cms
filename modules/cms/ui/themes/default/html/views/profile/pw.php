<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="pw" data-action="profile" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form profile">
		<?php $if3=($pwchange_enabled); if($if3) {  ?>
			<div class="line logo">
			</div>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
				<div class="line">
					<div class="label">
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('user_password'))) ?>
							</span>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input type="password" name="act_password" size="40" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$act_password)) ?>" class="focus">
						</input></div>
					</div>
				</div>
			</div></fieldset>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
				<div class="line">
					<div class="label">
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('user_new_password'))) ?>
							</span>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input type="password" name="password1" size="40" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$password1)) ?>" class="">
						</input></div>
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('user_new_password_repeat'))) ?>
							</span>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input type="password" name="password2" size="40" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$password2)) ?>" class="">
						</input></div>
					</div>
				</div>
			</div></fieldset>
		 <?php } ?>
		<?php if(!$if3) {  ?>
			<div class="message warn">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('pwchange_not_allowed'))) ?>
				</span>
			</div>
		 <?php } ?>
	</form>