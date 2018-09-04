
	
		
		
		<form name="" target="_self" data-target="view" action="./" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><div>
				<div class="line">
					<div class="label">
						<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'ELEMENT_NAME'.'')))); ?></span>
						
					</div>
					<div class="input">
						<span class="name"><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
						
					</div>
				</div>
			</div></fieldset>
			<fieldset class="<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<?php { $tmpname     = 'confirm';$default  = '';$readonly = '';		
		if	( isset($$tmpname) )
			$checked = $$tmpname;
		else
			$checked = $default;

		?><input class="checkbox" type="checkbox" id="<?php echo REQUEST_ID ?>_<?php echo $tmpname ?>" name="<?php echo $tmpname  ?>"  <?php if ($readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php

		if ( $readonly && $checked )
		{ 
		?><input type="hidden" name="<?php echo $tmpname ?>" value="1" /><?php
		}
		} ?>
						
						<label for="<?php echo REQUEST_ID ?>_confirm" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('CONFIRM_DELETE')))); ?></span>
							
						</label>
					</div>
				</div>
				<div class="line">
					<div class="label">
					</div>
					<div class="input">
						<span class="text"><?php echo nl2br('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'); ?></span>
						
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_value" name="type" value="value"<?php if('value'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_value" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('ELEMENT_DELETE_VALUES')))); ?></span>
							
						</label>
						<br/>
						
						<span class="text"><?php echo nl2br('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'); ?></span>
						
						<input  class="radio" type="radio" id="<?php echo REQUEST_ID ?>_type_all" name="type" value="all"<?php if('all'==@$type)echo ' checked="checked"' ?> />
						
						<label for="<?php echo REQUEST_ID ?>_type_all" class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('DELETE')))); ?></span>
							
						</label>
					</div>
				</div>
			</div></fieldset>
		<div class="bottom"><div class="command "><input type="submit" class="submit ok" value="OK" /></div></div></form>
	