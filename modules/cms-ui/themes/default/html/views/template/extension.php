
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="extension" data-action="template" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="template" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="template" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="extension" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><div>
				<div class="line">
					<div class="label">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('TEMPLATE_extension')))); ?></span>
						
					</div>
					<div class="input">
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_list" name="type" value="list"<?php if('list'==@$type)echo ' checked="checked"' ?> />
						
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_extension" name="extension" title="" class=""<?php if (count($mime_types)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($mime_types,$extension,1,0) ?><?php if (count($mime_types)==0) { ?><input type="hidden" name="extension" value="" /><?php } ?><?php if (count($mime_types)==1) { ?><input type="hidden" name="extension" value="<?php echo array_keys($mime_types)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_text" name="type" value="text"<?php if('text'==@$type)echo ' checked="checked"' ?> />
						
						<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_extensiontext" name="extensiontext<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$extensiontext) ?>" /><?php if ('') { ?><input type="hidden" name="extensiontext" value="<?php $extensiontext ?>"/><?php } ?></div>
						
					</div>
				</div>
			</div></fieldset>
		<div class="bottom"><div class="command "><input type="submit" class="submit ok" value="OK" /></div></div></form>
	