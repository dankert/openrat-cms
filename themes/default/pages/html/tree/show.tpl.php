<?php $a1_class='tree'; ?><?php
 if (!defined('OR_VERSION')) die('Forbidden');
 if (!headers_sent()) header('Content-Type: text/html; charset='.$charset)
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo isset($a1_title)?langHtml($a1_title).' - ':(isset($windowTitle)?langHtml($windowTitle).' - ':'') ?><?php echo $cms_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset ?>" >
<?php if ( isset($refresh_url) ) { ?>
  <meta http-equiv="refresh" content="<?php echo isset($refresh_timeout)?$refresh_timeout:0 ?>; URL=<?php echo $refresh_url; if (ini_get('session.use_trans_sid')) echo '&'.session_name().'='.session_id(); ?>">
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
<body class="tree" <?php if (@$conf['interface']['application_mode']) { ?> style="padding:0px;margin:0px;"<?php } ?> >
<?php /* Debug-Information */ if ($showDuration) { echo "<!-- Output Variables are:\n";echo str_replace('-->','-- >',print_r($this->templateVars,true));echo "\n-->";} ?><?php unset($a1_class) ?><?php $a2_class='tree';$a2_width='100%';$a2_space='0';$a2_padding='0'; ?><?php
	$last_row_idx    = @$row_idx;
	$last_column_idx = @$column_idx;
	$row_idx    = 0;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="tree" cellspacing="0" width="100%" cellpadding="0">
<?php unset($a2_class,$a2_width,$a2_space,$a2_padding) ?><?php $a3_list='zeilen';$a3_extract=true;$a3_key='list_key';$a3_value='list_value'; ?><?php
	$a3_list_tmp_key   = $a3_key;
	$a3_list_tmp_value = $a3_value;
	$a3_list_extract   = $a3_extract;
	unset($a3_key);
	unset($a3_value);
	if	( !isset($$a3_list) || !is_array($$a3_list) )
		$$a3_list = array();
	foreach( $$a3_list as $$a3_list_tmp_key => $$a3_list_tmp_value )
	{
		if	( $a3_list_extract )
		{
			if	( !is_array($$a3_list_tmp_value) )
			{
				print_r($$a3_list_tmp_value);
				die( 'not an array at key: '.$$a3_list_tmp_key );
			}
			extract($$a3_list_tmp_value);
		}
?><?php unset($a3_list,$a3_extract,$a3_key,$a3_value) ?><?php $a4_class=$class; ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
 class="<?php echo $class ?>"
>
<?php unset($a4_class) ?><?php $a5_list='cols';$a5_extract=false;$a5_key='list_key';$a5_value='i'; ?><?php
	$a5_list_tmp_key   = $a5_key;
	$a5_list_tmp_value = $a5_value;
	$a5_list_extract   = $a5_extract;
	unset($a5_key);
	unset($a5_value);
	if	( !isset($$a5_list) || !is_array($$a5_list) )
		$$a5_list = array();
	foreach( $$a5_list as $$a5_list_tmp_key => $$a5_list_tmp_value )
	{
		if	( $a5_list_extract )
		{
			if	( !is_array($$a5_list_tmp_value) )
			{
				print_r($$a5_list_tmp_value);
				die( 'not an array at key: '.$$a5_list_tmp_key );
			}
			extract($$a5_list_tmp_value);
		}
?><?php unset($a5_list,$a5_extract,$a5_key,$a5_value) ?><?php $a6_class='treecol'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="treecol"
><?php unset($a6_class) ?><?php $a7_align='left';$a7_tree=$i; ?><?php
	$a7_tmp_image_file = $image_dir.'tree_'.$a7_tree.IMG_EXT;
	$a7_size = '18x18';
	$a7_tmp_title = basename($a7_tmp_image_file);
?><img alt="<?php echo $a7_tmp_title; if (isset($a7_size)) { echo ' ('; list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo $a7_tmp_width.'x'.$a7_tmp_height; echo')';} ?>" src="<?php echo $a7_tmp_image_file ?>" border="0"<?php if(isset($a7_align)) echo ' align="'.$a7_align.'"' ?><?php if (isset($a7_size)) { list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo ' width="'.$a7_tmp_width.'" height="'.$a7_tmp_height.'"';} ?>><?php unset($a7_align,$a7_tree) ?></td><?php } ?><?php $a5_present='image'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php $a6_class='treeimage'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="treeimage"
><?php unset($a6_class) ?><?php $a7_present='image_url'; ?><?php 
	$a7_tmp_exec = isset($$a7_present);
	$a7_tmp_last_exec = $a7_tmp_exec;
	if	( $a7_tmp_exec )
	{
?>
<?php unset($a7_present) ?><?php $a8_title=$image_url_desc;$a8_target='_self';$a8_url=$image_url;$a8_class='tree';$a8_anchor=$name; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $a8_url;
?><a<?php if (isset($a8_name)) echo ' name="'.$a8_name.'"'; else echo ' href="'.$tmp_url.(isset($a8_anchor)?'#'.$a8_anchor:'').'"' ?> class="<?php echo $a8_class ?>" target="<?php echo $a8_target ?>"<?php if (isset($a8_accesskey)) echo ' accesskey="'.$a8_accesskey.'"' ?>  title="<?php echo encodeHtml($a8_title) ?>"><?php unset($a8_title,$a8_target,$a8_url,$a8_class,$a8_anchor) ?><?php $a9_align='left';$a9_tree=$image; ?><?php
	$a9_tmp_image_file = $image_dir.'tree_'.$a9_tree.IMG_EXT;
	$a9_size = '18x18';
	$a9_tmp_title = basename($a9_tmp_image_file);
?><img alt="<?php echo $a9_tmp_title; if (isset($a9_size)) { echo ' ('; list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo $a9_tmp_width.'x'.$a9_tmp_height; echo')';} ?>" src="<?php echo $a9_tmp_image_file ?>" border="0"<?php if(isset($a9_align)) echo ' align="'.$a9_align.'"' ?><?php if (isset($a9_size)) { list($a9_tmp_width,$a9_tmp_height)=explode('x',$a9_size);echo ' width="'.$a9_tmp_width.'" height="'.$a9_tmp_height.'"';} ?>><?php unset($a9_align,$a9_tree) ?></a><?php } ?><?php if (!$a7_tmp_last_exec) { ?>
<?php $a8_align='left';$a8_tree=$image; ?><?php
	$a8_tmp_image_file = $image_dir.'tree_'.$a8_tree.IMG_EXT;
	$a8_size = '18x18';
	$a8_tmp_title = basename($a8_tmp_image_file);
?><img alt="<?php echo $a8_tmp_title; if (isset($a8_size)) { echo ' ('; list($a8_tmp_width,$a8_tmp_height)=explode('x',$a8_size);echo $a8_tmp_width.'x'.$a8_tmp_height; echo')';} ?>" src="<?php echo $a8_tmp_image_file ?>" border="0"<?php if(isset($a8_align)) echo ' align="'.$a8_align.'"' ?><?php if (isset($a8_size)) { list($a8_tmp_width,$a8_tmp_height)=explode('x',$a8_size);echo ' width="'.$a8_tmp_width.'" height="'.$a8_tmp_height.'"';} ?>><?php unset($a8_align,$a8_tree) ?><?php }
unset($a6_tmp_last_exec) ?></td><?php } ?><?php $a5_class='treevalue';$a5_colspan=$colspan; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="treevalue"
 colspan="<?php echo $colspan ?>"
><?php unset($a5_class,$a5_colspan) ?><?php $a6_title='';$a6_target='_self';$a6_class='';$a6_name=$name; ?><?php
	$params = array();
	$tmp_url = '';
?><a<?php if (isset($a6_name)) echo ' name="'.$a6_name.'"'; else echo ' href="'.$tmp_url.(isset($a6_anchor)?'#'.$a6_anchor:'').'"' ?> class="<?php echo $a6_class ?>" target="<?php echo $a6_target ?>"<?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_target,$a6_class,$a6_name) ?></a><?php $a6_present='url'; ?><?php 
	$a6_tmp_exec = isset($$a6_present);
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_present) ?><?php $a7_title=$desc;$a7_target=$target;$a7_url=$url;$a7_class='tree'; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $a7_url;
?><a<?php if (isset($a7_name)) echo ' name="'.$a7_name.'"'; else echo ' href="'.$tmp_url.(isset($a7_anchor)?'#'.$a7_anchor:'').'"' ?> class="<?php echo $a7_class ?>" target="<?php echo $a7_target ?>"<?php if (isset($a7_accesskey)) echo ' accesskey="'.$a7_accesskey.'"' ?>  title="<?php echo encodeHtml($a7_title) ?>"><?php unset($a7_title,$a7_target,$a7_url,$a7_class) ?><?php $a8_icon=$icon;$a8_align='left'; ?><?php
	$a8_tmp_image_file = $image_dir.'icon_'.$a8_icon.IMG_ICON_EXT;
	$a8_size = '16x16';
	$a8_tmp_title = basename($a8_tmp_image_file);
