<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="pw" data-action="user" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form user">
		<div class="line">
			<div class="label">
			</div>
			<div class="input">
				<input type="radio" name="type" disabled="" value="proposal" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
				</input>
				<label class="label"><?php echo encodeHtml(htmlentities(@$password_proposal)) ?>
					<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_new_password'))) ?>
					</span>
					<span class=""> 
					</span>
					<span class=""><?php echo encodeHtml(htmlentities(@$password_proposal)) ?>
					</span>
				</label>
				<input type="hidden" name="password_proposal" value="<?php echo encodeHtml(htmlentities(@$password_proposal)) ?>" class="">
				</input>
			</div>
		</div>
		<?php $if3=(config('mail','enabled')); if($if3) {  ?>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input type="radio" name="type" disabled="" value="random" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
					</input>
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_random_password'))) ?>
					</label>
				</div>
			</div>
		 <?php } ?>
		<div class="line">
			<div class="label">
			</div>
			<div class="input">
				<input type="radio" name="type" disabled="" value="input" checked="<?php echo encodeHtml(htmlentities(@$type)) ?>" class="">
				</input>
				<label class="label"><?php echo encodeHtml(htmlentities(@lang('USER_NEW_PASSWORD_INPUT'))) ?>
				</label>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<label class="label"><?php echo encodeHtml(htmlentities(@lang('USER_new_password'))) ?>
				</label>
			</div>
			<div class="input">
				<div class="inputholder"><input type="password" name="password1" size="40" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$password1)) ?>" class="">
				</input></div>
			</div>
		</div>
		<div class="line">
			<div class="label">
				<label class="label"><?php echo encodeHtml(htmlentities(@lang('USER_new_password_repeat'))) ?>
				</label>
			</div>
			<div class="input">
				<div class="inputholder"><input type="password" name="password2" size="40" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$password2)) ?>" class="">
				</input></div>
			</div>
		</div>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
		</div></fieldset>
		<?php $if3=(config('mail','enabled')); if($if3) {  ?>
			<?php $if4=(isset($mail)); if($if4) {  ?>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<input type="checkbox" name="email" value="1" <?php if(''.@$email.''){ ?>checked="1"<?php } ?> class="">
						</input>
						<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_mail_new_password'))) ?>
						</label>
					</div>
				</div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<input type="checkbox" name="timeout" value="1" <?php if(''.@$timeout.''){ ?>checked="1"<?php } ?> class="">
						</input>
						<label class="label"><?php echo encodeHtml(htmlentities(@lang('user_password_timeout'))) ?>
						</label>
					</div>
				</div>
			 <?php } ?>
		 <?php } ?>
	</form>