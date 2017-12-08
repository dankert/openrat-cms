
	
		<form name="" target="_self" action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="<?php echo OR_METHOD ?>" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave="" onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('global_prop') ?></legend><div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_name" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_name')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_name" name="name<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="name,focus" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if ('') { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
						
					</div>
				</div>
				<div class="line">
					<div class="label">
						<label for="<?php echo REQUEST_ID ?>_description" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_description')))); ?></span>
							
						</label>
					</div>
					<div class="input">
						<div class="inputholder"><textarea class="description" name="description"><?php echo Text::encodeHtml($description) ?></textarea></div>
						
					</div>
				</div>
			</div></fieldset>
		
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>

	