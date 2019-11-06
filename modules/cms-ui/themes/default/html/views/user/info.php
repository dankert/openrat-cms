<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="info" data-action="user" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form user" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="user" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="info" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
		<span class="headline"><?php echo nl2br(encodeHtml(htmlentities($fullname))); ?></span>
		<?php $if3=!(($image)==FALSE); if($if3){?>
			<div class="line">
				<div class="input">
					<img src="<?php echo $image ?>" />
				</div>
			</div>
		<?php } ?>
		<div class="line">
			<div class="label">
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'user_username'.'')))); ?></span>
			</div>
			<div class="input">
				<span class="name"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
			</div>
		</div>
		<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('ADDITIONAL_INFO') ?></legend><div class="closable">
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'user_fullname'.'')))); ?></span>
				</div>
				<div class="input">
					<span><?php echo nl2br(encodeHtml(htmlentities($fullname))); ?></span>
				</div>
			</div>
			<?php $if4=(config('security','user','show_admin_mail')); if($if4){?>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_mail" class="label"><?php echo lang('user_mail') ?>
						</label>
					</div>
					<div class="input">
						<a target="_self" data-url="<?php echo 'mailto:'.$mail.'' ?>" data-type="external" data-action="" data-method="info" data-id="<?php echo OR_ID ?>" data-extra="[]" href="<?php echo 'mailto:'.$mail.'' ?>">
							<span><?php echo nl2br(encodeHtml(htmlentities($mail))); ?></span>
						</a>
						<i class="image-icon image-icon--menu-qrcode or-qrcode or-info" data-qrcode="<?php echo 'mailto:'.$mail.'' ?>" title="?QRCODE_SHOW?"></i>
					</div>
				</div>
			<?php } ?>
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'description'.'')))); ?></span>
				</div>
				<div class="input">
					<span><?php echo nl2br(encodeHtml(htmlentities($desc))); ?></span>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_tel" class="label"><?php echo lang('user_tel') ?>
					</label>
				</div>
				<div class="input">
					<span><?php echo nl2br(encodeHtml(htmlentities($tel))); ?></span>
					<i class="image-icon image-icon--menu-qrcode or-qrcode or-info" data-qrcode="<?php echo 'tel:'.$tel.'' ?>" title="?QRCODE_SHOW?"></i>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'timezone'.'')))); ?></span>
				</div>
				<div class="input">
					<span><?php echo nl2br(encodeHtml(htmlentities($timezone))); ?></span>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'language'.'')))); ?></span>
					</label>
				</div>
				<div class="input">
					<span><?php echo nl2br(encodeHtml(htmlentities($language))); ?></span>
				</div>
			</div>
			<div class="line">
				<div class="label">
				</div>
				<div class="input clickable">
					<a class="or-link-btn" target="_self" data-type="dialog" data-action="" data-method="prop" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':null,'dialogMethod':'prop'}" href="./#//">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit'.'')))); ?></span>
					</a>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="toggle-open-close<?php echo false?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div class="closable">
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<?php { $tmpname     = 'is_admin';$default  = false;$readonly = true;$required = false;		
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
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'user_ldapdn'.'')))); ?></span>
				</div>
				<div class="input">
					<span><?php echo nl2br(encodeHtml(htmlentities($ldap_dn))); ?></span>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'user_style'.'')))); ?></span>
				</div>
				<div class="input">
					<span><?php echo nl2br(encodeHtml(htmlentities($style))); ?></span>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="toggle-open-close<?php echo false?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('security') ?></legend><div class="closable">
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
				<div class="input clickable">
					<a class="or-link-btn" target="_self" data-type="dialog" data-action="user" data-method="pw" data-id="<?php echo OR_ID ?>" data-extra="{'dialogAction':'user','dialogMethod':'pw'}" href="./#/user/">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'edit_password'.'')))); ?></span>
					</a>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('user_last_login')))); ?></span>
				</div>
				<div class="input">
					<?php include_once( 'modules/template-engine/components/html/date/component-date.php') ?><?php component_date($lastLogin) ?>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('token')))); ?></span>
				</div>
				<div class="input">
					<span><?php echo nl2br(encodeHtml(htmlentities($totpToken))); ?></span>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_totp" class="label"><?php echo lang('user_totp') ?>
					</label>
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