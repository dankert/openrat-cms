<?php
//	if (empty($attr_class))
//		$attr['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr_class))
		$attr['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>