
	
		<form name="" target="_self" data-target="view" action="./" data-method="add" data-action="userlist" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" class="userlist" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="userlist" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="add" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_name" class="label"><?php echo lang('user_username') ?>
					</label>
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_name" name="name<?php if ('') echo '_disabled' ?>" type="text" maxlength="128" class="focus" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
					
				</div>
			</div>
		<div class="bottom"><div class="command "><input type="submit" class="submit ok" value="OK" /></div></div></form>
	