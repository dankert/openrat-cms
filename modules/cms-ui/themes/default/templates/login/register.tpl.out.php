
	
		<?php $if2=(@$conf['login']['register']); if($if2){?>
			<form name="" target="_self" action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave="" onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
				<div class="line logo">
	<div class="label">
	<img src="themes/default/images/logo_register.png ?>"
	border="0" />
	</div>
	<div class="input">
	<h2>
			<?php echo langHtml('logo_register') ?>
		</h2>
		<p>
			<?php echo langHtml('logo_register_text') ?>
		</p>

	</div>
</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_mail" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('USER_MAIL')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_mail" name="mail<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="focus" value="<?php echo Text::encodeHtml('') ?>" /><?php if ('') { ?><input type="hidden" name="mail" value="<?php '' ?>"/><?php } ?></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
					</div>
				</div>
			
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>

		<?php } ?>
		<?php if(!$if2){?>
			<div class="message error">
				<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'REGISTER_NOT_ENABLED'.'')))); ?></span>
				
			</div>
		<?php } ?>
	