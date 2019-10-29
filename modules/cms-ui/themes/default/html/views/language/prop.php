<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="prop" data-action="language" data-id="<?php echo OR_ID ?>" method="post" enctype="application/x-www-form-urlencoded" class="or-form language" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="language" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="prop" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NAME')))); ?></span>
					
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_name" name="<?php if ('') echo ''.'_' ?>name<?php if (false) echo '_disabled' ?>" type="text" maxlength="50" class="focus" value="<?php echo Text::encodeHtml(@$name) ?>" /><?php if (false) { ?><input type="hidden" name="name" value="<?php $name ?>"/><?php } ?></div>
					
				</div>
			</div>
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('LANGUAGE_ISOCODE')))); ?></span>
					
				</div>
				<div class="input">
					<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_isocode" name="<?php if ('') echo ''.'_' ?>isocode<?php if (false) echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$isocode) ?>" /><?php if (false) { ?><input type="hidden" name="isocode" value="<?php $isocode ?>"/><?php } ?></div>
					
				</div>
			</div>
			<div class="line">
				<div class="label">
				</div>
				<div class="input">
					<?php { $tmpname     = 'is_default';$default  = false;$readonly = $is_default;$required = false;		
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
					
					<label for="<?php echo REQUEST_ID ?>_is_default" class="label"><?php echo lang('GLOBAL_is_default') ?>
					</label>
				</div>
			</div>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
	