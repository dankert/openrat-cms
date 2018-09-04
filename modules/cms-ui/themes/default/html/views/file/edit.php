
	
		<form name="" target="_self" data-target="view" action="./" data-method="edit" data-action="file" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="file" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="languageid" value="<?php echo $languageid ?>" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="file" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="edit" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			
			
			<div class="label">
			</div>
			<div class="line">
				<div class="input">
					<br/>
					
					<input size="40" id="req15357454222035477865_file" type="file" name="file" class="upload"  />
					
					<br/>
					
					<br/>
					
				</div>
			</div>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('settings') ?></legend><div>
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
	