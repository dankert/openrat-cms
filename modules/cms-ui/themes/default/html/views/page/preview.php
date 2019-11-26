<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="self" action="./" data-method="preview" data-action="page" data-id="<?php echo OR_ID ?>" method="GET" enctype="application/x-www-form-urlencoded" class="or-form page" data-async="false" data-autosave="true"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="page" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="preview" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
		<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_languageid" name="languageid" title="" class=""<?php if (count($languages)<=1) echo ' disabled="disabled"'; ?> size="1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($languages,$languageid,0,0) ?><?php if (count($languages)==0) { ?><input type="hidden" name="languageid" value="" /><?php } ?><?php if (count($languages)==1) { ?><input type="hidden" name="languageid" value="<?php echo array_keys($languages)[0] ?>" /><?php } ?>
		</select></div>
		<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_modelid" name="modelid" title="" class=""<?php if (count($models)<=1) echo ' disabled="disabled"'; ?> size="1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($models,$modelid,0,0) ?><?php if (count($models)==0) { ?><input type="hidden" name="modelid" value="" /><?php } ?><?php if (count($models)==1) { ?><input type="hidden" name="modelid" value="<?php echo array_keys($models)[0] ?>" /><?php } ?>
		</select></div>
	<div class="or-form-actionbar"><input type="submit" class="or-form-btn or-form-btn--primary or-form-btn--save" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
	<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('PREVIEW') ?></legend><div class="closable">
		<div class="toolbar-icon clickable">
			<a class="action" target="_self" data-url="<?php echo $preview_url ?>" data-type="popup" data-action="" data-method="preview" data-id="<?php echo OR_ID ?>" data-extra="[]" href="./#//">
				<i class="image-icon image-icon--menu-open_in_new"></i>
				<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'link_open_in_new_window'.'')))); ?></span>
			</a>
		</div>
		<iframe name="preview" src="<?php echo $preview_url ?>"></iframe>
	</div></fieldset>