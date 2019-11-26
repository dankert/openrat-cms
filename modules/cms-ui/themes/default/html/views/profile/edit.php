<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="edit" data-action="profile" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form profile" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="profile" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="edit" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
		<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('name') ?></legend><div class="closable">
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
		<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('MENU_PROFILE_MAIL') ?></legend><div class="closable">
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_mail" class="label"><?php echo lang('user_mail') ?>
					</label>
				</div>
				<div class="input">
					<span><?php echo nl2br(encodeHtml(htmlentities($mail))); ?></span>
					<br/>
					<br/>
					<div class="clickable">
						<a class="action" target="_self" date-name="<?php echo lang('mail') ?>" name="<?php echo lang('mail') ?>" data-type="dialog" data-action="profile" data-method="mail" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'profile','dialogMethod':'mail'}" href="./#/profile/">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit'.'')))); ?></span>
						</a>
					</div>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('GLOBAL_PROP') ?></legend><div class="closable">
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_fullname" class="label"><?php echo lang('user_fullname') ?>
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_fullname" name="<?php if ('') echo ''.'_' ?>fullname<?php if (false) echo '_disabled' ?>" type="text" maxlength="128" class="" value="<?php echo Text::encodeHtml(@$fullname) ?>" /><?php if (false) { ?><input type="hidden" name="fullname" value="<?php $fullname ?>"/><?php } ?></div>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_tel" class="label"><?php echo lang('user_tel') ?>
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_tel" name="<?php if ('') echo ''.'_' ?>tel<?php if (false) echo '_disabled' ?>" type="text" maxlength="128" class="" value="<?php echo Text::encodeHtml(@$tel) ?>" /><?php if (false) { ?><input type="hidden" name="tel" value="<?php $tel ?>"/><?php } ?></div>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_desc" class="label"><?php echo lang('user_desc') ?>
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_desc" name="<?php if ('') echo ''.'_' ?>desc<?php if (false) echo '_disabled' ?>" type="text" maxlength="128" class="" value="<?php echo Text::encodeHtml(@$desc) ?>" /><?php if (false) { ?><input type="hidden" name="desc" value="<?php $desc ?>"/><?php } ?></div>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_style" class="label"><?php echo lang('user_style') ?>
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_style" name="style" title="" class="or-theme-chooser"<?php if (count($allstyles)<=1) echo ' disabled="disabled"'; ?> size="1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($allstyles,$style,0,0) ?><?php if (count($allstyles)==0) { ?><input type="hidden" name="style" value="" /><?php } ?><?php if (count($allstyles)==1) { ?><input type="hidden" name="style" value="<?php echo array_keys($allstyles)[0] ?>" /><?php } ?>
					</select></div>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_timezone_offset" class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'timezone'.'')))); ?></span>
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_timezone" name="timezone" title="" class="" size="1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($timezone_list,$timezone,1,0) ?><?php if (count($timezone_list)==0) { ?><input type="hidden" name="timezone" value="" /><?php } ?><?php if (count($timezone_list)==1) { ?><input type="hidden" name="timezone" value="<?php echo array_keys($timezone_list)[0] ?>" /><?php } ?>
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
					<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_language" name="language" title="" class="" size="1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($language_list,$language,1,0) ?><?php if (count($language_list)==0) { ?><input type="hidden" name="language" value="" /><?php } ?><?php if (count($language_list)==1) { ?><input type="hidden" name="language" value="<?php echo array_keys($language_list)[0] ?>" /><?php } ?>
					</select></div>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('security') ?></legend><div class="closable">
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('user_password_expires')))); ?></span>
				</div>
				<div class="input">
					<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($passwordExpires) ?>
				</div>
			</div>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<?php { $tmpname     = 'totp';$default  = false;$readonly = false;$required = false;		
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
					<i class="image-icon image-icon--menu-qrcode or-qrcode or-info" data-qrcode="<?php echo $totpSecretUrl ?>" title="?QRCODE_SHOW?"></i>
				</div>
			</div>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<?php { $tmpname     = 'hotp';$default  = false;$readonly = false;$required = false;		
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
					<i class="image-icon image-icon--menu-qrcode or-qrcode or-info" data-qrcode="<?php echo $hotpSecretUrl ?>" title="?QRCODE_SHOW?"></i>
				</div>
			</div>
		</div></fieldset>
	<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary or-form-btn--save" value="<?php echo lang('global_save') ?>" /></div></form>