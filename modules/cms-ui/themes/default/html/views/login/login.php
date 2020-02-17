<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="login" data-action="login" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" data-after-success="reloadAll" class="or-form login">
		<?php $if3=(config('login','logo','enabled')); if($if3) {  ?>
			<?php $if4=!((config('login','logo','url'))==FALSE); if($if4) {  ?>
				<a target="_self" data-url="<?php echo encodeHtml(htmlentities(config('login','logo','url'))) ?>" data-action="" data-method="" data-id="" data-extra="[]" href="/#//" class="">
					<img src="<?php echo encodeHtml(htmlentities(config('login','logo','image'))) ?>" class="">
					</img>
				</a>
			 <?php } ?>
			<?php if(!$if4) {  ?>
				<img src="<?php echo encodeHtml(htmlentities(config('login','logo','image'))) ?>" class="">
				</img>
			 <?php } ?>
		 <?php } ?>
		<?php $if3=!((config('login','motd'))==FALSE); if($if3) {  ?>
			<div class="message info">
				<span class=""><?php echo encodeHtml(htmlentities(config('login','motd'))) ?>
				</span>
			</div>
		 <?php } ?>
		<?php $if3=(config('login','nologin')); if($if3) {  ?>
			<div class="message error">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('LOGIN_NOLOGIN_DESC'))) ?>
				</span>
			</div>
		 <?php } ?>
		<?php $if3=(config('security','readonly')); if($if3) {  ?>
			<div class="message warn">
				<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_READONLY_DESC'))) ?>
				</span>
			</div>
		 <?php } ?>
		<?php $if3=(!config('login','nologin')); if($if3) {  ?>
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_USERNAME'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<?php $if6=!(isset($force_username)); if($if6) {  ?>
						<input name="login_name" disabled="" required="required" placeholder="<?php echo encodeHtml(htmlentities(@lang('USER_USERNAME'))) ?>" autofocus="autofocus" type="text" maxlength="128" value="<?php echo encodeHtml(htmlentities(@$login_name)) ?>" class="name">
						</input>
					 <?php } ?>
					<?php if(!$if6) {  ?>
						<input type="hidden" name="login_name" value="<?php echo encodeHtml(htmlentities(@$login_name)) ?>" class="">
						</input>
						<span class=""><?php echo encodeHtml(htmlentities(@$force_username)) ?>
						</span>
					 <?php } ?>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_PASSWORD'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><input type="password" name="login_password" size="20" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$login_password)) ?>" class="name">
					</input></div>
				</div>
			</div>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input type="checkbox" name="remember" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$remember)) ?>" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('REMEMBER_ME'))) ?>
						</span>
					</label>
				</div>
			</div>
		 <?php } ?>
		<fieldset class="or-group toggle-open-close closed"><div class="closable">
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_NEW_PASSWORD'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><input type="password" name="password1" size="25" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$password1)) ?>" class="">
					</input></div>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_NEW_PASSWORD_REPEAT'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><input type="password" name="password2" size="25" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$password2)) ?>" class="">
					</input></div>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="or-group toggle-open-close closed"><div class="closable">
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('USER_TOKEN'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<input name="user_token" disabled="" type="text" maxlength="30" value="" class="">
					</input>
				</div>
			</div>
		</div></fieldset>
		<?php $if3=(intval('1')<intval('size:dbids')); if($if3) {  ?>
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
				<div class="line">
					<div class="label">
						<label class="label">
							<span class=""><?php echo encodeHtml(htmlentities(@lang('DATABASE'))) ?>
							</span>
						</label>
					</div>
					<div class="input">
						<input name="dbid" value="<?php echo encodeHtml(htmlentities(@$dbid)) ?>" size="1" class="">
						</input>
					</div>
				</div>
			</div></fieldset>
		 <?php } ?>
		<?php if(!$if3) {  ?>
			<input type="hidden" name="dbid" value="<?php echo encodeHtml(htmlentities(@$dbid)) ?>" class="">
			</input>
		 <?php } ?>
		<input type="hidden" name="objectid" value="<?php echo encodeHtml(htmlentities(@$objectid)) ?>" class="">
		</input>
		<input type="hidden" name="modelid" value="<?php echo encodeHtml(htmlentities(@$modelid)) ?>" class="">
		</input>
		<input type="hidden" name="projectid" value="<?php echo encodeHtml(htmlentities(@$projectid)) ?>" class="">
		</input>
		<input type="hidden" name="languageid" value="<?php echo encodeHtml(htmlentities(@$languageid)) ?>" class="">
		</input>
	</form>