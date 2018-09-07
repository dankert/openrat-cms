
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="edit" data-action="profile" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="profile" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="profile" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="edit" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('name') ?></legend><div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_name" class="label"><?php echo lang('user_username') ?>
						</label>
					</div>
					<div class="input">
						<span class="name"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('MENU_PROFILE_MAIL') ?></legend><div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_mail" class="label"><?php echo lang('user_mail') ?>
						</label>
					</div>
					<div class="input">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities($mail))); ?></span>
						
						<br/>
						
						<br/>
						
						<div class="clickable">
							<a class="action" target="_self" date-name="<?php echo lang('mail') ?>" name="<?php echo lang('mail') ?>" data-type="dialog" data-action="profile" data-method="mail" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'profile','dialogMethod':'mail'}" href="<?php echo Html::url('profile','mail','',array('dialogAction'=>'profile','dialogMethod'=>'mail')) ?>">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit'.'')))); ?></span>
								
							</a>

						</div>
					</div>
				</div>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('GLOBAL_PROP') ?></legend><div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_fullname" class="label"><?php echo lang('user_fullname') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_fullname" name="fullname<?php if ('') echo '_disabled' ?>" type="text" maxlength="128" class="text" value="<?php echo Text::encodeHtml(@$fullname) ?>" /><?php if ('') { ?><input type="hidden" name="fullname" value="<?php $fullname ?>"/><?php } ?></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_tel" class="label"><?php echo lang('user_tel') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_tel" name="tel<?php if ('') echo '_disabled' ?>" type="text" maxlength="128" class="text" value="<?php echo Text::encodeHtml(@$tel) ?>" /><?php if ('') { ?><input type="hidden" name="tel" value="<?php $tel ?>"/><?php } ?></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_desc" class="label"><?php echo lang('user_desc') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_desc" name="desc<?php if ('') echo '_disabled' ?>" type="text" maxlength="128" class="text" value="<?php echo Text::encodeHtml(@$desc) ?>" /><?php if ('') { ?><input type="hidden" name="desc" value="<?php $desc ?>"/><?php } ?></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_style" class="label"><?php echo lang('user_style') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_style" name="style" title="" class="theme-chooser"<?php if (count($allstyles)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($allstyles,config('interface','style','default'),0,0) ?><?php if (count($allstyles)==0) { ?><input type="hidden" name="style" value="" /><?php } ?><?php if (count($allstyles)==1) { ?><input type="hidden" name="style" value="<?php echo array_keys($allstyles)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_timezone_offset" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'timezone'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_timezone" name="timezone" title="" class=""<?php if (count($timezone_list)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($timezone_list,$timezone,1,0) ?><?php if (count($timezone_list)==0) { ?><input type="hidden" name="timezone" value="" /><?php } ?><?php if (count($timezone_list)==1) { ?><input type="hidden" name="timezone" value="<?php echo array_keys($timezone_list)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'language'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_language" name="language" title="" class=""<?php if (count($language_list)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($language_list,$language,1,0) ?><?php if (count($language_list)==0) { ?><input type="hidden" name="language" value="" /><?php } ?><?php if (count($language_list)==1) { ?><input type="hidden" name="language" value="<?php echo array_keys($language_list)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('security') ?></legend><div>
				<div class="line">
					<div class="label">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('user_password_expires')))); ?></span>
						
					</div>
					<div class="input">
						<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($passwordExpires) ?>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php { $tmpname     = 'totp';$default  = '';$readonly = '';		
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
						
						<label for="<?php echo REQUEST_ID ?>_totp" class="label"><?php echo lang('user_totp') ?>
						</label>
						<div class="qrcode" data-qrcode="<?php echo $totpSecretUrl ?>" title="<?php echo $totpSecretUrl ?>"></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php { $tmpname     = 'hotp';$default  = '';$readonly = '';		
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
						
						<label for="<?php echo REQUEST_ID ?>_hotp" class="label"><?php echo lang('user_hotp') ?>
						</label>
						<div class="qrcode" data-qrcode="<?php echo $hotpSecretUrl ?>" title="<?php echo $hotpSecretUrl ?>"></div>
						
					</div>
				</div>
			</div></fieldset>
		<div class="bottom"><div class="command "><input type="submit" class="submit ok" value="<?php echo lang('global_save') ?>" /></div></div></form>
	