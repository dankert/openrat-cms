<?php
	#IF-ATTR-VALUE type:ok#
		if ($this->isEditable() && !$this->isEditMode() && !readonly() )
		{
			$attr_type = ''; // Knopf nicht anzeigen
			?><a class="action" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'edit')) ?>"><span title="<?php echo lang('MODE_EDIT_DESC') ?>"><?php echo langHtml('MODE_EDIT') ?></span></a><?php
		} else
		{
			$attr_type = 'submit';
		}
	#END-IF

	#IF-ATTR src#
		$attr_type    = 'image';
		$attr_tmp_src = $image_dir.'icon_'.$attr_src.IMG_ICON_EXT;
	#ELSE
		$attr_tmp_src  = '';
	#END-IF
	if	( !empty($attr_type)) { 
?>
<input type="<?php echo $attr_type ?>"<?php if(isset($attr_src)) { ?> src="<?php $attr_tmp_src ?>"<?php } ?> name="<?php echo $attr_value ?>" class="%class%" title="<?php echo lang($attr_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr_src); ?>
<?php }
	#IF-ATTR-VALUE type:ok#
		if ($this->isEditable() && $this->isEditMode() )
		{
			// 2. Knopf "Cancel"
			?><a class="action" href="<?php echo Html::url($actionName,$subactionName,0,array('mode'=>'')) ?>"><span title="<?php echo lang('CANCEL_DESC') ?>"><?php echo langHtml('CANCEL') ?></span></a><?php
		}
	#END-IF
?>