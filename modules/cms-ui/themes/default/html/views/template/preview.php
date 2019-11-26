<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="self" action="./" data-method="preview" data-action="template" data-id="<?php echo OR_ID ?>" method="GET" enctype="application/x-www-form-urlencoded" class="or-form template" data-async="false" data-autosave="true"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="template" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="preview" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
		<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_modelid" name="modelid" title="" class=""<?php if (count($models)<=1) echo ' disabled="disabled"'; ?> size="1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($models,$modelid,0,0) ?><?php if (count($models)==0) { ?><input type="hidden" name="modelid" value="" /><?php } ?><?php if (count($models)==1) { ?><input type="hidden" name="modelid" value="<?php echo array_keys($models)[0] ?>" /><?php } ?>
		</select></div>
	<div class="or-form-actionbar"><input type="submit" class="or-form-btn or-form-btn--primary or-form-btn--save" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
	<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('preview') ?></legend><div class="closable">
		<iframe src="<?php echo $preview_url ?>"></iframe>
		<a class="action" target="_self" data-action="file" data-method="edit" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#/file/">
			<img src="./modules/cms-ui/themes/default/images/icon/icon/edit.png" />
			<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_file_edit'.'')))); ?></span>
		</a>
		<a class="action" target="_self" data-action="file" data-method="editvalue" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#/file/">
			<img src="./modules/cms-ui/themes/default/images/icon/icon/editvalue.png" />
			<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'menu_file_editvalue'.'')))); ?></span>
		</a>
	</div></fieldset>