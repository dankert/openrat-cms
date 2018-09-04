
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="page" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="page" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="page" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="prop" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_name" class="label">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('global_name')))); ?></span>
						
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_name" name="name<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="name" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
					
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_filename" class="label">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('global_filename')))); ?></span>
						
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_filename" name="filename<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="filename" value="<?php echo Text::encodeHtml(@$filename) ?>" /><?php if ('') { ?><input type="hidden" name="filename" value="<?php $filename ?>"/><?php } ?></div>
					
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_description" class="label">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('global_description')))); ?></span>
						
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><textarea class="description" name="description"><?php echo Text::encodeHtml($description) ?></textarea></div>
					
				</div>
			</div>
		<div class="bottom"><div class="command "><input type="submit" class="submit ok" value="OK" /></div></div></form>
	