
	
		
			<form name="" target="_self" action="<?php echo OR_ACTION ?>" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
				
					<tr>
						<td colspan="2" class="help">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities($desc))); ?></span>
							
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_linkobjectid" name="linkobjectid" title="" class=""<?php if (count($objects)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($objects,$linkobjectid,0,0) ?><?php if (count($objects)==0) { ?><input type="hidden" name="linkobjectid" value="" /><?php } ?><?php if (count($objects)==1) { ?><input type="hidden" name="linkobjectid" value="<?php echo array_keys($objects)[0] ?>" /><?php } ?>
							</select></div>
						</td>
					</tr>
					<?php $if5=(!empty($release)); if($if5){?>
						<?php $if6=(!empty($publish)); if($if6){?>
							<tr>
								<td colspan="2">
									<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><legend><div class="arrow-right closed" /><div class="arrow-down open" /><?php echo lang('options') ?></legend><div>
									</div></fieldset>
								</td>
							</tr>
						<?php } ?>
					<?php } ?>
					<?php $if5=(!empty($release)); if($if5){?>
						<tr>
							<td colspan="2">
								<?php { $tmpname     = 'release';$default  = '';$readonly = '';		
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
								
								<label for="<?php echo REQUEST_ID ?>_release" class="label">
									<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_RELEASE')))); ?></span>
									
								</label>
							</td>
						</tr>
					<?php } ?>
					<?php $if5=(!empty($publish)); if($if5){?>
						<tr>
							<td colspan="2">
								<?php { $tmpname     = 'publish';$default  = '';$readonly = '';		
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
								
								<label for="<?php echo REQUEST_ID ?>_publish" class="label">
									<span class="text"><?php echo nl2br('&nbsp;'); ?></span>
									
									<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('PAGE_PUBLISH_AFTER_SAVE')))); ?></span>
									
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
				
			<div class="bottom"><div class="command "><input type="button" class="submit ok" value="OK" /></div></div></form>
			
			
		
	