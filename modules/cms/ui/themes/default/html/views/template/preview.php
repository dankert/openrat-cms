<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="self" action="./" data-method="preview" data-action="template" data-id="<?php echo OR_ID ?>" method="GET" enctype="application/x-www-form-urlencoded" data-async="" data-autosave="1" class="or-form template">
		<input name="modelid" value="<?php echo encodeHtml(htmlentities(@$modelid)) ?>" size="1" class="">
		</input>
	</form>
	<fieldset class="or-group toggle-open-close open show"><div class="closable">
		<iframe src="<?php echo encodeHtml(htmlentities(@$preview_url)) ?>" class="">
		</iframe>
		<a target="_self" data-action="file" data-method="edit" data-id="" data-extra="[]" href="/#/file/" class="action">
			<img src="./modules/cms-ui/themes/default/images/icon/icon/edit.png" class="">
			</img>
			<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_file_edit'))) ?>
			</span>
		</a>
		<a target="_self" data-action="file" data-method="editvalue" data-id="" data-extra="[]" href="/#/file/" class="action">
			<img src="./modules/cms-ui/themes/default/images/icon/icon/editvalue.png" class="">
			</img>
			<span class=""><?php echo encodeHtml(htmlentities(@lang('menu_file_editvalue'))) ?>
			</span>
		</a>
	</div></fieldset>