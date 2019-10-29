<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<form name="" target="_self" data-target="view" action="./" data-method="copy" data-action="object" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form object" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="object" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="copy" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<input type="hidden" name="sourceid" value="<?php echo $sourceId ?>"/>
					
				</div>
				<div class="input">
					<span><?php echo nl2br(encodeHtml(htmlentities(@$source[name]))); ?></span>
					
				</div>
			</div>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_type" name="type" title="" class=""<?php if (count($types)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($types,$type,0,0) ?><?php if (count($types)==0) { ?><input type="hidden" name="type" value="" /><?php } ?><?php if (count($types)==1) { ?><input type="hidden" name="type" value="<?php echo array_keys($types)[0] ?>" /><?php } ?>
					</select></div>
				</div>
			</div>
			<div class="line">
				<div class="label">
					<input type="hidden" name="targetid" value="<?php echo $targetId ?>"/>
					
				</div>
				<div class="input">
					<span><?php echo nl2br(encodeHtml(htmlentities(@$target[name]))); ?></span>
					
				</div>
			</div>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
	