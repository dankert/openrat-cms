<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		
			<form name="" target="_self" data-target="view" action="./" data-method="properties" data-action="element" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form element" data-async="" data-autosave=""><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="element" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="properties" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
				
					<?php $if5=(isset($subtype)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('ELEMENT_SUBTYPE')))); ?></span>
								
							</td>
							<td>
								<?php $if8=(isset($subtypes)); if($if8){?>
									<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_subtype" name="subtype" title="" class="" size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($subtypes,$subtype,1,0) ?><?php if (count($subtypes)==0) { ?><input type="hidden" name="subtype" value="" /><?php } ?><?php if (count($subtypes)==1) { ?><input type="hidden" name="subtype" value="<?php echo array_keys($subtypes)[0] ?>" /><?php } ?>
									</select></div>
								<?php } ?>
								<?php $if8=!(isset($subtypes)); if($if8){?>
									<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_subtype" name="<?php if ('') echo ''.'_' ?>subtype<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$subtype) ?>" /><?php if ('') { ?><input type="hidden" name="subtype" value="<?php $subtype ?>"/><?php } ?></div>
									
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
					<?php $if5=(isset($with_icon)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_WITH_ICON')))); ?></span>
								
							</td>
							<td>
								<?php { $tmpname     = 'with_icon';$default  = '';$readonly = '';$required = '';		
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
					<?php } ?>
					<?php $if5=(isset($all_languages)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_ALL_LANGUAGES')))); ?></span>
								
							</td>
							<td>
								<?php { $tmpname     = 'all_languages';$default  = '';$readonly = '';$required = '';		
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
					<?php } ?>
					<?php $if5=(isset($writable)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_writable')))); ?></span>
								
							</td>
							<td>
								<?php { $tmpname     = 'writable';$default  = '';$readonly = '';$required = '';		
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
					<?php } ?>
					<?php $if5=(isset($width)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('width')))); ?></span>
								
							</td>
							<td>
								<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_width" name="<?php if ('') echo ''.'_' ?>width<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$width) ?>" /><?php if ('') { ?><input type="hidden" name="width" value="<?php $width ?>"/><?php } ?></div>
								
							</td>
						</tr>
					<?php } ?>
					<?php $if5=(isset($height)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('height')))); ?></span>
								
							</td>
							<td>
								<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_height" name="<?php if ('') echo ''.'_' ?>height<?php if ('') echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$height) ?>" /><?php if ('') { ?><input type="hidden" name="height" value="<?php $height ?>"/><?php } ?></div>
								
							</td>
						</tr>
					<?php } ?>
					<?php $if5=(isset($dateformat)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DATEFORMAT')))); ?></span>
								
							</td>
							<td>
								<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_dateformat" name="dateformat" title="" class=""<?php if (count($dateformats)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($dateformats,$dateformat,0,0) ?><?php if (count($dateformats)==0) { ?><input type="hidden" name="dateformat" value="" /><?php } ?><?php if (count($dateformats)==1) { ?><input type="hidden" name="dateformat" value="<?php echo array_keys($dateformats)[0] ?>" /><?php } ?>
								</select></div>
							</td>
						</tr>
					<?php } ?>
					<?php $if5=(isset($format)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_FORMAT')))); ?></span>
								
							</td>
							<td>
								<?php include_once( 'modules/template-engine/components/html/radiobox/component-radio-box.php') ?><?php component_radio_box('format',$formatlist,$format) ?>
								
							</td>
						</tr>
					<?php } ?>
					<?php $if5=(isset($decimals)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DECIMALS')))); ?></span>
								
							</td>
							<td>
								<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_decimals" name="<?php if ('') echo ''.'_' ?>decimals<?php if ('') echo '_disabled' ?>" type="text" maxlength="2" class="" value="<?php echo Text::encodeHtml(@$decimals) ?>" /><?php if ('') { ?><input type="hidden" name="decimals" value="<?php $decimals ?>"/><?php } ?></div>
								
							</td>
						</tr>
					<?php } ?>
					<?php $if5=(isset($dec_point)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DEC_POINT')))); ?></span>
								
							</td>
							<td>
								<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_dec_point" name="<?php if ('') echo ''.'_' ?>dec_point<?php if ('') echo '_disabled' ?>" type="text" maxlength="5" class="" value="<?php echo Text::encodeHtml(@$dec_point) ?>" /><?php if ('') { ?><input type="hidden" name="dec_point" value="<?php $dec_point ?>"/><?php } ?></div>
								
							</td>
						</tr>
					<?php } ?>
					<?php $if5=(isset($thousand_sep)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_thousand_sep')))); ?></span>
								
							</td>
							<td>
								<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_thousand_sep" name="<?php if ('') echo ''.'_' ?>thousand_sep<?php if ('') echo '_disabled' ?>" type="text" maxlength="1" class="" value="<?php echo Text::encodeHtml(@$thousand_sep) ?>" /><?php if ('') { ?><input type="hidden" name="thousand_sep" value="<?php $thousand_sep ?>"/><?php } ?></div>
								
							</td>
						</tr>
					<?php } ?>
					<?php $if5=(isset($default_text)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_default_text')))); ?></span>
								
							</td>
							<td>
								<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_default_text" name="<?php if ('') echo ''.'_' ?>default_text<?php if ('') echo '_disabled' ?>" type="text" maxlength="255" class="" value="<?php echo Text::encodeHtml(@$default_text) ?>" /><?php if ('') { ?><input type="hidden" name="default_text" value="<?php $default_text ?>"/><?php } ?></div>
								
							</td>
						</tr>
					<?php } ?>
					<?php $if5=(isset($default_longtext)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_default_longtext')))); ?></span>
								
							</td>
							<td>
								<div class="inputholder"><textarea class="inputarea" name="<?php if ('') echo ''.'_' ?>default_longtext<?php if ('') echo '_disabled' ?>"><?php echo Text::encodeHtml($default_longtext) ?></textarea></div>
								
							</td>
						</tr>
					<?php } ?>
					<?php $if5=(isset($parameters)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DYNAMIC_PARAMETERS')))); ?></span>
								
							</td>
							<td>
								<div class="inputholder"><textarea class="inputarea" name="<?php if ('') echo ''.'_' ?>parameters<?php if ('') echo '_disabled' ?>"><?php echo Text::encodeHtml($parameters) ?></textarea></div>
								
							</td>
						</tr>
						<tr>
							<td>
							</td>
							<td>
								<?php foreach($dynamic_class_parameters as $paramName=>$defaultValue){ ?>
									<span><?php echo nl2br(encodeHtml(htmlentities($paramName))); ?></span>
									
									<span><?php echo nl2br('&nbsp;('); ?></span>
									
									<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_DEFAULT')))); ?></span>
									
									<span><?php echo nl2br(')&nbsp;=&nbsp;'); ?></span>
									
									<span><?php echo nl2br(encodeHtml(htmlentities($defaultValue))); ?></span>
									
									<br/>
									
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
					<?php $if5=(isset($select_items)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_select_items')))); ?></span>
								
							</td>
							<td>
								<div class="inputholder"><textarea class="inputarea" name="<?php if ('') echo ''.'_' ?>select_items<?php if ('') echo '_disabled' ?>"><?php echo Text::encodeHtml($select_items) ?></textarea></div>
								
							</td>
						</tr>
					<?php } ?>
					<?php $if5=(isset($linkelement)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_LINK')))); ?></span>
								
							</td>
							<td>
								<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_linkelement" name="linkelement" title="" class=""<?php if (count($linkelements)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($linkelements,$linkelement,0,0) ?><?php if (count($linkelements)==0) { ?><input type="hidden" name="linkelement" value="" /><?php } ?><?php if (count($linkelements)==1) { ?><input type="hidden" name="linkelement" value="<?php echo array_keys($linkelements)[0] ?>" /><?php } ?>
								</select></div>
							</td>
						</tr>
					<?php } ?>
					<?php $if5=(isset($name)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('ELEMENT_NAME')))); ?></span>
								
							</td>
							<td>
								<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_name" name="name" title="" class=""<?php if (count($names)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($names,$name,0,0) ?><?php if (count($names)==0) { ?><input type="hidden" name="name" value="" /><?php } ?><?php if (count($names)==1) { ?><input type="hidden" name="name" value="<?php echo array_keys($names)[0] ?>" /><?php } ?>
								</select></div>
							</td>
						</tr>
					<?php } ?>
					<?php $if5=(isset($folderobjectid)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DEFAULT_FOLDEROBJECT')))); ?></span>
								
							</td>
							<td>
								<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_folderobjectid" name="folderobjectid" title="" class=""<?php if (count($folders)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($folders,$folderobjectid,0,0) ?><?php if (count($folders)==0) { ?><input type="hidden" name="folderobjectid" value="" /><?php } ?><?php if (count($folders)==1) { ?><input type="hidden" name="folderobjectid" value="<?php echo array_keys($folders)[0] ?>" /><?php } ?>
								</select></div>
							</td>
						</tr>
					<?php } ?>
					<?php $if5=(isset($default_objectid)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DEFAULT_OBJECT')))); ?></span>
								
							</td>
							<td>
								<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_default_objectid" name="default_objectid" title="" class="" size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($objects,$default_objectid,1,0) ?><?php if (count($objects)==0) { ?><input type="hidden" name="default_objectid" value="" /><?php } ?><?php if (count($objects)==1) { ?><input type="hidden" name="default_objectid" value="<?php echo array_keys($objects)[0] ?>" /><?php } ?>
								</select></div>
							</td>
						</tr>
					<?php } ?>
					<?php $if5=(isset($code)); if($if5){?>
						<tr>
							<td>
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_code')))); ?></span>
								
							</td>
							<td>
								<div class="inputholder"><textarea class="inputarea" name="<?php if ('') echo ''.'_' ?>code<?php if ('') echo '_disabled' ?>"><?php echo Text::encodeHtml($code) ?></textarea></div>
								
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
				
			<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="?BUTTON_OK?" /></div></form>
			
			
		
	