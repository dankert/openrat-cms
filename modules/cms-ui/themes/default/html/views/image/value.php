<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<form name="" target="_self" data-target="view" action="./" data-method="value" data-action="image" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form image" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="image" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="value" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			
				<tr>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_VALUE')))); ?></span>
						
					</td>
					<td>
						<textarea  name="<?php if ('') echo ''.'_' ?>value<?php if ('') echo '_disabled' ?>" data-extension="" data-mimetype="" data-mode="htmlmixed" class="editor code-editor"><?php echo htmlentities(${'value'}) ?></textarea>
						
					</td>
				</tr>
				<tr>
					<td colspan="2" class="act">
								<div class="invisible"><input type="submit" 	name="ok" class="%class%"
	title="?button_ok_DESC?"
	value="&nbsp;&nbsp;&nbsp;&nbsp;?button_ok?&nbsp;&nbsp;&nbsp;&nbsp;" />	
						</div>
					</td>
				</tr>
			
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
		
		
	