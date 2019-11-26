<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
		<form name="" target="_self" data-target="view" action="./" data-method="remove" data-action="image" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form image" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="image" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="remove" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
				<tr>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NAME')))); ?></span>
					</td>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
					</td>
				</tr>
				<tr>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_DELETE')))); ?></span>
					</td>
					<td>
						<?php { $tmpname     = 'delete';$default  = false;$readonly = false;$required = false;		
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
					</td>
				</tr>
				<tr>
					<td colspan="2">
								<div class="invisible"><input type="submit" 	name="ok" class="%class%"
	title="?button_ok_DESC?"
	value="&nbsp;&nbsp;&nbsp;&nbsp;?button_ok?&nbsp;&nbsp;&nbsp;&nbsp;" />	
						</div>
					</td>
				</tr>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary or-form-btn--save" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>