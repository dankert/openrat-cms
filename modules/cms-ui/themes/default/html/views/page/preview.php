<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="self" action="./" data-method="preview" data-action="page" data-id="<?php echo OR_ID ?>" method="GET" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="1" class="or-form page">
		<input name="languageid" value="<?php echo encodeHtml(htmlentities(@$languageid)) ?>" size="1" class="">
		</input>
		<input name="modelid" value="<?php echo encodeHtml(htmlentities(@$modelid)) ?>" size="1" class="">
		</input>
	</form>
	<fieldset class="or-group toggle-open-close open show"><div class="closable">
		<div class="toolbar-icon clickable">
			<a target="_self" data-url="<?php echo encodeHtml(htmlentities(@$preview_url)) ?>" data-type="popup" data-action="" data-method="" data-id="" data-extra="[]" href="/#//" class="action">
				<i class="image-icon image-icon--menu-open_in_new">
				</i>
				<span class=""><?php echo encodeHtml(htmlentities(@lang('link_open_in_new_window'))) ?>
				</span>
			</a>
		</div>
		<iframe name="preview" src="<?php echo encodeHtml(htmlentities(@$preview_url)) ?>" class="">
		</iframe>
	</div></fieldset>