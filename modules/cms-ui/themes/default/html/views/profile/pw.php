
	
		<form name="" target="_self" data-target="view" action="./" data-method="pw" data-action="profile" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form profile" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="profile" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="pw" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<?php $if3=($pwchange_enabled); if($if3){?>
				<div class="line logo">
	<div class="label">
	<img src="themes/default/images/logo_changepassword.png ?>"
	border="0" />
	</div>
	<div class="input">
	<h2>
			<?php echo langHtml('logo_changepassword') ?>
		</h2>
		<p>
			<?php echo langHtml('logo_changepassword_text') ?>
		</p>

	</div>
</div>
				</div>
				<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('user_act_password') ?></legend><div class="closable">
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_act_password" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('user_password')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<div class="inputholder"><input type="password" name="act_password" id="<?php echo REQUEST_ID ?>_act_password" size="40" maxlength="256" class="focus" value="<?php echo @$act_password?>" /></div>
							
						</div>
					</div>
				</div></fieldset>
				<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('user_new_password') ?></legend><div class="closable">
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_password1" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('user_new_password')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<div class="inputholder"><input type="password" name="password1" id="<?php echo REQUEST_ID ?>_password1" size="40" maxlength="256" class="" value="<?php echo @$password1?>" /></div>
							
						</div>
					</div>
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_password2" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('user_new_password_repeat')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<div class="inputholder"><input type="password" name="password2" id="<?php echo REQUEST_ID ?>_password2" size="40" maxlength="256" class="" value="<?php echo @$password2?>" /></div>
							
						</div>
					</div>
				</div></fieldset>
			<?php } ?>
			<?php if(!$if3){?>
				<div class="message warn">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'pwchange_not_allowed'.'')))); ?></span>
					
				</div>
			<?php } ?>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="?BUTTON_OK?" /></div></form>
	