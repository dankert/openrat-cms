<?php  $attr1_class='menu';  ?><?php
 if (!defined('OR_VERSION')) die('Forbidden');
 if (!headers_sent()) header('Content-Type: text/html; charset='.$charset)
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo isset($attr1_title)?$attr1_title.' - ':(isset($windowTitle)?langHtml($windowTitle).' - ':'') ?><?php echo $cms_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset ?>" >
<?php if ( isset($refresh_url) ) { ?>
  <meta http-equiv="refresh" content="<?php echo isset($refresh_timeout)?$refresh_timeout:0 ?>; URL=<?php echo $refresh_url ?>">
<?php } ?>
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
  <link rel="<?php echo $meta['name'] ?>" href="<?php echo $meta['url'] ?>" title="<?php echo $meta['title'] ?>" ><?php
      }
?><?php if(!empty($root_stylesheet)) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $root_stylesheet ?>" >
<?php } ?>
<?php if($root_stylesheet!=$user_stylesheet) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $user_stylesheet ?>" >
<?php } ?>
</head>
<body class="<?php echo $attr1_class ?>" <?php if (@$conf['interface']['application_mode']) { ?> style="padding:0px;margin:0px;"<?php } ?> >
<?php /* Debug-Information */ if ($showDuration) { echo "<!-- Output Variables are:\n";echo str_replace('-->','-- >',print_r($this->templateVars,true));echo "\n-->";} ?><?php unset($attr1_class); ?><?php  $attr2_width='100%';  $attr2_space='0';  $attr2_padding='5';  ?><?php
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
		$attr2_class='';
?><table class="<?php echo $attr2_class ?>" cellspacing="<?php echo $attr2_space ?>" width="<?php echo $attr2_width ?>" cellpadding="<?php echo $attr2_padding ?>"><?php unset($attr2_width);unset($attr2_space);unset($attr2_padding); ?><?php  $attr3_true=! @$conf['interface']['application_mode'];  ?><?php 
	if	(gettype($attr3_true) === '' && gettype($attr3_true) === '1')
		$attr3_tmp_exec = $$attr3_true == true;
	else
		$attr3_tmp_exec = $attr3_true == true;
	$attr3_tmp_last_exec = $attr3_tmp_exec;
	if	( $attr3_tmp_exec )
	{
?>
<?php unset($attr3_true); ?><?php  ?><?php
	$attr4_tmp_class='';
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php  ?><?php  $attr5_class='menu';  ?><?php
	if( isset($column_class_idx) )
	{
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
		$column_class=$column_classes[$column_class_idx-1];
		if (empty($attr5_class))
			$attr5_class=$column_class;
	}
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
		$attr5_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> class="<?php   echo $attr5_class   ?>" <?php
?>><?php unset($attr5_class); ?><?php  $attr6_align='left';  $attr6_type=$type;  ?><?php
	$attr6_tmp_image_file = $image_dir.'icon_'.$attr6_type.IMG_ICON_EXT;
	$attr6_size = '16x16';
	$attr6_tmp_title = basename($attr6_tmp_image_file);
?><img alt="<?php echo $attr6_tmp_title; if (isset($attr6_size)) { echo ' ('; list($attr6_tmp_width,$attr6_tmp_height)=explode('x',$attr6_size);echo $attr6_tmp_width.'x'.$attr6_tmp_height; echo')';} ?>" src="<?php echo $attr6_tmp_image_file ?>" border="0"<?php if(isset($attr6_align)) echo ' align="'.$attr6_align.'"' ?><?php if (isset($attr6_size)) { list($attr6_tmp_width,$attr6_tmp_height)=explode('x',$attr6_size);echo ' width="'.$attr6_tmp_width.'" height="'.$attr6_tmp_height.'"';} ?>><?php unset($attr6_align);unset($attr6_type); ?><?php  $attr6_list='path';  $attr6_extract=true;  $attr6_key='list_key';  $attr6_value='xy';  ?><?php
	$attr6_list_tmp_key   = $attr6_key;
	$attr6_list_tmp_value = $attr6_value;
	$attr6_list_extract   = $attr6_extract;
	unset($attr6_key);
	unset($attr6_value);
	if	( !isset($$attr6_list) || !is_array($$attr6_list) )
		$$attr6_list = array();
	foreach( $$attr6_list as $$attr6_list_tmp_key => $$attr6_list_tmp_value )
	{
		if	( $attr6_list_extract )
		{
			if	( !is_array($$attr6_list_tmp_value) )
			{
				print_r($$attr6_list_tmp_value);
				die( 'not an array at key: '.$$attr6_list_tmp_key );
			}
			extract($$attr6_list_tmp_value);
		}
?><?php unset($attr6_list);unset($attr6_extract);unset($attr6_key);unset($attr6_value); ?><?php  $attr7_title='title';  $attr7_target='cms_main';  $attr7_url=$url;  $attr7_class='path';  ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $attr7_url;
?><a<?php if (isset($attr7_name)) echo ' name="'.$attr7_name.'"'; else echo ' href="'.$tmp_url.(isset($attr7_anchor)?'#'.$attr7_anchor:'').'"' ?> class="<?php echo $attr7_class ?>" target="<?php echo $attr7_target ?>"<?php if (isset($attr7_accesskey)) echo ' accesskey="'.$attr7_accesskey.'"' ?>  title="<?php echo encodeHtml($attr7_title) ?>"><?php unset($attr7_title);unset($attr7_target);unset($attr7_url);unset($attr7_class); ?><?php  $attr8_class='text';  $attr8_var='name';  $attr8_maxlength='20';  $attr8_escape=true;  ?><?php
		$attr8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
		$langF = $attr8_escape?'langHtml':'lang';
		$tmp_text = isset($$attr8_var)?$$attr8_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength),'..',STR_PAD_BOTH );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_var);unset($attr8_maxlength);unset($attr8_escape); ?><?php  ?></a><?php  ?><?php  $attr7_type='filesep';  ?><?php
	if ($attr7_type=='filesep')
		echo '&nbsp;<strong>&raquo;</strong>&nbsp;';
	else
		echo "char error";
