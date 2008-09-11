<?php
		if ($this->isEditable() && $this->getRequestVar('mode')!='edit') $attr_readonly=true;
		
		if	( isset($$attr_name)  )
			$attr_tmp_default = $$attr_name;
		elseif ( isset($attr_default) )
			$attr_tmp_default = $attr_default;
		else
			$attr_tmp_default = '';

 ?><input type="radio" id="id_<?php echo $attr_name.'_'.$attr_value ?>"  name="<?php echo $attr_prefix.$attr_name ?>"<?php if ( $attr_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $attr_value ?>" <?php if($attr_value==$attr_tmp_default) echo 'checked="checked"' ?><?php if (in_array($attr_name,$errors)) echo ' style="borderx:2px dashed red; background-color:red;"' ?> />