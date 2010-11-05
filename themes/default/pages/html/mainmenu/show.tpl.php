<?php $a1_class='menu'; ?><?php
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
<body class="menu" <?php if (@$conf['interface']['application_mode']) { ?> style="padding:0px;margin:0px;"<?php } ?> >
<?php /* Debug-Information */ if ($showDuration) { echo "<!-- Output Variables are:\n";echo str_replace('-->','-- >',print_r($this->templateVars,true));echo "\n-->";} ?><?php unset($a1_class) ?><?php $a2_class='mainmenu';$a2_width='100%';$a2_space='0';$a2_padding='5'; ?><?php
	$last_row_idx    = @$row_idx;
	$last_column_idx = @$column_idx;
	$row_idx    = 0;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="mainmenu" cellspacing="0" width="100%" cellpadding="5">
<?php unset($a2_class,$a2_width,$a2_space,$a2_padding) ?><?php $a3_true=! @$conf['interface']['application_mode']; ?><?php 
	if	(gettype($a3_true) === '' && gettype($a3_true) === '1')
		$a3_tmp_exec = $$a3_true == true;
	else
		$a3_tmp_exec = $a3_true == true;
	$a3_tmp_last_exec = $a3_tmp_exec;
	if	( $a3_tmp_exec )
	{
?>
<?php unset($a3_true) ?><?php $a4_class='title'; ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
 class="title"
>
<?php unset($a4_class) ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a6_equals='empty';$a6_value=$type;$a6_not=true; ?><?php 
	$a6_tmp_exec = $a6_equals == $a6_value;
	$a6_tmp_exec = !$a6_tmp_exec;
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_equals,$a6_value,$a6_not) ?><?php $a7_align='left';$a7_type=$type; ?><?php
	$a7_tmp_image_file = $image_dir.'icon_'.$a7_type.IMG_ICON_EXT;
	$a7_size = '16x16';
	$a7_tmp_title = basename($a7_tmp_image_file);
?><img alt="<?php echo $a7_tmp_title; if (isset($a7_size)) { echo ' ('; list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo $a7_tmp_width.'x'.$a7_tmp_height; echo')';} ?>" src="<?php echo $a7_tmp_image_file ?>" border="0"<?php if(isset($a7_align)) echo ' align="'.$a7_align.'"' ?><?php if (isset($a7_size)) { list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo ' width="'.$a7_tmp_width.'" height="'.$a7_tmp_height.'"';} ?>><?php unset($a7_align,$a7_type) ?><?php } ?><?php $a6_list='path';$a6_extract=true;$a6_key='list_key';$a6_value='xy'; ?><?php
	$a6_list_tmp_key   = $a6_key;
	$a6_list_tmp_value = $a6_value;
	$a6_list_extract   = $a6_extract;
	unset($a6_key);
	unset($a6_value);
	if	( !isset($$a6_list) || !is_array($$a6_list) )
		$$a6_list = array();
	foreach( $$a6_list as $$a6_list_tmp_key => $$a6_list_tmp_value )
	{
		if	( $a6_list_extract )
		{
			if	( !is_array($$a6_list_tmp_value) )
			{
				print_r($$a6_list_tmp_value);
				die( 'not an array at key: '.$$a6_list_tmp_key );
			}
			extract($$a6_list_tmp_value);
		}
?><?php unset($a6_list,$a6_extract,$a6_key,$a6_value) ?><?php $a7_title=$title;$a7_target='cms_main';$a7_url=$url;$a7_class='path'; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $a7_url;
?><a<?php if (isset($a7_name)) echo ' name="'.$a7_name.'"'; else echo ' href="'.$tmp_url.(isset($a7_anchor)?'#'.$a7_anchor:'').'"' ?> class="<?php echo $a7_class ?>" target="<?php echo $a7_target ?>"<?php if (isset($a7_accesskey)) echo ' accesskey="'.$a7_accesskey.'"' ?>  title="<?php echo encodeHtml($a7_title) ?>"><?php unset($a7_title,$a7_target,$a7_url,$a7_class) ?><?php $a8_class='text';$a8_var='name';$a8_maxlength='15';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = isset($$a8_var)?$$a8_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a8_maxlength),'..',constant('STR_PAD_'.strtoupper($a8_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_var,$a8_maxlength,$a8_escape,$a8_cut) ?></a><?php $a7_type='filesep'; ?><?php
	if ($a7_type=='filesep')
		echo '&nbsp;<strong>&raquo;</strong>&nbsp;';
	else
		echo "char error";
?><?php unset($a7_type) ?><?php } ?><?php $a6_title=$text;$a6_class='title';$a6_var='text';$a6_maxlength='20';$a6_escape=true;$a6_cut='both'; ?><?php
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a6_maxlength),'..',constant('STR_PAD_'.strtoupper($a6_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_title,$a6_class,$a6_var,$a6_maxlength,$a6_escape,$a6_cut) ?></td><?php $a5_style='text-align:right;';$a5_class='menu'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 style="text-align:right;"
 class="menu"
><?php unset($a5_style,$a5_class) ?><?php $a6_true=$this->search; ?><?php 
	if	(gettype($a6_true) === '' && gettype($a6_true) === '1')
		$a6_tmp_exec = $$a6_true == true;
	else
		$a6_tmp_exec = $a6_true == true;
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_true) ?><?php $a7_action='search';$a7_subaction='quicksearch';$a7_name='';$a7_target='cms_main_main';$a7_method='post';$a7_enctype='application/x-www-form-urlencoded'; ?><?php
		$a7_id = $this->getRequestId();
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$a7_method    = 'POST';
		}
		else
		{
			$a7_method    = 'GET';
			$a7_subaction = $subActionName;
		}
	}