?><?php unset($attr7_type); ?><?php  ?><?php } ?><?php  ?><?php  $attr6_title=$text;  $attr6_class='title';  $attr6_var='text';  $attr6_maxlength='20';  $attr6_escape=true;  ?><?php
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = isset($$attr6_var)?$$attr6_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength),'..',STR_PAD_BOTH );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_title);unset($attr6_class);unset($attr6_var);unset($attr6_maxlength);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  ?><?php
	$attr3_tmp_class='';
	$attr3_last_class = $attr3_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr3_tmp_class));
?><?php  ?><?php  $attr4_class='subaction';  ?><?php
	if( isset($column_class_idx) )
	{
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
		$column_class=$column_classes[$column_class_idx-1];
		if (empty($attr4_class))
			$attr4_class=$column_class;
	}
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr4_rowspan) )
		$attr4_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> class="<?php   echo $attr4_class   ?>" <?php
?>><?php unset($attr4_class); ?><?php  $attr5_list='windowMenu';  $attr5_extract=true;  $attr5_key='list_key';  $attr5_value='list_value';  ?><?php
	$attr5_list_tmp_key   = $attr5_key;
	$attr5_list_tmp_value = $attr5_value;
	$attr5_list_extract   = $attr5_extract;
	unset($attr5_key);
	unset($attr5_value);
	if	( !isset($$attr5_list) || !is_array($$attr5_list) )
		$$attr5_list = array();
	foreach( $$attr5_list as $$attr5_list_tmp_key => $$attr5_list_tmp_value )
	{
		if	( $attr5_list_extract )
		{
			if	( !is_array($$attr5_list_tmp_value) )
			{
				print_r($$attr5_list_tmp_value);
				die( 'not an array at key: '.$$attr5_list_tmp_key );
			}
			extract($$attr5_list_tmp_value);
		}
?><?php unset($attr5_list);unset($attr5_extract);unset($attr5_key);unset($attr5_value); ?><?php  $attr6_not='';  $attr6_empty='url';  ?><?php 
	if	( !isset($$attr6_empty) )
		$attr6_tmp_exec = empty($attr6_empty);
	elseif	( is_array($$attr6_empty) )
		$attr6_tmp_exec = (count($$attr6_empty)==0);
	elseif	( is_bool($$attr6_empty) )
		$attr6_tmp_exec = true;
	else
		$attr6_tmp_exec = empty( $$attr6_empty );
	$attr6_tmp_exec = !$attr6_tmp_exec;
	$attr6_tmp_last_exec = $attr6_tmp_exec;
	if	( $attr6_tmp_exec )
	{
?>
<?php unset($attr6_not);unset($attr6_empty); ?><?php  $attr7_title=lang($title);  $attr7_target='_parent';  $attr7_url=$url;  $attr7_class='menu';  $attr7_accesskey=lang($key);  ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $attr7_url;
?><a<?php if (isset($attr7_name)) echo ' name="'.$attr7_name.'"'; else echo ' href="'.$tmp_url.(isset($attr7_anchor)?'#'.$attr7_anchor:'').'"' ?> class="<?php echo $attr7_class ?>" target="<?php echo $attr7_target ?>"<?php if (isset($attr7_accesskey)) echo ' accesskey="'.$attr7_accesskey.'"' ?>  title="<?php echo encodeHtml($attr7_title) ?>"><?php unset($attr7_title);unset($attr7_target);unset($attr7_url);unset($attr7_class);unset($attr7_accesskey); ?><?php  $attr8_class='text';  $attr8_key=$text;  $attr8_accesskey=lang($key);  $attr8_escape=true;  ?><?php
		$attr8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
		$langF = $attr8_escape?'langHtml':'lang';
		$tmp_text = $langF($attr8_key);
		$pos = strpos(strtolower($tmp_text),strtolower($attr8_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_key);unset($attr8_accesskey);unset($attr8_escape); ?><?php  ?></a><?php  ?><?php  ?><?php } ?><?php  ?><?php  ?><?php if (!$attr6_tmp_last_exec) { ?>
<?php  ?><?php  $attr7_class='menu_disabled';  $attr7_key=$text;  $attr7_accesskey=lang($key);  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($attr7_key);
		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_key);unset($attr7_accesskey);unset($attr7_escape); ?><?php  ?><?php }
unset($attr5_tmp_last_exec) ?><?php  ?><?php  $attr6_class='text';  $attr6_raw='__';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_raw);unset($attr6_escape); ?><?php  $attr6_var='url';  $attr6_value='';  ?><?php
	if (isset($attr6_key))
		$$attr6_var = $attr6_value[$attr6_key];
	else
		$$attr6_var = $attr6_value;
?><?php unset($attr6_var);unset($attr6_value); ?><?php  ?><?php } ?><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?></table><?php  ?><?php  ?></body>
</html><?php  ?>