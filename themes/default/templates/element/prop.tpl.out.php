<!-- Compiling output/output-begin -->
		
		
		<?php $if2=(@$conf['security']['disable_dynamic_code']); if($if2){?>
			<?php $if3=(!true); if($if3){?>
				<div class="message warn">
					<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang(''.'NOTICE_CODE_DISABLED'.'')))); ?></span>
					
				</div>
			<?php } ?>
		<?php } ?>
		<form name=""
      target="_self"
      action="<?php echo OR_ACTION ?>"
      data-method="<?php echo OR_METHOD ?>"
      data-action="<?php echo OR_ACTION ?>"
      data-id="<?php echo OR_ID ?>"
      method="<?php echo OR_METHOD ?>"
      enctype="application/x-www-form-urlencoded"
      class="<?php echo OR_ACTION ?>"
      data-async=""
      data-autosave=""
      onSubmit="formSubmit( $(this) ); return false;"><input type="submit" class="invisible" />
      
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo OR_ACTION ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo OR_METHOD ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo OR_ID ?>" />
<?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?>

			<fieldset class="<?php echo '1'?" open":"" ?><?php echo '1'?" show":"" ?>"><div>
				<?php $if4=(!empty($subtype)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('ELEMENT_SUBTYPE')))); ?></span>
							
						</div>
						<div class="input">
							<?php $if7=(!empty($subtypes)); if($if7){?><!-- Compiling selectbox/selectbox-begin --><?php $a8_list='subtypes';$a8_name='subtype';$a8_onchange='';$a8_title='';$a8_class='';$a8_addempty=true;$a8_multiple=false;$a8_size='1';$a8_lang=false; ?><?php
$a8_readonly=false;
$a8_tmp_list = $$a8_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a8_name)?'- '.lang('EMPTY').' -':$a8_tmp_list[$$a8_name];
}
else
{
if ( $a8_addempty!==FALSE  )
{
	if ($a8_addempty===TRUE)
		$a8_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a8_tmp_list;
	else
		$a8_tmp_list = array(''=>'- '.lang($a8_addempty).' -')+$a8_tmp_list;
}
?><div class="inputholder"><select<?php if ($a8_readonly) echo ' disabled="disabled"' ?> id="<?php echo REQUEST_ID ?>_<?php echo $a8_name ?>"  name="<?php echo $a8_name; if ($a8_multiple) echo '[]'; ?>" onchange="<?php echo $a8_onchange ?>" title="<?php echo $a8_title ?>" class="<?php echo $a8_class ?>"<?php
if (count($$a8_list)<=1) echo ' disabled="disabled"';
if	($a8_multiple) echo ' multiple="multiple"';
echo ' size="'.intval($a8_size).'"';
?>><?php
		if	( isset($$a8_name) && isset($a8_tmp_list[$$a8_name]) )
			$a8_tmp_default = $$a8_name;
		elseif ( isset($a8_default) )
			$a8_tmp_default = $a8_default;
		else
			$a8_tmp_default = '';
		foreach( $a8_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a8_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a8_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a8_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select></div><?php
if (count($$a8_list)==0) echo '<input type="hidden" name="'.$a8_name.'" value="" />';
if (count($$a8_list)==1) echo '<input type="hidden" name="'.$a8_name.'" value="'.$box_key.'" />';
}
?><?php unset($a8_list,$a8_name,$a8_onchange,$a8_title,$a8_class,$a8_addempty,$a8_multiple,$a8_size,$a8_lang) ?>
							<?php } ?>
							<?php $if7=!(!empty($subtypes)); if($if7){?><!-- Compiling input/input-begin --><?php $a8_class='text';$a8_default='';$a8_type='text';$a8_name='subtype';$a8_size='';$a8_maxlength='256';$a8_onchange='';$a8_readonly=false;$a8_hint='';$a8_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	  if ($a8_readonly && empty($$a8_name)) $$a8_name = '- '.lang('EMPTY').' -';
      if(!isset($a8_default)) $a8_default='';
      $tmp_value = Text::encodeHtml(isset($$a8_name)?$$a8_name:$a8_default);
?><?php if (!$a8_readonly || $a8_type=='hidden') {
?><div class="<?php echo $a8_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a8_readonly) echo ' disabled="true"' ?><?php if ($a8_hint) echo ' data-hint="'.$a8_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" name="<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" type="<?php echo $a8_type ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo str_replace(',',' ',$a8_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a8_icon) echo '<img src="'.$image_dir.'icon_'.$a8_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a8_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a8_name ?>" name="<?php echo $a8_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a8_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a8_class,$a8_default,$a8_type,$a8_name,$a8_size,$a8_maxlength,$a8_onchange,$a8_readonly,$a8_hint,$a8_icon) ?>
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
							<!-- Compiling label/label-begin --><?php $a7_for='with_icon'; ?><label<?php if (isset($a7_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" <?php if(hasLang(@$a7_key.'_desc')) { ?> title="<?php echo lang(@$a7_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); ?><?php if (isset($a7_text)) { echo $a7_text; } ?><?php } ?><?php unset($a7_for) ?>
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_WITH_ICON')))); ?></span>
								<!-- Compiling label/label-end --></label>
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
							<!-- Compiling label/label-begin --><?php $a7_for='all_languages'; ?><label<?php if (isset($a7_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" <?php if(hasLang(@$a7_key.'_desc')) { ?> title="<?php echo lang(@$a7_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); ?><?php if (isset($a7_text)) { echo $a7_text; } ?><?php } ?><?php unset($a7_for) ?>
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_ALL_LANGUAGES')))); ?></span>
								<!-- Compiling label/label-end --></label>
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
							<!-- Compiling label/label-begin --><?php $a7_for='writable'; ?><label<?php if (isset($a7_for)) { ?> for="<?php echo REQUEST_ID ?>_<?php echo $a7_for ?><?php if (!empty($a7_value)) echo '_'.$a7_value ?>" <?php if(hasLang(@$a7_key.'_desc')) { ?> title="<?php echo lang(@$a7_key.'_desc')?>"<?php } ?>  class="label"<?php } ?>>
<?php if (isset($a7_key)) { echo lang($a7_key); ?><?php if (isset($a7_text)) { echo $a7_text; } ?><?php } ?><?php unset($a7_for) ?>
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_writable')))); ?></span>
								<!-- Compiling label/label-end --></label>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($width)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('width')))); ?></span>
							
						</div>
						<div class="input"><!-- Compiling input/input-begin --><?php $a7_class='text';$a7_default='';$a7_type='text';$a7_name='width';$a7_size='10';$a7_maxlength='256';$a7_onchange='';$a7_readonly=false;$a7_hint='';$a7_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	  if ($a7_readonly && empty($$a7_name)) $$a7_name = '- '.lang('EMPTY').' -';
      if(!isset($a7_default)) $a7_default='';
      $tmp_value = Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default);
