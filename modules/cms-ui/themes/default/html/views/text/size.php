
	
		<form name="" target="_self" data-target="view" action="./" data-method="size" data-action="text" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form text" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="text" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="size" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<div class="line">
				<div class="label">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang('IMAGE_OLD_SIZE')))); ?></span>
					
				</div>
				<div class="input">
					<span><?php echo nl2br(encodeHtml(htmlentities($width))); ?></span>
					
					<span><?php echo nl2br('&nbsp;*&nbsp;'); ?></span>
					
					<span><?php echo nl2br(encodeHtml(htmlentities($height))); ?></span>
					
				</div>
			</div>
			<?php $if3=!(($formats)==FALSE); if($if3){?>
				<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('IMAGE_NEW_SIZE') ?></legend><div class="closable">
					<div class="line">
						<div class="label">
						</div>
						<div class="input">
							<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_type_factor" name="<?php if ('') echo ''.'_' ?>type<?php if ('') echo '_disabled' ?>" value="factor"<?php if('factor'==@$type)echo ' checked="checked"' ?> />
							
							<label for="<?php echo REQUEST_ID ?>_type_factor" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('FILE_IMAGE_SIZE_FACTOR')))); ?></span>
								
							</label>
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_factor" name="factor" title="" class=""<?php if (count($factors)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($factors,$factor,0,0) ?><?php if (count($factors)==0) { ?><input type="hidden" name="factor" value="" /><?php } ?><?php if (count($factors)==1) { ?><input type="hidden" name="factor" value="<?php echo array_keys($factors)[0] ?>" /><?php } ?>
							</select></div>
							<?php $factor= '1'; ?>
							
						</div>
					</div>
					<div class="line">
						<div class="label">
						</div>
						<div class="input">
							<input  class="" type="radio" id="<?php echo REQUEST_ID ?>_type_input" name="<?php if ('') echo ''.'_' ?>type<?php if ('') echo '_disabled' ?>" value="input"<?php if('input'==@$type)echo ' checked="checked"' ?> />
							
							<label for="<?php echo REQUEST_ID ?>_type_input" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('FILE_IMAGE_NEW_WIDTH_HEIGHT')))); ?></span>
								
							</label>
						</div>
						<div class="label">
						</div>
						<div class="input">
							<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_width" name="<?php if ('') echo ''.'_' ?>width<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$width) ?>" /><?php if ('') { ?><input type="hidden" name="width" value="<?php $width ?>"/><?php } ?></div>
							
							<span><?php echo nl2br('&nbsp;*&nbsp;'); ?></span>
							
							<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_height" name="<?php if ('') echo ''.'_' ?>height<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$height) ?>" /><?php if ('') { ?><input type="hidden" name="height" value="<?php $height ?>"/><?php } ?></div>
							
						</div>
					</div>
				</div></fieldset>
				<fieldset class="toggle-open-close<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><legend class="on-click-open-close"><div class="arrow arrow-right on-closed"></div><div class="arrow arrow-down on-open"></div><?php echo lang('options') ?></legend><div class="closable">
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_format" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('FILE_IMAGE_FORMAT')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_format" name="format" title="" class=""<?php if (count($formats)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($formats,$format,0,0) ?><?php if (count($formats)==0) { ?><input type="hidden" name="format" value="" /><?php } ?><?php if (count($formats)==1) { ?><input type="hidden" name="format" value="<?php echo array_keys($formats)[0] ?>" /><?php } ?>
							</select></div>
						</div>
					</div>
					<div class="line">
						<div class="label">
							<label for="<?php echo REQUEST_ID ?>_jpeglist_compression" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('FILE_IMAGE_JPEG_COMPRESSION')))); ?></span>
								
							</label>
						</div>
						<div class="input">
							<?php $jpeg_compression= '70'; ?>
							
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_jpeg_compression" name="jpeg_compression" title="" class=""<?php if (count($jpeglist)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($jpeglist,$jpeg_compression,0,0) ?><?php if (count($jpeglist)==0) { ?><input type="hidden" name="jpeg_compression" value="" /><?php } ?><?php if (count($jpeglist)==1) { ?><input type="hidden" name="jpeg_compression" value="<?php echo array_keys($jpeglist)[0] ?>" /><?php } ?>
							</select></div>
						</div>
					</div>
					<div class="line">
						<div class="label">
						</div>
						<div class="input">
							<?php { $tmpname     = 'copy';$default  = '';$readonly = '';$required = '';		
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
							
							<label for="<?php echo REQUEST_ID ?>_copy" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'copy'.'')))); ?></span>
								
							</label>
						</div>
					</div>
				</div></fieldset>
			<?php } ?>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="?BUTTON_OK?" /></div></form>
	