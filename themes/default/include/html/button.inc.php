<?php
	#IF-ATTR-VALUE type:ok#
		if ($this->isEditable() && !$this->isEditMode())
		$attr_text = 'MODE_EDIT';
		$attr_type = 'submit';
		
		if	( $this->isEditable() && readonly() )
			$attr_type = ''; // Knopf nicht anzeigen
	#END-IF

	#IF-ATTR src#
		$attr_type = 'image';
	#ELSE
		$attr_src  = '';
	#END-IF
	
	if	( !empty($attr_type) ) {
?><input type="<?php echo $attr_type ?>"<?php if(isset($attr_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr_value ?>" class="%class%" title="<?php echo lang($attr_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr_src)
?><?php } 
?>