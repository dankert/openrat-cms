<?php
	$coloumn_widths=array();
	$row_classes   = array('');
	$column_classes= array('');

	if	(!empty($attr_widths))
	{
		$column_widths = explode(',',$attr_widths);
		unset($attr['widths']);
	}
	if	(!empty($attr_classes))
	{
		$row_classes   = explode(',',$attr_rowclasses);
		$row_class_idx = 999;
		unset($attr['rowclasses']);
	}
	if	(!empty($attr_rowclasses))
	{
		$row_classes   = explode(',',$attr_rowclasses);
		$row_class_idx = 999;
		unset($attr['rowclasses']);
	}
	if	(!empty($attr_columnclasses))
	{
		$column_classes   = explode(',',$attr_columnclasses);
		unset($attr['columnclasses']);
	}
	
?><table class="<?php echo $attr_class ?>" cellspacing="<?php echo $attr_space ?>" width="<?php echo $attr_width ?>" cellpadding="<?php echo $attr_padding ?>">