?><form name="<?php echo $a7_name ?>"
      target="<?php echo $a7_target ?>"
      action="<?php echo Html::url( $a7_action,$a7_subaction,$a7_id ) ?>"
      method="<?php echo $a7_method ?>"
      enctype="<?php echo $a7_enctype ?>" style="margin:0px;padding:0px;">
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $a7_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $a7_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $a7_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($a7_action,$a7_subaction,$a7_name,$a7_target,$a7_method,$a7_enctype) ?><?php $a8_class='search';$a8_default='';$a8_type='text';$a8_name='search';$a8_size='15';$a8_maxlength='256';$a8_onchange='';$a8_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a8_readonly=true;
	  if ($a8_readonly && empty($$a8_name)) $$a8_name = '- '.lang('EMPTY').' -';
      if(!isset($a8_default)) $a8_default='';
      $tmp_value = Text::encodeHtml(isset($$a8_name)?$$a8_name:$a8_default);
?><?php if (!$a8_readonly || $a8_type=='hidden') {
?><input<?php if ($a8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" name="<?php echo $a8_name ?><?php if ($a8_readonly) echo '_disabled' ?>" type="<?php echo $a8_type ?>" size="<?php echo $a8_size ?>" maxlength="<?php echo $a8_maxlength ?>" class="<?php echo $a8_class ?>" value="<?php echo $tmp_value ?>" <?php if (in_array($a8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php
if	($a8_readonly) {
?><input type="hidden" id="id_<?php echo $a8_name ?>" name="<?php echo $a8_name ?>" value="<?php echo $tmp_value ?>" /><?php
 } } else { ?><span class="<?php echo $a8_class ?>"><?php echo $tmp_value ?></span><?php } ?><?php unset($a8_class,$a8_default,$a8_type,$a8_name,$a8_size,$a8_maxlength,$a8_onchange,$a8_readonly) ?><?php $a8_true=@$conf['search']['quicksearch']['show_button']; ?><?php 
	if	(gettype($a8_true) === '' && gettype($a8_true) === '1')
		$a8_tmp_exec = $$a8_true == true;
	else
		$a8_tmp_exec = $a8_true == true;
	$a8_tmp_last_exec = $a8_tmp_exec;
	if	( $a8_tmp_exec )
	{
?>
<?php unset($a8_true) ?><?php $a9_type='ok';$a9_class='searchbutton';$a9_value='ok';$a9_text='search'; ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$a9_text = 'MODE_EDIT';
		$a9_type = 'submit';
		if	( $this->isEditable() && readonly() )
			$a9_type = ''; // Knopf nicht anzeigen
		$a9_src  = '';
	if	( !empty($a9_type) ) {
?><input type="<?php echo $a9_type ?>"<?php if(isset($a9_src)) { ?> src="<?php echo $image_dir.'icon_'.$a9_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $a9_value ?>" class="searchbutton" title="<?php echo lang($a9_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($a9_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($a9_src)
?><?php } 
?><?php unset($a9_type,$a9_class,$a9_value,$a9_text) ?><?php } ?></form>
<?php } ?></td></tr><?php } ?><?php $a3_class='menu'; ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
 class="menu"
