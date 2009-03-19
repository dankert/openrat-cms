<?php if ($this->isEditable() && !$this->isEditMode()) $attr_readonly=true;
	  if ($attr_readonly && empty($$attr_name)) $$attr_name = '- '.lang('EMPTY').' -';
      if(!isset($attr_default)) $attr_default='';
      
?><?php if (!$attr_readonly || $attr_type=='hidden') {
?><input<?php if ($attr_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr_name ?><?php if ($attr_readonly) echo '_disabled' ?>" name="<?php echo $attr_name ?><?php if ($attr_readonly) echo '_disabled' ?>" type="<?php echo $attr_type ?>" size="<?php echo $attr_size ?>" maxlength="<?php echo $attr_maxlength ?>" class="<?php echo $attr_class ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" <?php if (in_array($attr_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr_readonly) {
?><input type="hidden" id="id_<?php echo $attr_name ?>" name="<?php echo $attr_name ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr_class ?>"><?php echo isset($$attr_name)?$$attr_name:$attr_default ?></span><?php } ?>