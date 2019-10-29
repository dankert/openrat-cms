<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<form name="" target="_self" data-target="view" action="./" data-method="result" data-action="search" data-id="<?php echo OR_ID ?>" method="GET" enctype="application/x-www-form-urlencoded" class="or-form search" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="search" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="result" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_value" class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'value'.'')))); ?></span>
						
					</label>
					<br/>
					
				</div>
				<div class="input">
					<div class="inputholder"><input placeholder="<?php echo lang('search') ?>" id="<?php echo REQUEST_ID ?>_text" name="<?php if ('') echo ''.'_' ?>text<?php if (false) echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$text) ?>" /><?php if (false) { ?><input type="hidden" name="text" value="<?php $text ?>"/><?php } ?></div>
					
				</div>
			</div>
			<div class="line">
				<div class="label">
					<label for="<?php echo REQUEST_ID ?>_value" class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'filter'.'')))); ?></span>
						
					</label>
					<br/>
					
				</div>
				<div class="input">
					<?php { $tmpname     = 'id';$default  = config('search','quicksearch','flag','id');$readonly = false;$required = false;		
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
					
					<label for="<?php echo REQUEST_ID ?>_id" class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'id'.'')))); ?></span>
						
					</label>
					<br/>
					
					<?php { $tmpname     = 'name';$default  = config('search','quicksearch','flag','name');$readonly = false;$required = false;		
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
					
					<label for="<?php echo REQUEST_ID ?>_name" class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
						
					</label>
					<br/>
					
					<?php { $tmpname     = 'filename';$default  = config('search','quicksearch','flag','filename');$readonly = false;$required = false;		
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
					
					<label for="<?php echo REQUEST_ID ?>_filename" class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'filename'.'')))); ?></span>
						
					</label>
					<br/>
					
					<?php { $tmpname     = 'description';$default  = config('search','quicksearch','flag','description');$readonly = false;$required = false;		
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
					
					<label for="<?php echo REQUEST_ID ?>_description" class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'description'.'')))); ?></span>
						
					</label>
					<br/>
					
					<?php { $tmpname     = 'content';$default  = config('search','quicksearch','flag','content');$readonly = false;$required = false;		
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
					
					<label for="<?php echo REQUEST_ID ?>_content" class="label">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'content'.'')))); ?></span>
						
					</label>
				</div>
			</div>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
	