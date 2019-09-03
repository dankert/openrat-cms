<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		
			<form name="" target="_self" data-target="_top" action="./" data-method="passwordcode" data-action="login" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form login" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="login" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="passwordcode" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
				
					<tr>
						<td colspan="2" class="logo">
							<div class="line logo">
	<div class="label">
	<img src="themes/default/images/logo_password.png ?>"
	border="0" />
	</div>
	<div class="input">
	<h2>
			<?php echo langHtml('logo_password') ?>
		</h2>
		<p>
			<?php echo langHtml('logo_password_text') ?>
		</p>

	</div>
</div>
							</div>
						</td>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('mail_code')))); ?></span>
								
							</td>
							<td>
								<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_code" name="<?php if ('') echo ''.'_' ?>code<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$code) ?>" /><?php if ('') { ?><input type="hidden" name="code" value="<?php $code ?>"/><?php } ?></div>
								
							</td>
						</tr>
						<tr>
							<td colspan="2" class="act">
										<div class="invisible"><input type="submit" 	name="ok" class="%class%"
	title="?button_ok_DESC?"
	value="&nbsp;&nbsp;&nbsp;&nbsp;?button_ok?&nbsp;&nbsp;&nbsp;&nbsp;" />	
								</div>
							</td>
						</tr>
					</tr>
				
			<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="?BUTTON_OK?" /></div></form>
			
			
		
	