
	
		<form name="" target="_self" action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave="" onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_proposal" name="type" value="proposal"<?php if('proposal'==@$type)echo ' checked="checked"' ?> />
					
					<label for="<?php echo REQUEST_ID ?>_type_proposal" class="label"><?php echo $password_proposal ?>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'USER_new_password'.'')))); ?></span>
						
						<span class="text"><?php echo nl2br('text:: '); ?></span>
						
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($password_proposal))); ?></span>
						
					</label>
					<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_password_proposal" name="password_proposal<?php if ('') echo '_disabled' ?>" type="hidden" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$password_proposal) ?>" /><?php if ('') { ?><input type="hidden" name="password_proposal" value="<?php $password_proposal ?>"/><?php } ?></div>
					
				</div>
			</div>
			<?php $if3=(@$conf['mail']['enabled']); if($if3){?>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_random" name="type" value="random"<?php if('random'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_random" class="label"><?php echo lang('user_random_password') ?>
						</label>
					</div>
				</div>
			<?php } ?>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_input" name="type" value="input"<?php if('input'==@$type||'1')echo ' checked="checked"' ?> />
					
					<label for="<?php echo REQUEST_ID ?>_type_input" class="label"><?php echo lang('USER_NEW_PASSWORD_INPUT') ?>
					</label>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_password1" class="label"><?php echo lang('USER_new_password') ?>
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><input type="password" name="password1" id="<?php echo REQUEST_ID ?>_password1" size="40" maxlength="256" class="" value="<?php echo @$password1?>" /></div>
					
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_password2" class="label"><?php echo lang('USER_new_password_repeat') ?>
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><input type="password" name="password2" id="<?php echo REQUEST_ID ?>_password2" size="40" maxlength="256" class="" value="<?php echo @$password2?>" /></div>
					
				</div>
			</div>
			<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('options') ?></legend><div>
			</div></fieldset>
			<?php $if3=(@$conf['mail']['enabled']); if($if3){?>
				<?php $if4=(!empty($mail)); if($if4){?>
					<div class="line">
						<div class="label">
						</div>
						<div class="input">
							<?php { $tmpname     = 'email';$default  = '';$readonly = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
							
							<label for="<?php echo REQUEST_ID ?>_email" class="label"><?php echo lang('user_mail_new_password') ?>
							</label>
						</div>
					</div>
					<div class="line">
						<div class="label">
						</div>
						<div class="input">
							<?php { $tmpname     = 'timeout';$default  = '';$readonly = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
							
							<label for="<?php echo REQUEST_ID ?>_timeout" class="label"><?php echo lang('user_password_timeout') ?>
							</label>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
			
			
		<div class="bottom"><div class="command "><input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " /></div></div></form>
	