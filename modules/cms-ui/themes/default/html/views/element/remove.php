<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="remove" data-action="element" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form element" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="element" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="remove" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><div class="closable">
				<div class="line">
					<div class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'ELEMENT_NAME'.'')))); ?></span>
						
					</div>
					<div class="input">
						<span class="name"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div class="closable">
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php { $tmpname     = 'confirm';$default  = '';$readonly = '';$required = '1';		
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
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<span><?php echo nl2br('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'); ?></span>
						
						<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_type_value" name="<?php if ('') echo ''.'_' ?>type<?php if ('') echo '_disabled' ?>" value="value"<?php if('value'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_value" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('ELEMENT_DELETE_VALUES')))); ?></span>
							
						</label>
						<br/>
						
						<span><?php echo nl2br('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'); ?></span>
						
						<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_type_all" name="<?php if ('') echo ''.'_' ?>type<?php if ('') echo '_disabled' ?>" value="all"<?php if('all'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_all" class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('DELETE')))); ?></span>
							
						</label>
					</div>
				</div>
			</div></fieldset>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
	