?><?php if (!$a7_readonly || $a7_type=='hidden') {
?><div class="<?php echo $a7_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a7_readonly) echo ' disabled="true"' ?><?php if ($a7_hint) echo ' data-hint="'.$a7_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" name="<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" type="<?php echo $a7_type ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo str_replace(',',' ',$a7_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a7_icon) echo '<img src="'.$image_dir.'icon_'.$a7_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a7_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?>" name="<?php echo $a7_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a7_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a7_class,$a7_default,$a7_type,$a7_name,$a7_size,$a7_maxlength,$a7_onchange,$a7_readonly,$a7_hint,$a7_icon) ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($height)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('height')))); ?></span>
							
						</div>
						<div class="input"><!-- Compiling input/input-begin --><?php $a7_class='text';$a7_default='';$a7_type='text';$a7_name='height';$a7_size='10';$a7_maxlength='256';$a7_onchange='';$a7_readonly=false;$a7_hint='';$a7_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	  if ($a7_readonly && empty($$a7_name)) $$a7_name = '- '.lang('EMPTY').' -';
      if(!isset($a7_default)) $a7_default='';
      $tmp_value = Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default);
?><?php if (!$a7_readonly || $a7_type=='hidden') {
?><div class="<?php echo $a7_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a7_readonly) echo ' disabled="true"' ?><?php if ($a7_hint) echo ' data-hint="'.$a7_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" name="<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" type="<?php echo $a7_type ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo str_replace(',',' ',$a7_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a7_icon) echo '<img src="'.$image_dir.'icon_'.$a7_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a7_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?>" name="<?php echo $a7_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a7_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a7_class,$a7_default,$a7_type,$a7_name,$a7_size,$a7_maxlength,$a7_onchange,$a7_readonly,$a7_hint,$a7_icon) ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($dateformat)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DATEFORMAT')))); ?></span>
							
						</div>
						<div class="input"><!-- Compiling selectbox/selectbox-begin --><?php $a7_list='dateformats';$a7_name='dateformat';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
$a7_readonly=false;
$a7_tmp_list = $$a7_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a7_name)?'- '.lang('EMPTY').' -':$a7_tmp_list[$$a7_name];
}
else
{
if ( $a7_addempty!==FALSE  )
{
	if ($a7_addempty===TRUE)
		$a7_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a7_tmp_list;
	else
		$a7_tmp_list = array(''=>'- '.lang($a7_addempty).' -')+$a7_tmp_list;
}
?><div class="inputholder"><select<?php if ($a7_readonly) echo ' disabled="disabled"' ?> id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?>"  name="<?php echo $a7_name; if ($a7_multiple) echo '[]'; ?>" onchange="<?php echo $a7_onchange ?>" title="<?php echo $a7_title ?>" class="<?php echo $a7_class ?>"<?php
if (count($$a7_list)<=1) echo ' disabled="disabled"';
if	($a7_multiple) echo ' multiple="multiple"';
echo ' size="'.intval($a7_size).'"';
?>><?php
		if	( isset($$a7_name) && isset($a7_tmp_list[$$a7_name]) )
			$a7_tmp_default = $$a7_name;
		elseif ( isset($a7_default) )
			$a7_tmp_default = $a7_default;
		else
			$a7_tmp_default = '';
		foreach( $a7_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a7_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a7_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a7_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select></div><?php
if (count($$a7_list)==0) echo '<input type="hidden" name="'.$a7_name.'" value="" />';
if (count($$a7_list)==1) echo '<input type="hidden" name="'.$a7_name.'" value="'.$box_key.'" />';
}
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($format)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_FORMAT')))); ?></span>
							
						</div>
						<div class="input"><!-- Compiling radiobox/radiobox-begin --><?php $a7_list='formatlist';$a7_name='format';$a7_onchange='';$a7_title='';$a7_class=''; ?><?php $a7_tmp_list = $$a7_list;
		if	( isset($$a7_name) && isset($a7_tmp_list[$$a7_name]) )
			$a7_tmp_default = $$a7_name;
		elseif ( isset($a7_default) )
			$a7_tmp_default = $a7_default;
		else
			$a7_tmp_default = '';
		foreach( $a7_tmp_list as $box_key=>$box_value )
		{
			$box_value = is_array($box_value)?(isset($box_value['lang'])?langHtml($box_value['lang']):$box_value['value']):$box_value;
			$id = REQUEST_ID.'_'.$a7_name.'_'.$box_key;
			echo '<input id="'.$id.'" name="'.$a7_name.'" type="radio" class="'.$a7_class.'" value="'.$box_key.'"';
			if ($box_key==$a7_tmp_default)
				echo ' checked="checked"';
			echo ' />&nbsp;<label for="'.$id.'">'.$box_value.'</label><br />';
		}
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class) ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($decimals)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DECIMALS')))); ?></span>
							
						</div>
						<div class="input"><!-- Compiling input/input-begin --><?php $a7_class='text';$a7_default='';$a7_type='text';$a7_name='decimals';$a7_size='10';$a7_maxlength='2';$a7_onchange='';$a7_readonly=false;$a7_hint='';$a7_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	  if ($a7_readonly && empty($$a7_name)) $$a7_name = '- '.lang('EMPTY').' -';
      if(!isset($a7_default)) $a7_default='';
      $tmp_value = Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default);
