<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
	<form name="" target="_self" data-target="view" action="./" data-method="remove" data-action="model" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" class="or-form model" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="model" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="remove" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
		<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><div class="closable">
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NAME')))); ?></span>
				</div>
				<div class="input">
					<span class="name"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
				</div>
			</div>
		</div></fieldset>
		<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div class="closable">
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<?php { $tmpname     = 'confirm';$default  = false;$readonly = false;$required = true;		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1"<?php if( $checked ) echo ' checked="checked"' ?><?php if( $required ) echo ' required="required"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
					<label for="<?php echo REQUEST_ID ?>_confirm" class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('CONFIRM_DELETE')))); ?></span>
					</label>
				</div>
			</div>
		</div></fieldset>
	<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary or-form-btn--save" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>