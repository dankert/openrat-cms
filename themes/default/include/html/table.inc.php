<?php
	$coloumn_widths=array();
	if	(!empty($attr_widths))
	{
		$column_widths = explode(',',$attr_widths);
		unset($attr['widths']);
	}
?><table class="<?php echo $attr_class ?>" cellspacing="<?php echo $attr_space ?>" width="<?php echo $attr_width ?>" cellpadding="<?php echo $attr_padding ?>">