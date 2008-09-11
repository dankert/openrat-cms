<?php
	if ($attr_type=='ok')
	{
		if ($this->isEditable() && $this->getRequestVar('mode')!='edit')
		$attr_text = lang('MODE_EDIT');
	}

	if ($attr_type=='ok')
		$attr_type  = 'submit';
	if (isset($attr_src))
		$attr_type  = 'image';
	else
		$attr_src  = '';
?><input type="<?php echo $attr_type ?>"<?php if(isset($attr_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr_value ?>" class="<?php echo $attr_class ?>" title="<?php echo lang($attr_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($attr_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr_src) ?>