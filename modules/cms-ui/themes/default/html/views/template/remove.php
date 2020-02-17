<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="remove" data-action="template" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form template">
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('GLOBAL_NAME'))) ?>
					</span>
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
				</div>
				<div class="input">
					<input type="checkbox" name="delete" disabled="" value="1" checked="<?php echo encodeHtml(htmlentities(@$delete)) ?>" required="required" class="">
					</input>
					<label class="label">
						<span class=""><?php echo encodeHtml(htmlentities(@lang('CONFIRM_DELETE'))) ?>
						</span>
					</label>
				</div>
			</div>
		</div></fieldset>
	</form>