<?php if (!defined('OR_TITLE')) die('Forbidden'); ?> 
	
		<?php $if2=(config('security','disable_dynamic_code')); if($if2){?>
			<?php $if3=(!true); if($if3){?>
				<div class="message warn">
					<span><?php echo nl2br(encodeHtml(htmlentities(lang(''.'NOTICE_CODE_DISABLED'.'')))); ?></span>
					
				</div>
			<?php } ?>
		<?php } ?>
		<form name="" target="_self" data-target="view" action="./" data-method="advanced" data-action="element" data-id="<?php echo OR_ID ?>" method="POST" enctype="application/x-www-form-urlencoded" class="or-form element" data-async="false" data-autosave="false"><input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" /><input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="element" /><input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="advanced" /><input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
			<fieldset class="toggle-open-close<?php echo true?" open":" closed" ?><?php echo true?" show":"" ?>"><div class="closable">
				<?php $if4=(isset($subtype)); if($if4){?>
					<div class="line">
						<div class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('ELEMENT_SUBTYPE')))); ?></span>
							
						</div>
						<div class="input">
							<?php $if7=(isset($subtypes)); if($if7){?>
								<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_subtype" name="subtype" title="" class="" size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($subtypes,$subtype,1,0) ?><?php if (count($subtypes)==0) { ?><input type="hidden" name="subtype" value="" /><?php } ?><?php if (count($subtypes)==1) { ?><input type="hidden" name="subtype" value="<?php echo array_keys($subtypes)[0] ?>" /><?php } ?>
								</select></div>
							<?php } ?>
							<?php $if7=!(isset($subtypes)); if($if7){?>
								<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_subtype" name="<?php if ('') echo ''.'_' ?>subtype<?php if (false) echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$subtype) ?>" /><?php if (false) { ?><input type="hidden" name="subtype" value="<?php $subtype ?>"/><?php } ?></div>
								
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($with_icon)); if($if4){?>
					<div class="line">
						<div class="label">
						</div>
						<div class="input">
							<?php { $tmpname     = 'with_icon';$default  = false;$readonly = false;$required = false;		
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
							
							<label for="<?php echo REQUEST_ID ?>_with_icon" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_WITH_ICON')))); ?></span>
								
							</label>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($inherit)); if($if4){?>
					<div class="line">
						<div class="label">
						</div>
						<div class="input">
							<?php { $tmpname     = 'inherit';$default  = false;$readonly = false;$required = false;		
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
							
							<label for="<?php echo REQUEST_ID ?>_inherit" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_INHERIT')))); ?></span>
								
							</label>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($all_languages)); if($if4){?>
					<div class="line">
						<div class="label">
						</div>
						<div class="input">
							<?php { $tmpname     = 'all_languages';$default  = false;$readonly = false;$required = false;		
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
							
							<label for="<?php echo REQUEST_ID ?>_all_languages" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_ALL_LANGUAGES')))); ?></span>
								
							</label>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($writable)); if($if4){?>
					<div class="line">
						<div class="label">
						</div>
						<div class="input">
							<?php { $tmpname     = 'writable';$default  = false;$readonly = false;$required = false;		
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
							
							<label for="<?php echo REQUEST_ID ?>_writable" class="label">
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_writable')))); ?></span>
								
							</label>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($width)); if($if4){?>
					<div class="line">
						<div class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('width')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_width" name="<?php if ('') echo ''.'_' ?>width<?php if (false) echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$width) ?>" /><?php if (false) { ?><input type="hidden" name="width" value="<?php $width ?>"/><?php } ?></div>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($height)); if($if4){?>
					<div class="line">
						<div class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('height')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_height" name="<?php if ('') echo ''.'_' ?>height<?php if (false) echo '_disabled' ?>" type="text" maxlength="256" class="" value="<?php echo Text::encodeHtml(@$height) ?>" /><?php if (false) { ?><input type="hidden" name="height" value="<?php $height ?>"/><?php } ?></div>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($dateformat)); if($if4){?>
					<div class="line">
						<div class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DATEFORMAT')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_dateformat" name="dateformat" title="" class=""<?php if (count($dateformats)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($dateformats,$dateformat,0,0) ?><?php if (count($dateformats)==0) { ?><input type="hidden" name="dateformat" value="" /><?php } ?><?php if (count($dateformats)==1) { ?><input type="hidden" name="dateformat" value="<?php echo array_keys($dateformats)[0] ?>" /><?php } ?>
							</select></div>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($format)); if($if4){?>
					<div class="line">
						<div class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_FORMAT')))); ?></span>
							
						</div>
						<div class="input">
							<?php include_once( 'modules/template-engine/components/html/radiobox/component-radio-box.php') ?><?php component_radio_box('format',$formatlist,$format) ?>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($decimals)); if($if4){?>
					<div class="line">
						<div class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DECIMALS')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_decimals" name="<?php if ('') echo ''.'_' ?>decimals<?php if (false) echo '_disabled' ?>" type="text" maxlength="2" class="" value="<?php echo Text::encodeHtml(@$decimals) ?>" /><?php if (false) { ?><input type="hidden" name="decimals" value="<?php $decimals ?>"/><?php } ?></div>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($dec_point)); if($if4){?>
					<div class="line">
						<div class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DEC_POINT')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_dec_point" name="<?php if ('') echo ''.'_' ?>dec_point<?php if (false) echo '_disabled' ?>" type="text" maxlength="5" class="" value="<?php echo Text::encodeHtml(@$dec_point) ?>" /><?php if (false) { ?><input type="hidden" name="dec_point" value="<?php $dec_point ?>"/><?php } ?></div>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($thousand_sep)); if($if4){?>
					<div class="line">
						<div class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_thousand_sep')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_thousand_sep" name="<?php if ('') echo ''.'_' ?>thousand_sep<?php if (false) echo '_disabled' ?>" type="text" maxlength="1" class="" value="<?php echo Text::encodeHtml(@$thousand_sep) ?>" /><?php if (false) { ?><input type="hidden" name="thousand_sep" value="<?php $thousand_sep ?>"/><?php } ?></div>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($default_text)); if($if4){?>
					<div class="line">
						<div class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_default_text')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><input id="<?php echo REQUEST_ID ?>_default_text" name="<?php if ('') echo ''.'_' ?>default_text<?php if (false) echo '_disabled' ?>" type="text" maxlength="255" class="" value="<?php echo Text::encodeHtml(@$default_text) ?>" /><?php if (false) { ?><input type="hidden" name="default_text" value="<?php $default_text ?>"/><?php } ?></div>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($default_longtext)); if($if4){?>
					<div class="line">
						<div class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_default_longtext')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><textarea class="inputarea" name="<?php if ('') echo ''.'_' ?>default_longtext<?php if (false) echo '_disabled' ?>"><?php echo Text::encodeHtml($default_longtext) ?></textarea></div>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($parameters)); if($if4){?>
					<div class="line">
						<div class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DYNAMIC_PARAMETERS')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><textarea class="inputarea" name="<?php if ('') echo ''.'_' ?>parameters<?php if (false) echo '_disabled' ?>"><?php echo Text::encodeHtml($parameters) ?></textarea></div>
							
						</div>
					</div>
					<div class="line">
						<div class="label">
						</div>
						<div class="input">
							<?php foreach($dynamic_class_parameters as $paramName=>$defaultValue){ ?>
								<span><?php echo nl2br(encodeHtml(htmlentities($paramName))); ?></span>
								
								<span><?php echo nl2br('&nbsp;('); ?></span>
								
								<span><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_DEFAULT')))); ?></span>
								
								<span><?php echo nl2br(')&nbsp;=&nbsp;'); ?></span>
								
								<span><?php echo nl2br(encodeHtml(htmlentities($defaultValue))); ?></span>
								
								<br/>
								
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($select_items)); if($if4){?>
					<div class="line">
						<div class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_select_items')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><textarea class="inputarea" name="<?php if ('') echo ''.'_' ?>select_items<?php if (false) echo '_disabled' ?>"><?php echo Text::encodeHtml($select_items) ?></textarea></div>
							
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($linkelement)); if($if4){?>
					<div class="line">
						<div class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_LINK')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_linkelement" name="linkelement" title="" class=""<?php if (count($linkelements)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($linkelements,$linkelement,0,0) ?><?php if (count($linkelements)==0) { ?><input type="hidden" name="linkelement" value="" /><?php } ?><?php if (count($linkelements)==1) { ?><input type="hidden" name="linkelement" value="<?php echo array_keys($linkelements)[0] ?>" /><?php } ?>
							</select></div>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($name)); if($if4){?>
					<div class="line">
						<div class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('ELEMENT_NAME')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_name" name="name" title="" class=""<?php if (count($names)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($names,$name,0,0) ?><?php if (count($names)==0) { ?><input type="hidden" name="name" value="" /><?php } ?><?php if (count($names)==1) { ?><input type="hidden" name="name" value="<?php echo array_keys($names)[0] ?>" /><?php } ?>
							</select></div>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($folderobjectid)); if($if4){?>
					<div class="line">
						<div class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DEFAULT_FOLDEROBJECT')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_folderobjectid" name="folderobjectid" title="" class=""<?php if (count($folders)<=1) echo ' disabled="disabled"'; ?> size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($folders,$folderobjectid,0,0) ?><?php if (count($folders)==0) { ?><input type="hidden" name="folderobjectid" value="" /><?php } ?><?php if (count($folders)==1) { ?><input type="hidden" name="folderobjectid" value="<?php echo array_keys($folders)[0] ?>" /><?php } ?>
							</select></div>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($default_objectid)); if($if4){?>
					<div class="line">
						<div class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DEFAULT_OBJECT')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><select  id="<?php echo REQUEST_ID ?>_default_objectid" name="default_objectid" title="" class="" size=1"><?php include_once( 'modules/template-engine/components/html/selectbox/component-select-box.php') ?><?php component_select_option_list($objects,$default_objectid,1,0) ?><?php if (count($objects)==0) { ?><input type="hidden" name="default_objectid" value="" /><?php } ?><?php if (count($objects)==1) { ?><input type="hidden" name="default_objectid" value="<?php echo array_keys($objects)[0] ?>" /><?php } ?>
							</select></div>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(isset($code)); if($if4){?>
					<div class="line">
						<div class="label">
							<span><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_code')))); ?></span>
							
						</div>
						<div class="input">
							<div class="inputholder"><textarea class="inputarea" name="<?php if ('') echo ''.'_' ?>code<?php if (false) echo '_disabled' ?>"><?php echo Text::encodeHtml($code) ?></textarea></div>
							
						</div>
					</div>
				<?php } ?>
			</div></fieldset>
		<div class="or-form-actionbar"><input type="button" class="or-form-btn or-form-btn--secondary or-form-btn--cancel" value="<?php echo lang("CANCEL") ?>" /><input type="submit" class="or-form-btn or-form-btn--primary" value="<?php echo lang('BUTTON_OK') ?>" /></div></form>
	