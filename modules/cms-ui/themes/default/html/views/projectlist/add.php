
	
		<form name="" target="_self" data-target="view" action="./" data-method="add" data-action="projectlist" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="projectlist" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="projectlist" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="add" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('name')))); ?></span>
					
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_name" name="name<?php if ('') echo '_disabled' ?>" type="text" maxlength="128" class="focus" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
					
				</div>
			</div>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_empty" name="type" value="empty"<?php if('empty'==@$type||'1')echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_empty" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'empty'.'')))); ?></span>
							
						</label>
						<br/>
						
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_copy" name="type" value="copy"<?php if('copy'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_copy" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'copy'.'')))); ?></span>
							
						</label>
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_projectid" name="projectid" title="" class=""<?php if (count($projects)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($projects,'',0,0) ?><?php if (count($projects)==0) { ?><input type="hidden" name="projectid" value="" /><?php } ?><?php if (count($projects)==1) { ?><input type="hidden" name="projectid" value="<?php echo array_keys($projects)[0] ?>" /><?php } ?>
						</select></div>
					</div>
				</div>
			</div></fieldset>
		<div class="bottom"><div class="command "><input type="submit" class="submit ok" value="OK" /></div></div></form>
	