?><?php if (!$a7_readonly || $a7_type=='hidden') {
?><div class="<?php echo $a7_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a7_readonly) echo ' disabled="true"' ?><?php if ($a7_hint) echo ' data-hint="'.$a7_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" name="<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" type="<?php echo $a7_type ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo str_replace(',',' ',$a7_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a7_icon) echo '<img src="'.$image_dir.'icon_'.$a7_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a7_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?>" name="<?php echo $a7_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a7_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a7_class,$a7_default,$a7_type,$a7_name,$a7_size,$a7_maxlength,$a7_onchange,$a7_readonly,$a7_hint,$a7_icon) ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($dec_point)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DEC_POINT')))); ?></span>
							
						</div>
						<div class="input"><!-- Compiling input/input-begin --><?php $a7_class='text';$a7_default='';$a7_type='text';$a7_name='dec_point';$a7_size='10';$a7_maxlength='5';$a7_onchange='';$a7_readonly=false;$a7_hint='';$a7_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	  if ($a7_readonly && empty($$a7_name)) $$a7_name = '- '.lang('EMPTY').' -';
      if(!isset($a7_default)) $a7_default='';
      $tmp_value = Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default);
?><?php if (!$a7_readonly || $a7_type=='hidden') {
?><div class="<?php echo $a7_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a7_readonly) echo ' disabled="true"' ?><?php if ($a7_hint) echo ' data-hint="'.$a7_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" name="<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" type="<?php echo $a7_type ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo str_replace(',',' ',$a7_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a7_icon) echo '<img src="'.$image_dir.'icon_'.$a7_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a7_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?>" name="<?php echo $a7_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a7_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a7_class,$a7_default,$a7_type,$a7_name,$a7_size,$a7_maxlength,$a7_onchange,$a7_readonly,$a7_hint,$a7_icon) ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($thousand_sep)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_thousand_sep')))); ?></span>
							
						</div>
						<div class="input"><!-- Compiling input/input-begin --><?php $a7_class='text';$a7_default='';$a7_type='text';$a7_name='thousand_sep';$a7_size='10';$a7_maxlength='1';$a7_onchange='';$a7_readonly=false;$a7_hint='';$a7_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	  if ($a7_readonly && empty($$a7_name)) $$a7_name = '- '.lang('EMPTY').' -';
      if(!isset($a7_default)) $a7_default='';
      $tmp_value = Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default);
