<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="settings" data-action="object" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form object">
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('from'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<input name="valid_from_date" disabled="" type="date" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$valid_from_date)) ?>" class="">
					</input>
					<input name="valid_from_time" disabled="" type="time" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$valid_from_time)) ?>" class="">
					</input>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('until'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<input name="valid_until_date" disabled="" type="date" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$valid_until_date)) ?>" class="">
					</input>
					<input name="valid_until_time" disabled="" type="time" maxlength="256" value="<?php echo encodeHtml(htmlentities(@$valid_until_time)) ?>" class="">
					</input>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('SETTINGS'))) ?>
						</span>
					</label>
				</div>
				<div class="input">
					<textarea name="settings" data-extension="" data-mimetype="" data-mode="yaml" class="editor code-editor">
					</textarea>
				</div>
			</div>
		</div></fieldset>
	</form>