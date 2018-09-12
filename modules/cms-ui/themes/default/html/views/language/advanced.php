
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="advanced" data-action="language" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" class="language" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="language" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="advanced" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NAME')))); ?></span>
					
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_name" name="name<?php if ('') echo '_disabled' ?>" type="text" maxlength="50" class="focus" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
					
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('LANGUAGE_ISOCODE')))); ?></span>
					
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_isocode" name="isocode<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$isocode) ?>" /><?php if ('') { ?><input type="hidden" name="isocode" value="<?php $isocode ?>"/><?php } ?></div>
					
				</div>
			</div>
		<div class="bottom"><div class="command "><input type="submit" class="submit ok" value="OK" /></div></div></form>
	