
	
		<form name="" target="_self" data-target="view" action="./" data-method="mail" data-action="profile" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" class="profile" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="profile" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="mail" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
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
			<fieldset class="<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('user_mail') ?></legend><div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_mail" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('user_new_mail')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_mail" name="mail<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$mail) ?>" /><?php if ('') { ?><input type="hidden" name="mail" value="<?php $mail ?>"/><?php } ?></div>
						
					</div>
				</div>
			</div></fieldset>
		<div class="bottom"><div class="command "><input type="submit" class="submit ok" value="OK" /></div></div></form>
	