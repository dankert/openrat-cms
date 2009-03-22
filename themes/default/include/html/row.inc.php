<?php
	$attr_tmp_class='';
	
	/* #IF-ATTR classes# */
	$attr_tmp_class_list = explode(',',$attr_classes);
	$last_pos = array_search($attr_last_class,$attr_tmp_class_list);
	if	( $last_pos === FALSE || $last_pos == count($attr_tmp_class_list)-1)
		$attr_tmp_class = $attr_tmp_class_list[0];
	else
		$attr_tmp_class = $attr_tmp_class_list[++$last_pos];
	/* #END-IF# */
			
	/* #IF-ATTR class# */
	$attr_tmp_class=$attr_class;
	/* #END-IF# */
	
	$attr_last_class = $attr_tmp_class;
		
	echo Html::open_tag('tr',array('class'=>$attr_tmp_class));
?>