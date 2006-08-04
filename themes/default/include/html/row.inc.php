<?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	global $cell_column_nr;
	$cell_column_nr=0;

?><tr>