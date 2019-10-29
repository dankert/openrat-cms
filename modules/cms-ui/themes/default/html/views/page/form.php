<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		
			<form name="" target="_self" data-target="view" action="./" data-method="form" data-action="page" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form page" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="page" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="form" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
				
					<div class="or-table-wrapper"><div class="or-table-filter"><input type="search" name="filter" placeholder="<?php echo lang('SEARCH_FILTER') ?>" /></div><div class="or-table-area"><table width="100%">
						<?php $if6=(($el)==FALSE); if($if6){?>
							<tr>
								<td colspan="4">
									<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_NOT_FOUND')))); ?></span>
									
								</td>
							</tr>
						<?php } ?>
						<?php $if6=!(($el)==FALSE); if($if6){?>
							<tr>
								<td class="help">
									<span><?php echo nl2br(encodeHtml(htmlentities(lang('PAGE_ELEMENT_NAME')))); ?></span>
									
								</td>
								<td class="help">
									<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_CHANGE')))); ?></span>
									
								</td>
								<td class="help">
									<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_VALUE')))); ?></span>
									
								</td>
							</tr>
							<?php foreach($el as $list_key=>$list_value){ ?><?php extract($list_value) ?>
								<tr class="data">
									<td>
										<label for="<?php echo REQUEST_ID ?>_<?php echo $saveid ?>" class="label">
											<i class="image-icon image-icon--action-el_<?php echo $type ?>"></i>
											
											<span><?php echo nl2br(encodeHtml(htmlentities($name))); ?></span>
											
										</label>
									</td>
									<td>
										<?php { $tmpname     = $saveid;$default  = false;$readonly = false;$required = false;		
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
										<?php $if10=(in_array($type,explode(",",'text,date,number')); if($if10){?>
											<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_<?php echo $id ?>" name="<?php if ('') echo ''.'_' ?><?php echo $id ?><?php if (false) echo '_disabled' ?>" type="text" maxlength="255" class="" value="<?php echo Text::encodeHtml($value) ?>" /><?php if (false) { ?><input type="hidden" name="<?php echo $id ?>" value="<?php $value ?>"/><?php } ?></div>
											
										<?php } ?>
										<?php $if10=($type=='longtext'); if($if10){?>
											<div class="inputholder"><textarea class="inputarea" name="<?php if ('') echo ''.'_' ?><?php echo $id ?><?php if (false) echo '_disabled' ?>"><?php echo Text::encodeHtml($value) ?></textarea></div>
											
										<?php } ?>
										<?php $if10=(in_array($type,explode(",",'select,link,list')); if($if10){?>
											<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_<?php echo $id ?>" name="<?php echo $id ?>" title="" class=""<?php if (count($list)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($list,$value,0,0) ?><?php if (count($list)==0) { ?><input type="hidden" name="<?php echo $id ?>" value="" /><?php } ?><?php if (count($list)==1) { ?><input type="hidden" name="<?php echo $id ?>" value="<?php echo array_keys($list)[0] ?>" /><?php } ?>
											</select></div>
										<?php } ?>
									</td>
								</tr>
							<?php } ?>
						<?php } ?>
					</table></div></div>
					<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div class="closable">
						<?php $if6=(isset($release)); if($if6){?>
							<div>
								<?php { $tmpname     = 'release';$default  = false;$readonly = false;$required = false;		
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
								
								<label for="<?php echo REQUEST_ID ?>_release" class="label">
									<span><?php echo nl2br('&nbsp;'); ?></span>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_RELEASE')))); ?></span>
									
								</label>
							</div>
						<?php } ?>
						<?php $if6=(isset($publish)); if($if6){?>
							<div>
								<?php { $tmpname     = 'publish';$default  = false;$readonly = false;$required = false;		
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
								
								<label for="<?php echo REQUEST_ID ?>_publish" class="label">
									<span><?php echo nl2br('&nbsp;'); ?></span>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang('PAGE_PUBLISH_AFTER_SAVE')))); ?></span>
									
								</label>
							</div>
						<?php } ?>
					</div></fieldset>
							<div class="invisible"><input type="submit" 	name="ok" class="%class%"
	title="?button_ok_DESC?"
	value="&nbsp;&nbsp;&nbsp;&nbsp;?button_ok?&nbsp;&nbsp;&nbsp;&nbsp;" />	
					</div>
				
			<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
		
	