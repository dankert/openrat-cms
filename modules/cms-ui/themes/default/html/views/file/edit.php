
	
		<form name="" target="_self" data-target="view" action="./" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="languageid" value="<?php echo $languageid ?>" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			
			
			<div class="label">
			</div>
			<div class="line">
				<div class="input">
					<br/>
					
					<input size="40" id="req1534800225391961163_file" type="file" name="file" class="upload"  />
					
					<br/>
					
					<br/>
					
				</div>
			</div>
			<fieldset class="<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('settings') ?></legend><div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_settings" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'SETTINGS'.'')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<textarea name="settings" data-extension="" data-mimetype="" data-mode="yaml" class="editor code-editor"><?php echo ${'settings'} ?></textarea>
						
					</div>
				</div>
			</div></fieldset>
		<div class="bottom"><div class="command "><input type="submit" class="submit ok" value="OK" /></div></div></form>
	