?><?php if (!$a7_readonly || $a7_type=='hidden') {
?><div class="<?php echo $a7_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a7_readonly) echo ' disabled="true"' ?><?php if ($a7_hint) echo ' data-hint="'.$a7_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" name="<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" type="<?php echo $a7_type ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo str_replace(',',' ',$a7_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a7_icon) echo '<img src="'.$image_dir.'icon_'.$a7_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a7_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?>" name="<?php echo $a7_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a7_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a7_class,$a7_default,$a7_type,$a7_name,$a7_size,$a7_maxlength,$a7_onchange,$a7_readonly,$a7_hint,$a7_icon) ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($default_text)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_default_text')))); ?></span>
							
						</div>
						<div class="input"><!-- Compiling input/input-begin --><?php $a7_class='text';$a7_default='';$a7_type='text';$a7_name='default_text';$a7_size='40';$a7_maxlength='255';$a7_onchange='';$a7_readonly=false;$a7_hint='';$a7_icon=''; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	  if ($a7_readonly && empty($$a7_name)) $$a7_name = '- '.lang('EMPTY').' -';
      if(!isset($a7_default)) $a7_default='';
      $tmp_value = Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default);
?><?php if (!$a7_readonly || $a7_type=='hidden') {
?><div class="<?php echo $a7_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($a7_readonly) echo ' disabled="true"' ?><?php if ($a7_hint) echo ' data-hint="'.$a7_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" name="<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" type="<?php echo $a7_type ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo str_replace(',',' ',$a7_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($a7_icon) echo '<img src="'.$image_dir.'icon_'.$a7_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($a7_readonly) {
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?>" name="<?php echo $a7_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $a7_class ?>"><?php echo $tmp_value ?></span></a><?php } ?><?php unset($a7_class,$a7_default,$a7_type,$a7_name,$a7_size,$a7_maxlength,$a7_onchange,$a7_readonly,$a7_hint,$a7_icon) ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($default_longtext)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_default_longtext')))); ?></span>
							
						</div>
						<div class="input"><!-- Compiling inputarea/inputarea-begin --><?php $a7_name='default_longtext';$a7_rows='10';$a7_cols='40';$a7_class='inputarea';$a7_default=''; ?><div class="inputholder"><textarea class="<?php echo $a7_class ?>" name="<?php echo $a7_name ?>" ><?php echo Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default) ?></textarea></div><?php unset($a7_name,$a7_rows,$a7_cols,$a7_class,$a7_default) ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($parameters)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DYNAMIC_PARAMETERS')))); ?></span>
							
						</div>
						<div class="input"><!-- Compiling inputarea/inputarea-begin --><?php $a7_name='parameters';$a7_rows='15';$a7_cols='40';$a7_class='inputarea';$a7_default=''; ?><div class="inputholder"><textarea class="<?php echo $a7_class ?>" name="<?php echo $a7_name ?>" ><?php echo Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default) ?></textarea></div><?php unset($a7_name,$a7_rows,$a7_cols,$a7_class,$a7_default) ?>
						</div>
					</div>
					<div class="line">
						<div class="label">
						</div>
						<div class="input"><!-- Compiling list/list-begin --><?php $a7_list='dynamic_class_parameters';$a7_extract=false;$a7_key='paramName';$a7_value='defaultValue'; ?><?php
	$a7_list_tmp_key   = $a7_key;
	$a7_list_tmp_value = $a7_value;
	$a7_list_extract   = $a7_extract;
	unset($a7_key);
	unset($a7_value);
	if	( !isset($$a7_list) || !is_array($$a7_list) )
		$$a7_list = array();
	foreach( $$a7_list as $$a7_list_tmp_key => $$a7_list_tmp_value )
	{
		if	( $a7_list_extract )
		{
			if	( !is_array($$a7_list_tmp_value) )
			{
				print_r($$a7_list_tmp_value);
				die( 'not an array at key: '.$$a7_list_tmp_key );
			}
			extract($$a7_list_tmp_value);
		}
?><?php unset($a7_list,$a7_extract,$a7_key,$a7_value) ?>
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities($paramName))); ?></span>
								
								<span class="text"><?php echo nl2br('&nbsp;('); ?></span>
								
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('GLOBAL_DEFAULT')))); ?></span>
								
								<span class="text"><?php echo nl2br(')&nbsp;=&nbsp;'); ?></span>
								
								<span class="text"><?php echo nl2br(encodeHtml(htmlentities($defaultValue))); ?></span>
								<!-- Compiling newline/newline-begin --><br/><!-- Compiling list/list-end --><?php } ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($select_items)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_select_items')))); ?></span>
							
						</div>
						<div class="input"><!-- Compiling inputarea/inputarea-begin --><?php $a7_name='select_items';$a7_rows='15';$a7_cols='40';$a7_class='inputarea';$a7_default=''; ?><div class="inputholder"><textarea class="<?php echo $a7_class ?>" name="<?php echo $a7_name ?>" ><?php echo Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default) ?></textarea></div><?php unset($a7_name,$a7_rows,$a7_cols,$a7_class,$a7_default) ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($linkelement)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_LINK')))); ?></span>
							
						</div>
						<div class="input"><!-- Compiling selectbox/selectbox-begin --><?php $a7_list='linkelements';$a7_name='linkelement';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
