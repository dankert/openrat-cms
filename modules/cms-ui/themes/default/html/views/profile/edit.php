<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="edit" data-action="profile" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form profile">
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_username'))) ?>
					</label>
				</div>
				<div class="input">
					<span class="name"><?php echo encodeHtml(htmlentities(@$name)) ?>
					</span>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_mail'))) ?>
					</label>
				</div>
				<div class="input">
					<span class=""><?php echo encodeHtml(htmlentities(@$mail)) ?>
					</span>
					<br>
					</br>
					<br>
					</br>
					<div class="clickable">
						<a target="_self" date-name="<?php echo encodeHtml(htmlentities(@lang('mail'))) ?>" name="<?php echo encodeHtml(htmlentities(@lang('mail'))) ?>" data-type="dialog" data-action="profile" data-method="mail" data-id="" data-extra="{'dialogAction':'profile','dialogMethod':'mail'}" href="/#/profile/" class="action">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('edit'))) ?>
							</span>
						</a>
					</div>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_fullname'))) ?>
					</label>
				</div>
				<div class="input">
					<input name="fullname" disabled="" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$fullname)) ?>" class="">
					</input>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_tel'))) ?>
					</label>
				</div>
				<div class="input">
					<input name="tel" disabled="" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$tel)) ?>" class="">
					</input>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_desc'))) ?>
					</label>
				</div>
				<div class="input">
					<input name="desc" disabled="" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$desc)) ?>" class="">
					</input>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_style'))) ?>
					</label>
				</div>
				<div class="input">
					<input name="style" value="<?php echo encodeHtml(htmlentities(@$style)) ?>" size="1" class="or-theme-chooser">
					</input>
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
					<span class=""><?php echo encodeHtml(htmlentities(@lang('user_password_expires'))) ?>
					</span>
				</div>
				<div class="input">
					<?php include_once( 'modules/template-engine/components/html/date/component-date.php'); { component_date($passwordExpires); ?>
					 <?php } ?>
				</div>
			</div>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input type="checkbox" name="totp" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$totp)) ?>" class="">
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
					<input type="checkbox" name="hotp" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$hotp)) ?>" class="">
					</input>
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_hotp'))) ?>
					</label>
					<i data-qrcode="<?php echo encodeHtml(htmlentities(@$hotpSecretUrl)) ?>" title="<?php echo encodeHtml(htmlentities(@lang('QRCODE_SHOW'))) ?>" class="image-icon image-icon--menu-qrcode or-qrcode or-info">
					</i>
				</div>
			</div>
		</div></fieldset>
	</form>