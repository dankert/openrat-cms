<?php  $attr1_class='title';  ?><?php
 if (!headers_sent()) header('Content-Type: text/html; charset='.$charset)
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo isset($attr1_title)?$attr1_title.' - ':(isset($windowTitle)?langHtml($windowTitle).' - ':'') ?><?php echo $cms_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset ?>" >
  <meta name="MSSmartTagsPreventParsing" content="true" >
  <meta name="robots" content="noindex,nofollow" >
<?php if (isset($windowMenu) && is_array($windowMenu)) foreach( $windowMenu as $menu )
      {
       	?>
  <link rel="section" href="<?php echo Html::url($actionName,@$menu['subaction'],$this->getRequestId() ) ?>" title="<?php echo lang($menu['text']) ?>" >
<?php
      }
?><?php if (isset($metaList) && is_array($metaList)) foreach( $metaList as $meta )
      {
       	?>
  <link rel="<?php echo $meta['name'] ?>" href="<?php echo $meta['url'] ?>" title="<?php echo lang($meta['title']) ?>" ><?php
      }
?><?php if(!empty($root_stylesheet)) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $root_stylesheet ?>" >
<?php } ?>
<?php if($root_stylesheet!=$user_stylesheet) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $user_stylesheet ?>" >
<?php } ?>
</head>
<body class="<?php echo $attr1_class ?>" <?php if (@$conf['interface']['application_mode']) { ?> style="padding:0px;margin:0px;"<?php } ?> >
<?php /* Debug-Information */ if ($showDuration) { echo "<!--\n";print_r($this->templateVars);echo "\n-->";} ?><?php unset($attr1_class); ?><?php  $attr2_width='100%';  $attr2_space='0';  $attr2_padding='5';  ?><?php
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
		$attr2_class='';
		$column_widths = explode(',',$attr2_widths);
		unset($attr2['widths']);
?><table class="<?php echo $attr2_class ?>" cellspacing="<?php echo $attr2_space ?>" width="<?php echo $attr2_width ?>" cellpadding="<?php echo $attr2_padding ?>"><?php unset($attr2_width);unset($attr2_space);unset($attr2_padding); ?><?php  ?><?php
	$attr3_tmp_class='';
	$attr3_last_class = $attr3_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr3_tmp_class));
?><?php  ?><?php  $attr4_width='30%';  $attr4_class='title';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr4_class))
		$attr4_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr4_rowspan) )
		$attr4_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> width="<?php echo $attr4_width ?>"<?php
?> class="<?php   echo $attr4_class   ?>" <?php
?>><?php unset($attr4_width);unset($attr4_class); ?><?php  $attr5_icon='database';  $attr5_align='left';  ?><?php
	$attr5_tmp_image_file = $image_dir.'icon_'.$attr5_icon.IMG_ICON_EXT;
	$attr5_size = '16x16';
?><img alt="<?php echo basename($attr5_tmp_image_file); echo ' ('; if (isset($attr5_size)) { list($attr5_tmp_width,$attr5_tmp_height)=explode('x',$attr5_size);echo $attr5_tmp_width.'x'.$attr5_tmp_height; echo')';} ?>" src="<?php echo $attr5_tmp_image_file ?>" border="0"<?php if(isset($attr5_align)) echo ' align="'.$attr5_align.'"' ?><?php if (isset($attr5_size)) { list($attr5_tmp_width,$attr5_tmp_height)=explode('x',$attr5_size);echo ' width="'.$attr5_tmp_width.'" height="'.$attr5_tmp_height.'"';} ?>><?php unset($attr5_icon);unset($attr5_align); ?><?php  $attr5_title=lang('database');  $attr5_class='text';  $attr5_var='dbname';  $attr5_escape=true;  ?><?php
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
		$langF = $attr5_escape?'langHtml':'lang';
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_title);unset($attr5_class);unset($attr5_var);unset($attr5_escape); ?><?php  $attr5_class='text';  $attr5_raw='_-_';  $attr5_escape=true;  ?><?php
		$attr5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
		$langF = $attr5_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_class);unset($attr5_raw);unset($attr5_escape); ?><?php  $attr5_class='text';  $attr5_var='cms_title';  $attr5_escape=true;  ?><?php
		$attr5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
		$langF = $attr5_escape?'langHtml':'lang';
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_class);unset($attr5_var);unset($attr5_escape); ?><?php  ?></td><?php  ?><?php  $attr4_width='40%';  $attr4_style='text-align:center;';  $attr4_class='title';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr4_class))
		$attr4_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr4_rowspan) )
		$attr4_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> width="<?php echo $attr4_width ?>"<?php
?> style="<?php   echo $attr4_style   ?>" <?php
?> class="<?php   echo $attr4_class   ?>" <?php
?>><?php unset($attr4_width);unset($attr4_style);unset($attr4_class); ?><?php  $attr5_present='projectname';  ?><?php 
	$attr5_tmp_exec = isset($$attr5_present);
	$attr5_tmp_last_exec = $attr5_tmp_exec;
	if	( $attr5_tmp_exec )
	{
?>
<?php unset($attr5_present); ?><?php  $attr6_title=lang('project');  $attr6_class='text';  $attr6_var='projectname';  $attr6_escape=true;  ?><?php
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_title);unset($attr6_class);unset($attr6_var);unset($attr6_escape); ?><?php  ?><?php } ?><?php  ?><?php  $attr5_present='modelname';  ?><?php 
	$attr5_tmp_exec = isset($$attr5_present);
	$attr5_tmp_last_exec = $attr5_tmp_exec;
	if	( $attr5_tmp_exec )
	{
?>
<?php unset($attr5_present); ?><?php  $attr6_class='text';  $attr6_raw='_(';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_raw);unset($attr6_escape); ?><?php  $attr6_title=lang('model');  $attr6_class='text';  $attr6_var='modelname';  $attr6_escape=true;  ?><?php
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_title);unset($attr6_class);unset($attr6_var);unset($attr6_escape); ?><?php  $attr6_class='text';  $attr6_raw=',';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_raw);unset($attr6_escape); ?><?php  $attr6_title=lang('language');  $attr6_class='text';  $attr6_var='languagename';  $attr6_escape=true;  ?><?php
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_title);unset($attr6_class);unset($attr6_var);unset($attr6_escape); ?><?php  $attr6_class='text';  $attr6_raw=')';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_raw);unset($attr6_escape); ?><?php  ?><?php } ?><?php  ?><?php  ?></td><?php  ?><?php  $attr4_width='20%';  $attr4_style='text-align:right;';  $attr4_class='title';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr4_class))
		$attr4_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr4_rowspan) )
		$attr4_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> width="<?php echo $attr4_width ?>"<?php
