<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="remove" data-action="user" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form user">
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
			<fieldset class="or-group toggle-open-close open show"><div class="closable">
			</div></fieldset>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<input type="checkbox" name="confirm" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$confirm)) ?>" required="required" class="">
					</input>
					<label class="label"><?php echo encodeHtml(htmlentities(@lang('delete'))) ?>
					</label>
				</div>
			</div>
		</div></fieldset>
	</form>