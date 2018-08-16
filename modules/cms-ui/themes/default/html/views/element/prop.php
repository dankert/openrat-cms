
	
		
		
		<?php $if2=(config('security','disable_dynamic_code')); if($if2){?>
			<?php $if3=(!'1'); if($if3){?>
				<div class="message warn">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'NOTICE_CODE_DISABLED'.'')))); ?></span>
					
				</div>
			<?php } ?>
		<?php } ?>
		<form name="" target="_self" data-target="view" action="./" data-method="<?php echo OR_METHOD ?>" data-action="<?php echo OR_ACTION ?>" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="<?php echo OR_ACTION ?>" data-async="1" data-autosave=""><input type="submit" class="invisible" /><input type="hidden" name="<?php echo REQ_PARAM_EMBED ?>" value="1" /><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="<?php echo '1'?" open":" closed" ?><?php echo '1'?" show":"" ?>"><div>
				<?php $if4=(!empty($subtype)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('ELEMENT_SUBTYPE')))); ?></span>
							
						</div>
						<div class="input">
							<?php $if7=(!empty($subtypes)); if($if7){?>
								<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_subtype" name="subtype" title="" class=""<?php if (count($subtypes)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($subtypes,$subtype,1,0) ?><?php if (count($subtypes)==0) { ?><input type="hidden" name="subtype" value="" /><?php } ?><?php if (count($subtypes)==1) { ?><input type="hidden" name="subtype" value="<?php echo array_keys($subtypes)[0] ?>" /><?php } ?>
								</select></div>
							<?php } ?>
							<?php $if7=!(!empty($subtypes)); if($if7){?>
								<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_subtype" name="subtype<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$subtype) ?>" /><?php if ('') { ?><input type="hidden" name="subtype" value="<?php $subtype ?>"/><?php } ?></div>
								
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($with_icon)); if($if4){?>
					<div class="line">
						<div class="label">
						</div>
						<div class="input">
							<?php { $tmpname     = 'with_icon';$default  = '';$readonly = '';		
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
							
							<label for="<?php echo REQUEST_ID ?>_with_icon" class="label">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_WITH_ICON')))); ?></span>
								
							</label>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($all_languages)); if($if4){?>
					<div class="line">
						<div class="label">
						</div>
						<div class="input">
							<?php { $tmpname     = 'all_languages';$default  = '';$readonly = '';		
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
							
							<label for="<?php echo REQUEST_ID ?>_all_languages" class="label">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_ALL_LANGUAGES')))); ?></span>
								
							</label>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($writable)); if($if4){?>
					<div class="line">
						<div class="label">
						</div>
						<div class="input">
							<?php { $tmpname     = 'writable';$default  = '';$readonly = '';		
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
							
							<label for="<?php echo REQUEST_ID ?>_writable" class="label">
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_writable')))); ?></span>
								
							</label>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($width)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('width')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_width" name="width<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$width) ?>" /><?php if ('') { ?><input type="hidden" name="width" value="<?php $width ?>"/><?php } ?></div>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($height)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('height')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_height" name="height<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="text" value="<?php echo Text::encodeHtml(@$height) ?>" /><?php if ('') { ?><input type="hidden" name="height" value="<?php $height ?>"/><?php } ?></div>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($dateformat)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DATEFORMAT')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_dateformat" name="dateformat" title="" class=""<?php if (count($dateformats)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($dateformats,$dateformat,0,0) ?><?php if (count($dateformats)==0) { ?><input type="hidden" name="dateformat" value="" /><?php } ?><?php if (count($dateformats)==1) { ?><input type="hidden" name="dateformat" value="<?php echo array_keys($dateformats)[0] ?>" /><?php } ?>
							</select></div>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($format)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_FORMAT')))); ?></span>
							
						</div>
						<div class="input">
							<?php include_once( 'modules/template-engine/components/html/radiobox/component-radio-box.php') ?><?php component_radio_box('format',$formatlist,$format) ?>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($decimals)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DECIMALS')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_decimals" name="decimals<?php if ('') echo '_disabled' ?>" type="text" maxlength="2" class="text" value="<?php echo Text::encodeHtml(@$decimals) ?>" /><?php if ('') { ?><input type="hidden" name="decimals" value="<?php $decimals ?>"/><?php } ?></div>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($dec_point)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DEC_POINT')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_dec_point" name="dec_point<?php if ('') echo '_disabled' ?>" type="text" maxlength="5" class="text" value="<?php echo Text::encodeHtml(@$dec_point) ?>" /><?php if ('') { ?><input type="hidden" name="dec_point" value="<?php $dec_point ?>"/><?php } ?></div>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($thousand_sep)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_thousand_sep')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_thousand_sep" name="thousand_sep<?php if ('') echo '_disabled' ?>" type="text" maxlength="1" class="text" value="<?php echo Text::encodeHtml(@$thousand_sep) ?>" /><?php if ('') { ?><input type="hidden" name="thousand_sep" value="<?php $thousand_sep ?>"/><?php } ?></div>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($default_text)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_default_text')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><input<?php if ('') echo ' disabled="true"' ?> id="<?php echo REQUEST_ID ?>_default_text" name="default_text<?php if ('') echo '_disabled' ?>" type="text" maxlength="255" class="text" value="<?php echo Text::encodeHtml(@$default_text) ?>" /><?php if ('') { ?><input type="hidden" name="default_text" value="<?php $default_text ?>"/><?php } ?></div>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($default_longtext)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_default_longtext')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><textarea class="inputarea" name="default_longtext"><?php echo Text::encodeHtml($default_longtext) ?></textarea></div>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($parameters)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DYNAMIC_PARAMETERS')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><textarea class="inputarea" name="parameters"><?php echo Text::encodeHtml($parameters) ?></textarea></div>
							
						</div>
					</div>
					<div class="line">
						<div class="label">
						</div>
						<div class="input">
							<?php foreach($dynamic_class_parameters as $paramName=>$defaultValue){ ?>
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities($paramName))); ?></span>
								
								<span class="text"><?php echo nl2br('&nbsp;('); ?></span>
								
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_DEFAULT')))); ?></span>
								
								<span class="text"><?php echo nl2br(')&nbsp;=&nbsp;'); ?></span>
								
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities($defaultValue))); ?></span>
								
								<br/>
								
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($select_items)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_select_items')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><textarea class="inputarea" name="select_items"><?php echo Text::encodeHtml($select_items) ?></textarea></div>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($linkelement)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_LINK')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_linkelement" name="linkelement" title="" class=""<?php if (count($linkelements)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($linkelements,$linkelement,0,0) ?><?php if (count($linkelements)==0) { ?><input type="hidden" name="linkelement" value="" /><?php } ?><?php if (count($linkelements)==1) { ?><input type="hidden" name="linkelement" value="<?php echo array_keys($linkelements)[0] ?>" /><?php } ?>
							</select></div>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($name)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('ELEMENT_NAME')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_name" name="name" title="" class=""<?php if (count($names)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($names,$name,0,0) ?><?php if (count($names)==0) { ?><input type="hidden" name="name" value="" /><?php } ?><?php if (count($names)==1) { ?><input type="hidden" name="name" value="<?php echo array_keys($names)[0] ?>" /><?php } ?>
							</select></div>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($folderobjectid)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DEFAULT_FOLDEROBJECT')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_folderobjectid" name="folderobjectid" title="" class=""<?php if (count($folders)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($folders,$folderobjectid,0,0) ?><?php if (count($folders)==0) { ?><input type="hidden" name="folderobjectid" value="" /><?php } ?><?php if (count($folders)==1) { ?><input type="hidden" name="folderobjectid" value="<?php echo array_keys($folders)[0] ?>" /><?php } ?>
							</select></div>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($default_objectid)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DEFAULT_OBJECT')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_default_objectid" name="default_objectid" title="" class=""<?php if (count($objects)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($objects,$default_objectid,1,0) ?><?php if (count($objects)==0) { ?><input type="hidden" name="default_objectid" value="" /><?php } ?><?php if (count($objects)==1) { ?><input type="hidden" name="default_objectid" value="<?php echo array_keys($objects)[0] ?>" /><?php } ?>
							</select></div>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($code)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_code')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><textarea class="inputarea" name="code"><?php echo Text::encodeHtml($code) ?></textarea></div>
							
						</div>
					</div>
				<?php } ?>
			</div></fieldset>
		<div class="bottom"><div class="command "><input type="submit" class="submit ok" value="OK" /></div></div></form>
	