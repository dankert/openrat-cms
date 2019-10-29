<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		
			<form name="" target="_self" data-target="view" action="./" data-method="add" data-action="project" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" class="or-form project" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="project" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="add" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
				
					<tr>
						<td colspan="2">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('name')))); ?></span>
							
						</td>
						<td>
							<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_name" name="<?php if ('') echo ''.'_' ?>name<?php if (false) echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if (false) { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
							
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div class="closable">
								<div>
									<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_type_empty" name="<?php if ('') echo ''.'_' ?>type<?php if (false) echo '_disabled' ?>" value="empty"<?php if('empty'==@$type)echo ' checked="checked"' ?> />
									
									<label for="<?php echo REQUEST_ID ?>_type_empty" class="label">
										<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'empty'.'')))); ?></span>
										
									</label>
								</div>
								<div>
									<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_type_copy" name="<?php if ('') echo ''.'_' ?>type<?php if (false) echo '_disabled' ?>" value="copy"<?php if('copy'==@$type)echo ' checked="checked"' ?> />
									
									<label for="<?php echo REQUEST_ID ?>_type_copy" class="label">
										<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'copy'.'')))); ?></span>
										
									</label>
									<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_projectid" name="projectid" title="" class=""<?php if (count($projects)<=1) echo ' disabled="disabled"'; ?> size="1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($projects,$projectid,0,0) ?><?php if (count($projects)==0) { ?><input type="hidden" name="projectid" value="" /><?php } ?><?php if (count($projects)==1) { ?><input type="hidden" name="projectid" value="<?php echo array_keys($projects)[0] ?>" /><?php } ?>
									</select></div>
								</div>
							</div></fieldset>
						</td>
					</tr>
					<tr>
						<td colspan="3" class="act">
									<div class="invisible"><input type="submit" 	name="ok" class="%class%"
	title="?button_ok_DESC?"
	value="&nbsp;&nbsp;&nbsp;&nbsp;?button_ok?&nbsp;&nbsp;&nbsp;&nbsp;" />	
							</div>
						</td>
					</tr>
				
			<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
			
			
		
	