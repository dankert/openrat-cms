
	
		<form name="" target="_self" action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave="" onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="headermenu"><div class="toolbar-icon clickable"><a href="javascript:void(0);" title="<?php echo lang('MENU_VALUE') ?>" data-type="dialog" data-name="<?php echo lang('MENU_VALUE') ?>" data-method="value"><img src="./themes/default/images/icon/action/value.svg" title="<?php echo lang('MENU_value_DESC') ?>" /><?php echo lang('MENU_value') ?></a></div></div>
			
			<div class="label">
			</div>
			<div class="line">
				<div class="input">
					<br/>
					
					<input size="40" id="req15145078411938795353_file" type="file" name="file" class="upload"  />
					
					<br/>
					
					<br/>
					
				</div>
			</div>
		<div class="bottom"><div class="command "><input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " /></div></div></form>
	