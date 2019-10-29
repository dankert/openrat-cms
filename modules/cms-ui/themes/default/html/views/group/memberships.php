<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<form name="" target="_self" data-target="view" action="./" data-method="memberships" data-action="group" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form group" data-async="false" data-autosave="true"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="group" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="memberships" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
				<tr class="headline">
					<td width="10%">
					</td>
					<td>
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'name'.'')))); ?></span>
						
					</td>
				</tr>
				<?php foreach($memberships as $list_key=>$list_value){ ?><?php extract($list_value) ?>
					<tr class="data">
						<td>
							<?php { $tmpname     = $var;$default  = false;$readonly = false;$required = false;		
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
						<td>
							<label for="<?php echo REQUEST_ID ?>_<?php echo $var ?>" class="label">
								<i class="image-icon image-icon--action-user"></i>
								
								<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
								
							</label>
						</td>
					</tr>
				<?php } ?>
			</table></div></div>
			<tr>
				<td colspan="2" class="act">
							<div class="invisible"><input type="submit" 	name="ok" class="%class%"
	title="?button_ok_DESC?"
	value="&nbsp;&nbsp;&nbsp;&nbsp;?button_ok?&nbsp;&nbsp;&nbsp;&nbsp;" />	
					</div>
				</td>
			</tr>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
	