?> style="<?php   echo $attr4_style   ?>" <?php
?> class="<?php   echo $attr4_class   ?>" <?php
?>><?php unset($attr4_width);unset($attr4_style);unset($attr4_class); ?><?php  $attr5_title=lang('USER_PROFILE_DESC');  $attr5_target='cms_main_main';  $attr5_url=$profile_url;  $attr5_class='';  ?><?php
	$params = array();
		$tmp_url = $attr5_url;
?><a<?php if (isset($attr5_name)) echo ' name="'.$attr5_name.'"'; else echo ' href="'.$tmp_url.($attr5_anchor?'#'.$attr5_anchor:'').'"' ?> class="<?php echo $attr5_class ?>" target="<?php echo $attr5_target ?>"<?php if (isset($attr5_accesskey)) echo ' accesskey="'.$attr5_accesskey.'"' ?>  title="<?php echo encodeHtml($attr5_title) ?>"><?php unset($attr5_title);unset($attr5_target);unset($attr5_url);unset($attr5_class); ?><?php  $attr6_icon='user';  $attr6_align='right';  ?><?php
	$attr6_tmp_image_file = $image_dir.'icon_'.$attr6_icon.IMG_ICON_EXT;
	$attr6_size = '16x16';
?><img alt="<?php echo basename($attr6_tmp_image_file); echo ' ('; if (isset($attr6_size)) { list($attr6_tmp_width,$attr6_tmp_height)=explode('x',$attr6_size);echo $attr6_tmp_width.'x'.$attr6_tmp_height; echo')';} ?>" src="<?php echo $attr6_tmp_image_file ?>" border="0"<?php if(isset($attr6_align)) echo ' align="'.$attr6_align.'"' ?><?php if (isset($attr6_size)) { list($attr6_tmp_width,$attr6_tmp_height)=explode('x',$attr6_size);echo ' width="'.$attr6_tmp_width.'" height="'.$attr6_tmp_height.'"';} ?>><?php unset($attr6_icon);unset($attr6_align); ?><?php  $attr6_class='text';  $attr6_var='userfullname';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_var);unset($attr6_escape); ?><?php  ?></a><?php  ?><?php  ?></td><?php  ?><?php  $attr4_width='10%';  $attr4_style='text-align:right;';  $attr4_class='title';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr4_class))
		$attr4_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr4_rowspan) )
		$attr4_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> width="<?php echo $attr4_width ?>"<?php
?> style="<?php   echo $attr4_style   ?>" <?php
?> class="<?php   echo $attr4_class   ?>" <?php
?>><?php unset($attr4_width);unset($attr4_style);unset($attr4_class); ?><?php  $attr5_title=lang('USER_LOGOUT_DESC');  $attr5_target='_top';  $attr5_url=$logout_url;  $attr5_class='';  ?><?php
	$params = array();
		$tmp_url = $attr5_url;
?><a<?php if (isset($attr5_name)) echo ' name="'.$attr5_name.'"'; else echo ' href="'.$tmp_url.($attr5_anchor?'#'.$attr5_anchor:'').'"' ?> class="<?php echo $attr5_class ?>" target="<?php echo $attr5_target ?>"<?php if (isset($attr5_accesskey)) echo ' accesskey="'.$attr5_accesskey.'"' ?>  title="<?php echo encodeHtml($attr5_title) ?>"><?php unset($attr5_title);unset($attr5_target);unset($attr5_url);unset($attr5_class); ?><?php  $attr6_icon='close';  $attr6_align='right';  ?><?php
	$attr6_tmp_image_file = $image_dir.'icon_'.$attr6_icon.IMG_ICON_EXT;
	$attr6_size = '16x16';
?><img alt="<?php echo basename($attr6_tmp_image_file); echo ' ('; if (isset($attr6_size)) { list($attr6_tmp_width,$attr6_tmp_height)=explode('x',$attr6_size);echo $attr6_tmp_width.'x'.$attr6_tmp_height; echo')';} ?>" src="<?php echo $attr6_tmp_image_file ?>" border="0"<?php if(isset($attr6_align)) echo ' align="'.$attr6_align.'"' ?><?php if (isset($attr6_size)) { list($attr6_tmp_width,$attr6_tmp_height)=explode('x',$attr6_size);echo ' width="'.$attr6_tmp_width.'" height="'.$attr6_tmp_height.'"';} ?>><?php unset($attr6_icon);unset($attr6_align); ?><?php  $attr6_class='text';  $attr6_key='USER_LOGOUT';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($attr6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_key);unset($attr6_escape); ?><?php  ?></a><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?></table><?php  ?><?php  ?></body>
</html><?php  ?>