$a7_readonly=false;
$a7_tmp_list = $$a7_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a7_name)?'- '.lang('EMPTY').' -':$a7_tmp_list[$$a7_name];
}
else
{
if ( $a7_addempty!==FALSE  )
{
	if ($a7_addempty===TRUE)
		$a7_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a7_tmp_list;
	else
		$a7_tmp_list = array(''=>'- '.lang($a7_addempty).' -')+$a7_tmp_list;
}
?><div class="inputholder"><select<?php if ($a7_readonly) echo ' disabled="disabled"' ?> id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?>"  name="<?php echo $a7_name; if ($a7_multiple) echo '[]'; ?>" onchange="<?php echo $a7_onchange ?>" title="<?php echo $a7_title ?>" class="<?php echo $a7_class ?>"<?php
if (count($$a7_list)<=1) echo ' disabled="disabled"';
if	($a7_multiple) echo ' multiple="multiple"';
echo ' size="'.intval($a7_size).'"';
?>><?php
		if	( isset($$a7_name) && isset($a7_tmp_list[$$a7_name]) )
			$a7_tmp_default = $$a7_name;
		elseif ( isset($a7_default) )
			$a7_tmp_default = $a7_default;
		else
			$a7_tmp_default = '';
		foreach( $a7_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a7_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a7_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a7_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select></div><?php
if (count($$a7_list)==0) echo '<input type="hidden" name="'.$a7_name.'" value="" />';
if (count($$a7_list)==1) echo '<input type="hidden" name="'.$a7_name.'" value="'.$box_key.'" />';
}
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($name)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('ELEMENT_NAME')))); ?></span>
							
						</div>
						<div class="input"><!-- Compiling selectbox/selectbox-begin --><?php $a7_list='names';$a7_name='name';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
