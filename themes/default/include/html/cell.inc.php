<?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr_class))
		$attr_class=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr_width=$column_widths[$cell_column_nr-1];
?><td<?php
#IF-ATTR width#
?> width="<?php echo $attr_width ?>"<?php
#END-IF#
#IF-ATTR style#
?> style="<?php   echo $attr_style   ?>" <?php
#END-IF#
#IF-ATTR class#
?> class="<?php   echo $attr_class   ?>" <?php
#END-IF#
#IF-ATTR colspan#
?> colspan="<?php echo $attr_colspan ?>" <?php
#END-IF#
#IF-ATTR rowspan#
?> rowspan="<?php echo $attr_rowspan ?>" <?php
#END-IF#
?>>