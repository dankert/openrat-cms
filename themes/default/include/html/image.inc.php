<?php

/* #IF-ATTR elementtype# */
	$attr_tmp_image_file = $image_dir.'icon_el_'.$attr_elementtype.IMG_ICON_EXT;
	$attr_size           = '16x16';
/* #END-IF# */

/* #IF-ATTR type# */		
	$attr_tmp_image_file = $image_dir.'icon_'.$attr_type.IMG_ICON_EXT;
	$attr_size = '16x16';
/* #END-IF# */
	
/* #IF-ATTR icon# */		
	$attr_tmp_image_file = $image_dir.'icon_'.$attr_icon.IMG_ICON_EXT;
	$attr_size = '16x16';
/* #END-IF# */

/* #IF-ATTR tree# */		
	$attr_tmp_image_file = $image_dir.'tree_'.$attr_tree.IMG_EXT;
	$attr_size = '18x18';
/* #END-IF# */

/* #IF-ATTR url# */			
	$attr_tmp_image_file = $attr_url;
/* #END-IF# */
	
/* #IF-ATTR fileext# */		
	$attr_tmp_image_file = $image_dir.$attr_fileext;
/* #END-IF# */
	
/* #IF-ATTR file# */		
	$attr_tmp_image_file = $image_dir.$attr_file.IMG_ICON_EXT;
/* #END-IF# */
	
?><img alt="<?php echo basename($attr_tmp_image_file); echo ' ('; if (isset($attr_size)) { list($attr_tmp_width,$attr_tmp_height)=explode('x',$attr_size);echo $attr_tmp_width.'x'.$attr_tmp_height; echo')';} ?>" src="<?php echo $attr_tmp_image_file ?>" border="0"<?php if(isset($attr_align)) echo ' align="'.$attr_align.'"' ?><?php if (isset($attr_size)) { list($attr_tmp_width,$attr_tmp_height)=explode('x',$attr_size);echo ' width="'.$attr_tmp_width.'" height="'.$attr_tmp_height.'"';} ?>>