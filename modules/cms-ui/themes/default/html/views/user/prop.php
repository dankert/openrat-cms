
	
		<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="user" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form user" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="user" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="prop" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_name" class="label"><?php echo lang('user_username') ?>
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_name" name="<?php if ('') echo ''.'_' ?>name<?php if ('') echo '_disabled' ?>" type="text" maxlength="128" class="name,focus" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
					
				</div>
			</div>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('ADDITIONAL_INFO') ?></legend><div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_fullname" class="label"><?php echo lang('user_fullname') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_fullname" name="<?php if ('') echo ''.'_' ?>fullname<?php if ('') echo '_disabled' ?>" type="text" maxlength="128" class="" value="<?php echo Text::encodeHtml(@$fullname) ?>" /><?php if ('') { ?><input type="hidden" name="fullname" value="<?php $fullname ?>"/><?php } ?></div>
						
					</div>
				</div>
				<?php $if4=(config('security','user','show_admin_mail')); if($if4){?>
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_mail" class="label"><?php echo lang('user_mail') ?>
							</label>
						</div>
						<div class="input">
							<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_mail" name="<?php if ('') echo ''.'_' ?>mail<?php if ('') echo '_disabled' ?>" type="text" maxlength="255" class="" value="<?php echo Text::encodeHtml(@$mail) ?>" /><?php if ('') { ?><input type="hidden" name="mail" value="<?php $mail ?>"/><?php } ?></div>
							
							<i class="image-icon image-icon--menu-qrcode or-qrcode or-info" data-qrcode="<?php echo 'mailto:'.$mail.'' ?>" title="QR-Code anzeigen"></i>
							
						</div>
					</div>
				<?php } ?>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_desc" class="label"><?php echo lang('user_desc') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_desc" name="<?php if ('') echo ''.'_' ?>desc<?php if ('') echo '_disabled' ?>" type="text" maxlength="255" class="" value="<?php echo Text::encodeHtml(@$desc) ?>" /><?php if ('') { ?><input type="hidden" name="desc" value="<?php $desc ?>"/><?php } ?></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_tel" class="label"><?php echo lang('user_tel') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_tel" name="<?php if ('') echo ''.'_' ?>tel<?php if ('') echo '_disabled' ?>" type="text" maxlength="128" class="" value="<?php echo Text::encodeHtml(@$tel) ?>" /><?php if ('') { ?><input type="hidden" name="tel" value="<?php $tel ?>"/><?php } ?></div>
						
						<i class="image-icon image-icon--menu-qrcode or-qrcode or-info" data-qrcode="<?php echo 'tel:'.$tel.'' ?>" title="QR-Code anzeigen"></i>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_timezone_offset" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'timezone'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_timezone" name="timezone" title="" class="" size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($timezone_list,$timezone,1,0) ?><?php if (count($timezone_list)==0) { ?><input type="hidden" name="timezone" value="" /><?php } ?><?php if (count($timezone_list)==1) { ?><input type="hidden" name="timezone" value="<?php echo array_keys($timezone_list)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'language'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_language" name="language" title="" class="" size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($language_list,$language,1,0) ?><?php if (count($language_list)==0) { ?><input type="hidden" name="language" value="" /><?php } ?><?php if (count($language_list)==1) { ?><input type="hidden" name="language" value="<?php echo array_keys($language_list)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php { $tmpname     = 'is_admin';$default  = '';$readonly = '';$required = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						
						<label for="<?php echo REQUEST_ID ?>_is_admin" class="label"><?php echo lang('user_admin') ?>
						</label>
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_ldap_dn" class="label"><?php echo lang('user_ldapdn') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_ldap_dn" name="<?php if ('') echo ''.'_' ?>ldap_dn<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$ldap_dn) ?>" /><?php if ('') { ?><input type="hidden" name="ldap_dn" value="<?php $ldap_dn ?>"/><?php } ?></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_style" class="label"><?php echo lang('user_style') ?>
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_style" name="style" title="" class=""<?php if (count($allstyles)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($allstyles,$style,0,0) ?><?php if (count($allstyles)==0) { ?><input type="hidden" name="style" value="" /><?php } ?><?php if (count($allstyles)==1) { ?><input type="hidden" name="style" value="<?php echo array_keys($allstyles)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('security') ?></legend><div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php { $tmpname     = 'totp';$default  = '';$readonly = '';$required = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						
						<label for="<?php echo REQUEST_ID ?>_totp" class="label"><?php echo lang('user_totp') ?>
						</label>
						<i class="image-icon image-icon--menu-qrcode or-qrcode or-info" data-qrcode="<?php echo $totpSecretUrl ?>" title="QR-Code anzeigen"></i>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php { $tmpname     = 'hotp';$default  = '';$readonly = '';$required = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						
						<label for="<?php echo REQUEST_ID ?>_hotp" class="label"><?php echo lang('user_hotp') ?>
						</label>
						<i class="image-icon image-icon--menu-qrcode or-qrcode or-info" data-qrcode="<?php echo $hotpSecretUrl ?>" title="QR-Code anzeigen"></i>
						
					</div>
				</div>
			</div></fieldset>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="OK" /></div></form>
	