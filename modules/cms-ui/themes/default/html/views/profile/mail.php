
	
		<form name="" target="_self" data-target="view" action="./" data-method="mail" data-action="profile" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" class="or-form profile" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="profile" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="mail" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line logo">
	<div class="label">
	<img src="themes/default/images/logo_changemail.png ?>"
	border="0" />
	</div>
	<div class="input">
	<h2>
			<?php echo langHtml('logo_changemail') ?>
		</h2>
		<p>
			<?php echo langHtml('logo_changemail_text') ?>
		</p>

	</div>
</div>
			</div>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('user_mail') ?></legend><div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_mail" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('user_new_mail')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_mail" name="mail<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$mail) ?>" /><?php if ('') { ?><input type="hidden" name="mail" value="<?php $mail ?>"/><?php } ?></div>
						
					</div>
				</div>
			</div></fieldset>
			<div class="clickable">
				<a target="_self" data-type="dialog" data-action="profile" data-method="confirmmail" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'profile','dialogMethod':'confirmmail'}" href="<?php echo Html::url('profile','confirmmail','',array('dialogAction'=>'profile','dialogMethod'=>'confirmmail')) ?>">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'mail_code'.'')))); ?></span>
					
				</a>

			</div>
		<div class="or-form-actionbar"><input type="submit" class="or-form-btn or-form-btn--primary" value="OK" /></div></form>
	