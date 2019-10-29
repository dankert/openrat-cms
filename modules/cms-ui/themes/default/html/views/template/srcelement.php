<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="srcelement" data-action="template" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form template" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="template" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="srcelement" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<?php $if3=(isset($elements)); if($if3){?>
				<div class="line">
					<div class="label">
						<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_type_addelement" name="<?php if ('') echo ''.'_' ?>type<?php if (false) echo '_disabled' ?>" value="addelement"<?php if('addelement'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_addelement" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'value'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_elementid" name="elementid" title="" class=""<?php if (count($elements)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($elements,$elementid,0,0) ?><?php if (count($elements)==0) { ?><input type="hidden" name="elementid" value="" /><?php } ?><?php if (count($elements)==1) { ?><input type="hidden" name="elementid" value="<?php echo array_keys($elements)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
			<?php } ?>
			<?php $if3=(isset($writable_elements)); if($if3){?>
				<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><div class="closable">
				</div></fieldset>
				<div class="line">
					<div class="label">
						<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_type_addicon" name="<?php if ('') echo ''.'_' ?>type<?php if (false) echo '_disabled' ?>" value="addicon"<?php if('addicon'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_addicon" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_ICON'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_writable_elementid" name="writable_elementid" title="" class=""<?php if (count($writable_elements)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($writable_elements,$writable_elementid,0,0) ?><?php if (count($writable_elements)==0) { ?><input type="hidden" name="writable_elementid" value="" /><?php } ?><?php if (count($writable_elements)==1) { ?><input type="hidden" name="writable_elementid" value="<?php echo array_keys($writable_elements)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
				<div class="line">
					<div class="label">
						<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_type_addifempty" name="<?php if ('') echo ''.'_' ?>type<?php if (false) echo '_disabled' ?>" value="addifempty"<?php if('addifempty'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_addifempty" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'TEMPLATE_SRC_IFEMPTY'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
					</div>
				</div>
				<div class="line">
					<div class="label">
						<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_type_addifnotempty" name="<?php if ('') echo ''.'_' ?>type<?php if (false) echo '_disabled' ?>" value="addifnotempty"<?php if('addifnotempty'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_addifnotempty" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'TEMPLATE_SRC_IFNOTEMPTY'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
					</div>
				</div>
			<?php } ?>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
	