
	
		<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="element" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form element" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="element" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="prop" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><div class="closable">
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'LABEL'.'')))); ?></span>
						
					</div>
					<div class="input">
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_label" name="<?php if ('') echo ''.'_' ?>label<?php if ('') echo '_disabled' ?>" required="required" autofocus="autofocus" type="text" maxlength="100" class="" value="<?php echo Text::encodeHtml(@$label) ?>" /><?php if ('') { ?><input type="hidden" name="label" value="<?php $label ?>"/><?php } ?></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'NAME'.'')))); ?></span>
						
					</div>
					<div class="input">
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_name" name="<?php if ('') echo ''.'_' ?>name<?php if ('') echo '_disabled' ?>" required="required" type="text" maxlength="50" class="" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_DESCRIPTION')))); ?></span>
						
					</div>
					<div class="input">
						<div class="inputholder"><textarea class="inputarea" name="<?php if ('') echo ''.'_' ?>description<?php if ('') echo '_disabled' ?>" maxlength="255"><?php echo Text::encodeHtml($description) ?></textarea></div>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><div class="closable">
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('ELEMENT_TYPE')))); ?></span>
						
					</div>
					<div class="input">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_typeid" name="typeid" title="" class=""<?php if (count($types)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($types,$typeid,0,1) ?><?php if (count($types)==0) { ?><input type="hidden" name="typeid" value="" /><?php } ?><?php if (count($types)==1) { ?><input type="hidden" name="typeid" value="<?php echo array_keys($types)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
			</div></fieldset>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="OK" /></div></form>
	