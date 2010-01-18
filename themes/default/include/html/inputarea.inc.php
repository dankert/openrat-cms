<?php if ($this->isEditMode()) {
?><textarea class="<?php echo $attr_class ?>" name="<?php echo $attr_name ?>" rows="<?php echo $attr_rows ?>" cols="<?php echo $attr_cols ?>"><?php echo htmlentities(isset($$attr_name)?$$attr_name:$attr_default) ?></textarea><?php
 } else {
?><span class="<?php echo $attr_class ?>"><?php echo isset($$attr_name)?$$attr_name:$attr_default ?></span><?php } ?>