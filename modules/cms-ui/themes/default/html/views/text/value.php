
	
		<form name="" target="_self" data-target="view" action="./" data-method="value" data-action="text" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form text" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="text" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="value" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<tr>
				<td>
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_VALUE')))); ?></span>
					
				</td>
				<td>
					<textarea  name="<?php if ('') echo ''.'_' ?>value<?php if ('') echo '_disabled' ?>" data-extension="<?php echo $extension ?>" data-mimetype="<?php echo $mimetype ?>" data-mode="htmlmixed" class="editor code-editor"><?php echo ${'value'} ?></textarea>
					
				</td>
			</tr>
			<tr>
				<td colspan="2" class="act">
							<div class="invisible"><input type="submit" 	name="ok" class="%class%"
	title="Bestätigen"
	value="&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;" />	
					</div>
				</td>
			</tr>
		<div class="or-form-actionbar"><input type="submit" class="or-form-btn or-form-btn--primary" value="OK" /></div></form>
		
		
	