$a7_readonly=false;
$a7_tmp_list = $$a7_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a7_name)?'- '.lang('EMPTY').' -':$a7_tmp_list[$$a7_name];
}
else
{
if ( $a7_addempty!==FALSE  )
{
	if ($a7_addempty===TRUE)
		$a7_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a7_tmp_list;
	else
		$a7_tmp_list = array(''=>'- '.lang($a7_addempty).' -')+$a7_tmp_list;
}
?><div class="inputholder"><select<?php if ($a7_readonly) echo ' disabled="disabled"' ?> id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?>"  name="<?php echo $a7_name; if ($a7_multiple) echo '[]'; ?>" onchange="<?php echo $a7_onchange ?>" title="<?php echo $a7_title ?>" class="<?php echo $a7_class ?>"<?php
if (count($$a7_list)<=1) echo ' disabled="disabled"';
if	($a7_multiple) echo ' multiple="multiple"';
echo ' size="'.intval($a7_size).'"';
?>><?php
		if	( isset($$a7_name) && isset($a7_tmp_list[$$a7_name]) )
			$a7_tmp_default = $$a7_name;
		elseif ( isset($a7_default) )
			$a7_tmp_default = $a7_default;
		else
			$a7_tmp_default = '';
		foreach( $a7_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a7_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a7_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a7_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select></div><?php
if (count($$a7_list)==0) echo '<input type="hidden" name="'.$a7_name.'" value="" />';
if (count($$a7_list)==1) echo '<input type="hidden" name="'.$a7_name.'" value="'.$box_key.'" />';
}
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($folderobjectid)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DEFAULT_FOLDEROBJECT')))); ?></span>
							
						</div>
						<div class="input"><!-- Compiling selectbox/selectbox-begin --><?php $a7_list='folders';$a7_name='folderobjectid';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=false;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
$a7_readonly=false;
$a7_tmp_list = $$a7_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a7_name)?'- '.lang('EMPTY').' -':$a7_tmp_list[$$a7_name];
}
else
{
if ( $a7_addempty!==FALSE  )
{
	if ($a7_addempty===TRUE)
		$a7_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a7_tmp_list;
	else
		$a7_tmp_list = array(''=>'- '.lang($a7_addempty).' -')+$a7_tmp_list;
}
?><div class="inputholder"><select<?php if ($a7_readonly) echo ' disabled="disabled"' ?> id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?>"  name="<?php echo $a7_name; if ($a7_multiple) echo '[]'; ?>" onchange="<?php echo $a7_onchange ?>" title="<?php echo $a7_title ?>" class="<?php echo $a7_class ?>"<?php
if (count($$a7_list)<=1) echo ' disabled="disabled"';
if	($a7_multiple) echo ' multiple="multiple"';
echo ' size="'.intval($a7_size).'"';
?>><?php
		if	( isset($$a7_name) && isset($a7_tmp_list[$$a7_name]) )
			$a7_tmp_default = $$a7_name;
		elseif ( isset($a7_default) )
			$a7_tmp_default = $a7_default;
		else
			$a7_tmp_default = '';
		foreach( $a7_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a7_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a7_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a7_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select></div><?php
if (count($$a7_list)==0) echo '<input type="hidden" name="'.$a7_name.'" value="" />';
if (count($$a7_list)==1) echo '<input type="hidden" name="'.$a7_name.'" value="'.$box_key.'" />';
}
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($default_objectid)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_DEFAULT_OBJECT')))); ?></span>
							
						</div>
						<div class="input"><!-- Compiling selectbox/selectbox-begin --><?php $a7_list='objects';$a7_name='default_objectid';$a7_onchange='';$a7_title='';$a7_class='';$a7_addempty=true;$a7_multiple=false;$a7_size='1';$a7_lang=false; ?><?php
$a7_readonly=false;
$a7_tmp_list = $$a7_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$a7_name)?'- '.lang('EMPTY').' -':$a7_tmp_list[$$a7_name];
}
else
{
if ( $a7_addempty!==FALSE  )
{
	if ($a7_addempty===TRUE)
		$a7_tmp_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$a7_tmp_list;
	else
		$a7_tmp_list = array(''=>'- '.lang($a7_addempty).' -')+$a7_tmp_list;
}
?><div class="inputholder"><select<?php if ($a7_readonly) echo ' disabled="disabled"' ?> id="<?php echo REQUEST_ID ?>_<?php echo $a7_name ?>"  name="<?php echo $a7_name; if ($a7_multiple) echo '[]'; ?>" onchange="<?php echo $a7_onchange ?>" title="<?php echo $a7_title ?>" class="<?php echo $a7_class ?>"<?php
if (count($$a7_list)<=1) echo ' disabled="disabled"';
if	($a7_multiple) echo ' multiple="multiple"';
echo ' size="'.intval($a7_size).'"';
?>><?php
		if	( isset($$a7_name) && isset($a7_tmp_list[$$a7_name]) )
			$a7_tmp_default = $$a7_name;
		elseif ( isset($a7_default) )
			$a7_tmp_default = $a7_default;
		else
			$a7_tmp_default = '';
		foreach( $a7_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $a7_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$a7_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ((string)$box_key==$a7_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select></div><?php
if (count($$a7_list)==0) echo '<input type="hidden" name="'.$a7_name.'" value="" />';
if (count($$a7_list)==1) echo '<input type="hidden" name="'.$a7_name.'" value="'.$box_key.'" />';
}
?><?php unset($a7_list,$a7_name,$a7_onchange,$a7_title,$a7_class,$a7_addempty,$a7_multiple,$a7_size,$a7_lang) ?>
						</div>
					</div>
				<?php } ?>
				<?php $if4=(!empty($code)); if($if4){?>
					<div class="line">
						<div class="label">
							<span class="text"><?php echo nl2br(encodeHtml(htmlentities(lang('EL_PROP_code')))); ?></span>
							
						</div>
						<div class="input"><!-- Compiling inputarea/inputarea-begin --><?php $a7_name='code';$a7_rows='35';$a7_cols='40';$a7_class='inputarea';$a7_default=''; ?><div class="inputholder"><textarea class="<?php echo $a7_class ?>" name="<?php echo $a7_name ?>" ><?php echo Text::encodeHtml(isset($$a7_name)?$$a7_name:$a7_default) ?></textarea></div><?php unset($a7_name,$a7_rows,$a7_cols,$a7_class,$a7_default) ?>
						</div>
					</div>
				<?php } ?>
			</div></fieldset>
		
<div class="bottom">
	<div class="command ">
	
		<input type="button" class="submit ok" value="OK" onclick="$(this).closest('div.sheet').find('form').submit(); " />
		
		<!-- Cancel-Button nicht anzeigen, wenn cancel==false. -->	</div>
</div>

</form>
