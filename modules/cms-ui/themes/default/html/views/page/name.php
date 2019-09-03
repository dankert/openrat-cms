<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<form name="" target="_self" data-target="view" action="./" data-method="name" data-action="page" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form page" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="page" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="name" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<input type="hidden" name="languageid" value="<?php echo $languageid ?>"/>
			
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('name') ?></legend><div class="closable">
				<label class="or-form-row"><span class="or-form-label"><?php echo lang('name') ?></span><span class="or-form-input"><div class="inputholder"><input id="<?php echo REQUEST_ID ?>_name" name="<?php if ('') echo ''.'_' ?>name<?php if ('') echo '_disabled' ?>" required="required" type="text" maxlength="255" class="" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div></span></label>
				
				<label class="or-form-row"><span class="or-form-label">?description?</span><span class="or-form-input"><div class="inputholder"><textarea class="description" name="<?php if ('') echo ''.'_' ?>description<?php if ('') echo '_disabled' ?>" maxlength="255"><?php echo Text::encodeHtml($description) ?></textarea></div></span></label>
				
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('alias') ?></legend><div class="closable">
				<label class="or-form-row"><span class="or-form-label"><?php echo lang('alias') ?></span><span class="or-form-input"><div class="inputholder"><input id="<?php echo REQUEST_ID ?>_alias_filename" name="<?php if ('') echo ''.'_' ?>alias_filename<?php if ('') echo '_disabled' ?>" type="text" maxlength="150" class="filename" value="<?php echo Text::encodeHtml(@$alias_filename) ?>" /><?php if ('') { ?><input type="hidden" name="alias_filename" value="<?php $alias_filename ?>"/><?php } ?></div></span></label>
				
				<label class="or-form-row"><span class="or-form-label">?folder?</span><span class="or-form-input"><div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_alias_folderid" name="alias_folderid" title="" class=""<?php if (count($folders)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($folders,$alias_folderid,0,0) ?><?php if (count($folders)==0) { ?><input type="hidden" name="alias_folderid" value="" /><?php } ?><?php if (count($folders)==1) { ?><input type="hidden" name="alias_folderid" value="<?php echo array_keys($folders)[0] ?>" /><?php } ?>
				</select></div></span></label>
				<label class="or-form-row"><span class="or-form-label"></span><span class="or-form-input"><?php { $tmpname     = 'leave_link';$default  = '0';$readonly = '';$required = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>&nbsp;?leave_link? </span></label>
				
			</div></fieldset>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('global_save') ?>" /></div></form>
	