?><img alt="<?php echo $a8_tmp_title; if (isset($a8_size)) { echo ' ('; list($a8_tmp_width,$a8_tmp_height)=explode('x',$a8_size);echo $a8_tmp_width.'x'.$a8_tmp_height; echo')';} ?>" src="<?php echo $a8_tmp_image_file ?>" border="0"<?php if(isset($a8_align)) echo ' align="'.$a8_align.'"' ?><?php if (isset($a8_size)) { list($a8_tmp_width,$a8_tmp_height)=explode('x',$a8_size);echo ' width="'.$a8_tmp_width.'" height="'.$a8_tmp_height.'"';} ?>><?php unset($a8_icon,$a8_align) ?><?php $a8_class='text';$a8_var='text';$a8_maxlength='20';$a8_escape=true;$a8_cut='right'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = isset($$a8_var)?$$a8_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a8_maxlength),'..',constant('STR_PAD_'.strtoupper($a8_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_var,$a8_maxlength,$a8_escape,$a8_cut) ?></a><?php } ?><?php if (!$a6_tmp_last_exec) { ?>
<?php $a7_icon=$icon;$a7_align='left'; ?><?php
	$a7_tmp_image_file = $image_dir.'icon_'.$a7_icon.IMG_ICON_EXT;
	$a7_size = '16x16';
	$a7_tmp_title = basename($a7_tmp_image_file);
?><img alt="<?php echo $a7_tmp_title; if (isset($a7_size)) { echo ' ('; list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo $a7_tmp_width.'x'.$a7_tmp_height; echo')';} ?>" src="<?php echo $a7_tmp_image_file ?>" border="0"<?php if(isset($a7_align)) echo ' align="'.$a7_align.'"' ?><?php if (isset($a7_size)) { list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo ' width="'.$a7_tmp_width.'" height="'.$a7_tmp_height.'"';} ?>><?php unset($a7_icon,$a7_align) ?><?php $a7_title=$desc;$a7_class='text';$a7_var='text';$a7_maxlength='20';$a7_escape=true;$a7_cut='right'; ?><?php
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a7_maxlength),'..',constant('STR_PAD_'.strtoupper($a7_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_title,$a7_class,$a7_var,$a7_maxlength,$a7_escape,$a7_cut) ?><?php }
unset($a5_tmp_last_exec) ?><?php $a6_not='';$a6_present='image'; ?><?php 
	$a6_tmp_exec = isset($$a6_present);
	$a6_tmp_exec = !$a6_tmp_exec;
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_not,$a6_present) ?><?php $a7_class='text';$a7_raw='__';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a7_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_raw,$a7_escape,$a7_cut) ?><?php $a7_title='';$a7_target='_self';$a7_class='';$a7_action='tree';$a7_subaction='refresh'; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = Html::url($a7_action,$a7_subaction,!empty($a7_id)?$a7_id:$this->getRequestId(),$params);
?><a<?php if (isset($a7_name)) echo ' name="'.$a7_name.'"'; else echo ' href="'.$tmp_url.(isset($a7_anchor)?'#'.$a7_anchor:'').'"' ?> class="<?php echo $a7_class ?>" target="<?php echo $a7_target ?>"<?php if (isset($a7_accesskey)) echo ' accesskey="'.$a7_accesskey.'"' ?>  title="<?php echo encodeHtml($a7_title) ?>"><?php unset($a7_title,$a7_target,$a7_class,$a7_action,$a7_subaction) ?><?php $a8_class='text';$a8_key='refresh';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?></a><?php $a7_class='text';$a7_raw='__';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a7_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_raw,$a7_escape,$a7_cut) ?><?php $a7_title='';$a7_target='_self';$a7_class='';$a7_action='tree';$a7_subaction='openall'; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = Html::url($a7_action,$a7_subaction,!empty($a7_id)?$a7_id:$this->getRequestId(),$params);
?><a<?php if (isset($a7_name)) echo ' name="'.$a7_name.'"'; else echo ' href="'.$tmp_url.(isset($a7_anchor)?'#'.$a7_anchor:'').'"' ?> class="<?php echo $a7_class ?>" target="<?php echo $a7_target ?>"<?php if (isset($a7_accesskey)) echo ' accesskey="'.$a7_accesskey.'"' ?>  title="<?php echo encodeHtml($a7_title) ?>"><?php unset($a7_title,$a7_target,$a7_class,$a7_action,$a7_subaction) ?><?php $a8_class='text';$a8_key='all';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?></a><?php } ?></td><?php $a5_var='url'; ?><?php
	if (!isset($a5_value))
		unset($$a5_var);
?><?php unset($a5_var) ?><?php $a5_var='image'; ?><?php
	if (!isset($a5_value))
		unset($$a5_var);
?><?php unset($a5_var) ?></tr><?php } ?><?php
	$row_idx    = $last_row_idx;
	$column_idx = $last_column_idx;
?>
</table></body>
</html>