>
<?php unset($a3_class) ?><?php $a4_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a4_colspan) ?><?php $a5_class='submenu';$a5_width='100%';$a5_space='0px';$a5_padding='0px'; ?><?php
	$last_row_idx    = @$row_idx;
	$last_column_idx = @$column_idx;
	$row_idx    = 0;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="submenu" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a5_class,$a5_width,$a5_space,$a5_padding) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a7_list='windowMenu';$a7_extract=true;$a7_key='list_key';$a7_value='xy'; ?><?php
	$a7_list_tmp_key   = $a7_key;
	$a7_list_tmp_value = $a7_value;
	$a7_list_extract   = $a7_extract;
	unset($a7_key);
	unset($a7_value);
	if	( !isset($$a7_list) || !is_array($$a7_list) )
		$$a7_list = array();
	foreach( $$a7_list as $$a7_list_tmp_key => $$a7_list_tmp_value )
	{
		if	( $a7_list_extract )
		{
			if	( !is_array($$a7_list_tmp_value) )
			{
				print_r($$a7_list_tmp_value);
				die( 'not an array at key: '.$$a7_list_tmp_key );
			}
			extract($$a7_list_tmp_value);
		}
?><?php unset($a7_list,$a7_extract,$a7_key,$a7_value) ?><?php $a8_not=true;$a8_empty='url'; ?><?php 
	if	( !isset($$a8_empty) )
		$a8_tmp_exec = empty($a8_empty);
	elseif	( is_array($$a8_empty) )
		$a8_tmp_exec = (count($$a8_empty)==0);
	elseif	( is_bool($$a8_empty) )
		$a8_tmp_exec = true;
	else
		$a8_tmp_exec = empty( $$a8_empty );
	$a8_tmp_exec = !$a8_tmp_exec;
	$a8_tmp_last_exec = $a8_tmp_exec;
	if	( $a8_tmp_exec )
	{
?>
<?php unset($a8_not,$a8_empty) ?><?php $a9_class='action'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="action"
><?php unset($a9_class) ?><?php $a10_title=lang($title);$a10_target='cms_main_main';$a10_url=$url;$a10_class='';$a10_accesskey=$key; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $a10_url;
?><a<?php if (isset($a10_name)) echo ' name="'.$a10_name.'"'; else echo ' href="'.$tmp_url.(isset($a10_anchor)?'#'.$a10_anchor:'').'"' ?> class="<?php echo $a10_class ?>" target="<?php echo $a10_target ?>"<?php if (isset($a10_accesskey)) echo ' accesskey="'.$a10_accesskey.'"' ?>  title="<?php echo encodeHtml($a10_title) ?>"><?php unset($a10_title,$a10_target,$a10_url,$a10_class,$a10_accesskey) ?><?php $a11_class='text';$a11_key=$text;$a11_accesskey=$key;$a11_escape=true;$a11_cut='both'; ?><?php
		$a11_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a11_class ?>" title="<?php echo $a11_title ?>"><?php
		$langF = $a11_escape?'langHtml':'lang';
		$tmp_text = $langF($a11_key);
		$pos = strpos(strtolower($tmp_text),strtolower($a11_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a11_class,$a11_key,$a11_accesskey,$a11_escape,$a11_cut) ?></a></td><?php } ?><?php if (!$a8_tmp_last_exec) { ?>
<?php $a9_class='noaction'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="noaction"
><?php unset($a9_class) ?><?php $a10_class='text';$a10_key=$text;$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $langF($a10_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_key,$a10_escape,$a10_cut) ?></td><?php }
unset($a7_tmp_last_exec) ?><?php } ?></tr><?php
	$row_idx    = $last_row_idx;
	$column_idx = $last_column_idx;
?>
</table></td></tr><?php
	$row_idx    = $last_row_idx;
	$column_idx = $last_column_idx;
?>
</table></body>
</html>