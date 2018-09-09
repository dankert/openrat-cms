
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="page" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="page" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="languageid" value="<?php echo $languageid ?>" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="page" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="prop" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_name" class="label">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('global_name')))); ?></span>
						
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_name" name="name<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="name" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
					
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_filename" class="label">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('global_filename')))); ?></span>
						
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_filename" name="filename<?php if ('') echo '_disabled' ?>" type="text" maxlength="150" class="filename" value="<?php echo Text::encodeHtml(@$filename) ?>" /><?php if ('') { ?><input type="hidden" name="filename" value="<?php $filename ?>"/><?php } ?></div>
					
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
			
				<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('validity') ?></legend><div>
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_validity_from_date" class="label">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'from'.'')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_valid_from_date" name="valid_from_date<?php if ('') echo '_disabled' ?>" type="date" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$valid_from_date) ?>" /><?php if ('') { ?><input type="hidden" name="valid_from_date" value="<?php $valid_from_date ?>"/><?php } ?></div>
							
							<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_valid_from_time" name="valid_from_time<?php if ('') echo '_disabled' ?>" type="time" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$valid_from_time) ?>" /><?php if ('') { ?><input type="hidden" name="valid_from_time" value="<?php $valid_from_time ?>"/><?php } ?></div>
							
						</div>
					</div>
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_validity_until_date" class="label">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'until'.'')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_valid_until_date" name="valid_until_date<?php if ('') echo '_disabled' ?>" type="date" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$valid_until_date) ?>" /><?php if ('') { ?><input type="hidden" name="valid_until_date" value="<?php $valid_until_date ?>"/><?php } ?></div>
							
							<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_valid_until_time" name="valid_until_time<?php if ('') echo '_disabled' ?>" type="time" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$valid_until_time) ?>" /><?php if ('') { ?><input type="hidden" name="valid_until_time" value="<?php $valid_until_time ?>"/><?php } ?></div>
							
						</div>
					</div>
				</div></fieldset>
			
		<div class="bottom"><div class="command "><input type="submit" class="submit ok" value="OK" /></div></div></form>
	