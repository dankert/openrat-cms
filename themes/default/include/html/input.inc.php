<?php if ($this->isEditable() && !$this->isEditMode()) $attr_readonly=true;
	  if ($attr_readonly && empty($$attr_name)) $$attr_name = '- '.lang('EMPTY').' -';
      if(!isset($attr_default)) $attr_default='';
//      $tmp_value = htmlentities(isset($$attr_name)?$$attr_name:$attr_default,ENT_COMPAT,'UTF-8');
      $tmp_value = Text::encodeHtml(isset($$attr_name)?$$attr_name:$attr_default);
      
?><?php if (!$attr_readonly || $attr_type=='hidden') {
	/* Feld editieren */
?><div class="<?php echo $attr_type!='hidden'?'inputholder':'inputhidden' ?>"><input<?php if ($attr_readonly) echo ' disabled="true"' ?><?php if ($attr_hint) echo ' data-hint="'.$attr_hint.'"'; ?> id="<?php echo REQUEST_ID ?>_<?php echo $attr_name ?><?php if ($attr_readonly) echo '_disabled' ?>" name="<?php echo $attr_name ?><?php if ($attr_readonly) echo '_disabled' ?>" type="<?php echo $attr_type ?>" maxlength="<?php echo $attr_maxlength ?>" class="<?php echo str_replace(',',' ',$attr_class) ?>" value="<?php echo $tmp_value ?>" /><?php if ($attr_icon) echo '<img src="'.$image_dir.'icon_'.$attr_icon.IMG_ICON_EXT.'" width="16" height="16" />'; ?></div><?php
if	($attr_readonly) {
	/* Nur anzeigen */
?><input type="hidden" id="<?php echo REQUEST_ID ?>_<?php echo $attr_name ?>" name="<?php echo $attr_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><a title="<?php echo langHtml('EDIT') ?>" href="<?php echo Html::url($actionName,$subActionName,0,array('mode'=>'edit')) ?>"><span class="<?php echo $attr_class ?>"><?php echo $tmp_value ?></span></a><?php } ?>