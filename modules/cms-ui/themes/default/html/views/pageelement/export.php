<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		
			<form name="" target="_self" data-target="view" action="./" data-method="export" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form pageelement" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="pageelement" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="export" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
				
					<tr>
						<td>
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_type" name="type" title="" class=""<?php if (count($types)<=1) echo ' disabled="disabled"'; ?> size="1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($types,$type,0,0) ?><?php if (count($types)==0) { ?><input type="hidden" name="type" value="" /><?php } ?><?php if (count($types)==1) { ?><input type="hidden" name="type" value="<?php echo array_keys($types)[0] ?>" /><?php } ?>
							</select></div>
						</td>
					</tr>
					<tr>
						<td>
									<div class="invisible"><input type="submit" 	name="ok" class="%class%"
	title="?button_ok_DESC?"
	value="&nbsp;&nbsp;&nbsp;&nbsp;?button_ok?&nbsp;&nbsp;&nbsp;&nbsp;" />	
							</div>
						</td>
					</tr>
				
			<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
			
			
		
	