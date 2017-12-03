
	
		<form name="" target="_self" action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="<?php echo OR_METHOD ?>" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave="" onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
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
				<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('user_act_password') ?></legend><div>
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_act_password" class="label">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('user_password')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<div class="inputholder"><input type="password" name="act_password" id="<?php echo REQUEST_ID ?>_act_password" size="40" maxlength="256" class="focus" value="<?php echo @$act_password?>"" /></div>
							
						</div>
					</div>
				</div></fieldset>
				<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('user_new_password') ?></legend><div>
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_password1" class="label">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('user_new_password')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<div class="inputholder"><input type="password" name="password1" id="<?php echo REQUEST_ID ?>_password1" size="40" maxlength="256" class="" value="<?php echo @$password1?>"" /></div>
							
						</div>
					</div>
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_password2" class="label">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('user_new_password_repeat')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<div class="inputholder"><input type="password" name="password2" id="<?php echo REQUEST_ID ?>_password2" size="40" maxlength="256" class="" value="<?php echo @$password2?>"" /></div>
							
						</div>
					</div>
				</div></fieldset>
			<?php } ?>
			<?php if(!$if3){?>
				<div class="message warn">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'pwchange_not_allowed'.'')))); ?></span>
					
				</div>
			<?php } ?>
		
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>

	