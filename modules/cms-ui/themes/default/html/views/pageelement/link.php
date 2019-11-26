<?php if (!defined('OR_TITLE')) die('Forbidden'); ?>
		<form name="" target="_self" data-target="view" action="./" data-method="link" data-action="pageelement" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form pageelement" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="pageelement" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="link" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
				<tr>
					<td colspan="2" class="help">
						<span><?php echo nl2br(encodeHtml(htmlentities($desc))); ?></span>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_linkobjectid" name="linkobjectid" title="" class=""<?php if (count($objects)<=1) echo ' disabled="disabled"'; ?> size="1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($objects,$linkobjectid,0,0) ?><?php if (count($objects)==0) { ?><input type="hidden" name="linkobjectid" value="" /><?php } ?><?php if (count($objects)==1) { ?><input type="hidden" name="linkobjectid" value="<?php echo array_keys($objects)[0] ?>" /><?php } ?>
						</select></div>
					</td>
				</tr>
				<?php $if5=(isset($release)); if($if5){?>
					<?php $if6=(isset($publish)); if($if6){?>
						<tr>
							<td colspan="2">
								<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div class="closable">
								</div></fieldset>
							</td>
						</tr>
					<?php } ?>
				<?php } ?>
				<?php $if5=(isset($release)); if($if5){?>
					<tr>
						<td colspan="2">
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
						</td>
					</tr>
				<?php } ?>
				<?php $if5=(isset($publish)); if($if5){?>
					<tr>
						<td colspan="2">
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
						</td>
					</tr>
				<?php } ?>
				<tr>
					<td colspan="2" class="act">
								<div class="invisible"><input type="submit" 	name="ok" class="%class%"
	title="?button_ok_DESC?"
	value="&nbsp;&nbsp;&nbsp;&nbsp;?button_ok?&nbsp;&nbsp;&nbsp;&nbsp;" />	
						</div>
					</td>
				</tr>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary or-form-btn--save" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>