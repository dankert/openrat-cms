<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="object" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form object" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="object" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="prop" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('global_prop') ?></legend><div class="closable">
				<label class="or-form-row"><span class="or-form-label"><?php echo lang('global_filename') ?></span><span class="or-form-input"><div class="inputholder"><input id="<?php echo REQUEST_ID ?>_filename" name="<?php if ('') echo ''.'_' ?>filename<?php if (false) echo '_disabled' ?>" autofocus="autofocus" type="text" maxlength="150" class="filename" value="<?php echo Text::encodeHtml(@$filename) ?>" /><?php if (false) { ?><input type="hidden" name="filename" value="<?php $filename ?>"/><?php } ?></div></span></label>
				
				<label class="or-form-row"><span class="or-form-label"><?php echo lang('alias') ?></span><span class="or-form-input"><div class="inputholder"><input id="<?php echo REQUEST_ID ?>_alias_filename" name="<?php if ('') echo ''.'_' ?>alias_filename<?php if (false) echo '_disabled' ?>" type="text" maxlength="150" class="filename" value="<?php echo Text::encodeHtml(@$alias_filename) ?>" /><?php if (false) { ?><input type="hidden" name="alias_filename" value="<?php $alias_filename ?>"/><?php } ?></div></span></label>
				
				<label class="or-form-row"><span class="or-form-label">?folder?</span><span class="or-form-input"><div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_alias_folderid" name="alias_folderid" title="" class=""<?php if (count($folders)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($folders,$alias_folderid,0,0) ?><?php if (count($folders)==0) { ?><input type="hidden" name="alias_folderid" value="" /><?php } ?><?php if (count($folders)==1) { ?><input type="hidden" name="alias_folderid" value="<?php echo array_keys($folders)[0] ?>" /><?php } ?>
				</select></div></span></label>
			</div></fieldset>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('global_save') ?>" /></div></form>
	