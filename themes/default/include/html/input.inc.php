<?php if(!isset($attr_default)) $attr_default='';
?><input <?php if ($attr_readonly) echo 'disabled="true" ' ?>" id="id_<?php echo $attr_name ?><?php if ($attr_readonly) echo '_disabled' ?>" name="<?php echo $attr_name ?><?php if ($attr_readonly) echo '_disabled' ?>" type="<?php echo $attr_type ?>" size="<?php echo $attr_size ?>" maxlength="<?php echo $attr_maxlength ?>" class="<?php echo $attr_class ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" /><?php
if	($attr_readonly) {
?><input type="hidden" id="id_<?php echo $attr_name ?>" name="<?php echo $attr_name ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" /><?php
 } ?>