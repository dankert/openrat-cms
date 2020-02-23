<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="user" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form user">
		<div class="line">
			<div class="label">
				<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_username'))) ?>
				</label>
			</div>
			<div class="input">
				<input name="name" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$name)) ?>" class="name,focus">
				</input>
			</div>
		</div>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_fullname'))) ?>
					</label>
				</div>
				<div class="input">
					<input name="fullname" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$fullname)) ?>" class="">
					</input>
				</div>
			</div>
			<?php $if4=(config('security','user','show_admin_mail')); if($if4) {  ?>
				<div class="line">
					<div class="label">
						<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_mail'))) ?>
						</label>
					</div>
					<div class="input">
						<input name="mail" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$mail)) ?>" class="">
						</input>
						<i data-qrcode="mailto:<?php echo encodeHtml(htmlentities(@$mail)) ?>" title="<?php echo encodeHtml(htmlentities(@lang('QRCODE_SHOW'))) ?>" class="image-icon image-icon--menu-qrcode or-qrcode or-info">
						</i>
					</div>
				</div>
			 <?php } ?>
			<div class="line">
				<div class="label">
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_desc'))) ?>
					</label>
				</div>
				<div class="input">
					<input name="desc" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$desc)) ?>" class="">
					</input>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_tel'))) ?>
					</label>
				</div>
				<div class="input">
					<input name="tel" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$tel)) ?>" class="">
					</input>
					<i data-qrcode="tel:<?php echo encodeHtml(htmlentities(@$tel)) ?>" title="<?php echo encodeHtml(htmlentities(@lang('QRCODE_SHOW'))) ?>" class="image-icon image-icon--menu-qrcode or-qrcode or-info">
					</i>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('timezone'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<input name="timezone" value="<?php echo encodeHtml(htmlentities(@$timezone)) ?>" size="1" class="">
					</input>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('language'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<input name="language" value="<?php echo encodeHtml(htmlentities(@$language)) ?>" size="1" class="">
					</input>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input type="checkbox" name="is_admin" value="1" <?php if(''.@$is_admin.''){ ?>checked="1"<?php } ?> class="">
					</input>
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_admin'))) ?>
					</label>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_ldapdn'))) ?>
					</label>
				</div>
				<div class="input">
					<input name="ldap_dn" type="text" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$ldap_dn)) ?>" class="">
					</input>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_style'))) ?>
					</label>
				</div>
				<div class="input">
					<input name="style" value="<?php echo encodeHtml(htmlentities(@$style)) ?>" size="1" class="">
					</input>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input type="checkbox" name="totp" value="1" <?php if(''.@$totp.''){ ?>checked="1"<?php } ?> class="">
					</input>
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_totp'))) ?>
					</label>
					<i data-qrcode="<?php echo encodeHtml(htmlentities(@$totpSecretUrl)) ?>" title="<?php echo encodeHtml(htmlentities(@lang('QRCODE_SHOW'))) ?>" class="image-icon image-icon--menu-qrcode or-qrcode or-info">
					</i>
				</div>
			</div>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input type="checkbox" name="hotp" value="1" <?php if(''.@$hotp.''){ ?>checked="1"<?php } ?> class="">
					</input>
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_hotp'))) ?>
					</label>
					<i data-qrcode="<?php echo encodeHtml(htmlentities(@$hotpSecretUrl)) ?>" title="<?php echo encodeHtml(htmlentities(@lang('QRCODE_SHOW'))) ?>" class="image-icon image-icon--menu-qrcode or-qrcode or-info">
					</i>
				</div>
			</div>
		</div></fieldset>
	</form>