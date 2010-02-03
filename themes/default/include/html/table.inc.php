<?php
	// Status speichern
	$last_row_idx    = @$row_idx;
	$last_column_idx = @$column_idx;
	$row_idx    = 0;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();

	#IF-ATTR widths#
		$column_widths = explode(',',$attr_widths);
	#END-IF

	#IF-ATTR classes#
		$row_classes   = explode(',',$attr_rowclasses);
		$row_class_idx = 999;
	#END-IF
		
	#IF-ATTR rowclasses#
		$row_classes   = explode(',',$attr_rowclasses);
		$row_class_idx = 999;
	#END-IF
		
	#IF-ATTR columnclasses#
		$column_classes   = explode(',',$attr_columnclasses);
	#END-IF
		
?><table class="%class%" cellspacing="%space%" width="%width%" cellpadding="%padding%">
/* ignore */ </table>