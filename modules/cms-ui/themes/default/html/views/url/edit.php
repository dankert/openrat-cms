<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="edit" data-action="url" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="" class="or-form url">
		<fieldset class="or-group toggle-open-close open show"><div class="closable">
			<div class="line">
				<div class="label">
					<span class=""><?php echo encodeHtml(htmlentities(@lang('link_url'))) ?>
					</span>
				</div>
				<div class="input">
					<input name="url" disabled="" type="text" maxlength="255" value="<?php echo encodeHtml(htmlentities(@$url)) ?>" class="">
					</input>
				</div>
			</div>
		</div></fieldset>
	</form>