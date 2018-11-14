
	
		<form name="" target="_self" data-target="view" action="./" data-method="add" data-action="templatelist" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form templatelist" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="templatelist" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="add" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('name')))); ?></span>
					
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_name" name="name<?php if ('') echo '_disabled' ?>" type="text" maxlength="50" class="text" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
					
				</div>
			</div>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div>
				<div class="line">
					<div class="label">
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_empty" name="type" value="empty"<?php if('empty'==@$type)echo ' checked="checked"' ?> />
						
					</div>
					<div class="input">
						<label for="<?php echo REQUEST_ID ?>_type_empty" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'empty'.'')))); ?></span>
							
						</label>
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_type_copy" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'copy'.'')))); ?></span>
							
						</label>
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_copy" name="type" value="copy"<?php if('copy'==@$type)echo ' checked="checked"' ?> />
						
					</div>
					<div class="input">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_templateid" name="templateid" title="" class=""<?php if (count($templates)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($templates,$templateid,0,0) ?><?php if (count($templates)==0) { ?><input type="hidden" name="templateid" value="" /><?php } ?><?php if (count($templates)==1) { ?><input type="hidden" name="templateid" value="<?php echo array_keys($templates)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_type_example" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'example'.'')))); ?></span>
							
						</label>
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_example" name="type" value="example"<?php if('example'==@$type)echo ' checked="checked"' ?> />
						
					</div>
					<div class="input">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_example" name="example" title="" class=""<?php if (count($examples)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($examples,$example,0,0) ?><?php if (count($examples)==0) { ?><input type="hidden" name="example" value="" /><?php } ?><?php if (count($examples)==1) { ?><input type="hidden" name="example" value="<?php echo array_keys($examples)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
			</div></fieldset>
		<div class="or-form-actionbar"><input type="submit" class="or-form-btn or-form-btn--primary" value="OK" /></div></form>
	