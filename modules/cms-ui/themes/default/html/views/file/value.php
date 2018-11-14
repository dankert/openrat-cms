
	
		<form name="" target="_self" data-target="view" action="./" data-method="value" data-action="file" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form file" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="file" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="value" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			
				<tr>
					<td>
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_VALUE')))); ?></span>
						
					</td>
					<td>
						<textarea name="value" data-extension="" data-mimetype="" data-mode="htmlmixed" class="editor code-editor"><?php echo ${'value'} ?></textarea>
						
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
			
		<div class="bottom"><div class="command "><input type="submit" class="submit ok" value="OK" /></div></div></form>
		
		
	