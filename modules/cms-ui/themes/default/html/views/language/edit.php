
	
		<div class="headermenu"><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_ADVANCED') ?>" data-type="dialog" data-name="<?php echo lang('MENU_ADVANCED') ?>" data-method="advanced"><img src="./themes/default/images/icon/action/advanced.svg" title="<?php echo lang('MENU_advanced_DESC') ?>" /><?php echo lang('MENU_advanced') ?></a></div><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_REMOVE') ?>" data-type="dialog" data-name="<?php echo lang('MENU_REMOVE') ?>" data-method="remove"><img src="./themes/default/images/icon/action/remove.svg" title="<?php echo lang('MENU_remove_DESC') ?>" /><?php echo lang('MENU_remove') ?></a></div></div>
		
		<form name="" target="_self" action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave="" onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_LANGUAGE')))); ?></span>
					
				</div>
				<div class="input">
					<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_isocode" name="isocode" title="" class=""<?php if (count($isocodes)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($isocodes,$isocode,0,0) ?><?php if (count($isocodes)==0) { ?><input type="hidden" name="isocode" value="" /><?php } ?><?php if (count($isocodes)==1) { ?><input type="hidden" name="isocode" value="<?php echo array_keys($isocodes)[0] ?>" /><?php } ?>
					</select></div>
				</div>
			</div>
		<div class="bottom"><div class="command "><input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " /></div></div></form>
	