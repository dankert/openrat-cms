
	
		
		
		<form name="" target="_self" action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<?php $if3=(!empty($elements)); if($if3){?>
				<div class="line">
					<div class="label">
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_addelement" name="type" value="addelement"<?php if('addelement'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_addelement" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'value'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_elementid" name="elementid" title="" class=""<?php if (count($elements)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($elements,$elementid,0,0) ?><?php if (count($elements)==0) { ?><input type="hidden" name="elementid" value="" /><?php } ?><?php if (count($elements)==1) { ?><input type="hidden" name="elementid" value="<?php echo array_keys($elements)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
			<?php } ?>
			<?php $if3=(!empty($writable_elements)); if($if3){?>
				<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><div>
				</div></fieldset>
				<div class="line">
					<div class="label">
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_addicon" name="type" value="addicon"<?php if('addicon'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_addicon" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'GLOBAL_ICON'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_writable_elementid" name="writable_elementid" title="" class=""<?php if (count($writable_elements)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($writable_elements,$writable_elementid,0,0) ?><?php if (count($writable_elements)==0) { ?><input type="hidden" name="writable_elementid" value="" /><?php } ?><?php if (count($writable_elements)==1) { ?><input type="hidden" name="writable_elementid" value="<?php echo array_keys($writable_elements)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
				<div class="line">
					<div class="label">
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_addifempty" name="type" value="addifempty"<?php if('addifempty'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_addifempty" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'TEMPLATE_SRC_IFEMPTY'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
					</div>
				</div>
				<div class="line">
					<div class="label">
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_addifnotempty" name="type" value="addifnotempty"<?php if('addifnotempty'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_addifnotempty" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'TEMPLATE_SRC_IFNOTEMPTY'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
					</div>
				</div>
			<?php } ?>
		<div class="bottom"><div class="command "><input type="button" class="submit ok" value="OK" /></div></div></form>
	