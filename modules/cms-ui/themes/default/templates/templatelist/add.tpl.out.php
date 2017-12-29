
	
		<form name="" target="_self" action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave="" onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('name')))); ?></span>
					
				</div>
				<div class="input">
					<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_name" name="name<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
					
				</div>
			</div>
			<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('options') ?></legend><div>
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
		
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>
</form>
	