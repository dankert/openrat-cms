
	
		<form name="" target="_self" data-target="view" action="./" data-method="add" data-action="languagelist" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" class="or-form languagelist" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="languagelist" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="add" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('LANGUAGE_ISOCODE')))); ?></span>
					
				</div>
				<div class="input">
					<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_isocode" name="isocode" title="" class=""<?php if (count($isocodes)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($isocodes,$isocode,0,0) ?><?php if (count($isocodes)==0) { ?><input type="hidden" name="isocode" value="" /><?php } ?><?php if (count($isocodes)==1) { ?><input type="hidden" name="isocode" value="<?php echo array_keys($isocodes)[0] ?>" /><?php } ?>
					</select></div>
				</div>
			</div>
		<div class="or-form-actionbar"><input type="submit" class="or-form-btn or-form-btn--primary" value="OK" /></div></form>
	