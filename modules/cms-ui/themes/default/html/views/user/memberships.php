
	
		<form name="" target="_self" data-target="view" action="./" data-method="memberships" data-action="user" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form user" data-async="" data-autosave="1"><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="user" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="memberships" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="table-wrapper"><div class="table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><table width="100%"></div>
				<tr class="headline">
					<td colspan="2">
						<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'group'.'')))); ?></span>
						
					</td>
				</tr>
				<?php foreach($memberships as $list_key=>$list_value){ ?><?php extract($list_value) ?>
					<tr class="data">
						<td width="10%">
							<?php { $tmpname     = $var;$default  = '';$readonly = '';$required = '';		
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
								<img src="./modules/cms-ui/themes/default/images/icon/icon_group.png" />
								
								<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
								
							</label>
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td colspan="2" class="act">
								<div class="invisible"><input type="submit" 	name="ok" class="%class%"
	title="Bestätigen"
	value="&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;" />	
						</div>
					</td>
				</tr>
			</table>
		<div class="or-form-actionbar"><input type="submit" class="or-form-btn or-form-btn--primary" value="OK" /></div></form>
	