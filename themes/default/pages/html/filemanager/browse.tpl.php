<?php $a1_class='main'; ?><?php
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
<body class="main" <?php if (@$conf['interface']['application_mode']) { ?> style="padding:0px;margin:0px;"<?php } ?> >
<?php /* Debug-Information */ if ($showDuration) { echo "<!-- Output Variables are:\n";echo str_replace('-->','-- >',print_r($this->templateVars,true));echo "\n-->";} ?><?php unset($a1_class) ?><?php $a2_class='main';$a2_width='100%';$a2_space='0px';$a2_padding='0px'; ?><?php
	$last_row_idx    = @$row_idx;
	$last_column_idx = @$column_idx;
	$row_idx    = 0;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="main" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a2_class,$a2_width,$a2_space,$a2_padding) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a4_class='window'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="window"
><?php unset($a4_class) ?><?php $a5_width='100%';$a5_space='0px';$a5_padding='0px'; ?><?php
	$last_row_idx    = @$row_idx;
	$last_column_idx = @$column_idx;
	$row_idx    = 0;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0px" width="100%" cellpadding="0px">
<?php unset($a5_width,$a5_space,$a5_padding) ?><?php $a6_list='notices';$a6_extract=true;$a6_key='list_key';$a6_value='list_value'; ?><?php
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
?><?php unset($a6_list,$a6_extract,$a6_key,$a6_value) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a8_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a8_colspan) ?><?php $a9_class='text';$a9_key=$key;$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_key,$a9_escape,$a9_cut) ?><br/></td></tr><?php } ?><?php $a6_present='up_url'; ?><?php 
	$a6_tmp_exec = isset($$a6_present);
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_present) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a8_width='50%';$a8_colspan='8'; ?><?php $column_idx++; ?><td
 width="50%"
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="8"
><?php unset($a8_width,$a8_colspan) ?><?php $a9_title='';$a9_target='_self';$a9_url=$up_url;$a9_class=''; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $a9_url;
?><a<?php if (isset($a9_name)) echo ' name="'.$a9_name.'"'; else echo ' href="'.$tmp_url.(isset($a9_anchor)?'#'.$a9_anchor:'').'"' ?> class="<?php echo $a9_class ?>" target="<?php echo $a9_target ?>"<?php if (isset($a9_accesskey)) echo ' accesskey="'.$a9_accesskey.'"' ?>  title="<?php echo encodeHtml($a9_title) ?>"><?php unset($a9_title,$a9_target,$a9_url,$a9_class) ?><?php $a10_align='left';$a10_type='folder'; ?><?php
	$a10_tmp_image_file = $image_dir.'icon_'.$a10_type.IMG_ICON_EXT;
	$a10_size = '16x16';
	$a10_tmp_title = basename($a10_tmp_image_file);
?><img alt="<?php echo $a10_tmp_title; if (isset($a10_size)) { echo ' ('; list($a10_tmp_width,$a10_tmp_height)=explode('x',$a10_size);echo $a10_tmp_width.'x'.$a10_tmp_height; echo')';} ?>" src="<?php echo $a10_tmp_image_file ?>" border="0"<?php if(isset($a10_align)) echo ' align="'.$a10_align.'"' ?><?php if (isset($a10_size)) { list($a10_tmp_width,$a10_tmp_height)=explode('x',$a10_size);echo ' width="'.$a10_tmp_width.'" height="'.$a10_tmp_height.'"';} ?>><?php unset($a10_align,$a10_type) ?><?php $a10_class='text';$a10_raw='__.._____________________';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a10_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_raw,$a10_escape,$a10_cut) ?></a></td></tr><?php } ?><?php $a6_class='headline'; ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
 class="headline"
>
<?php unset($a6_class) ?><?php $a7_class='help'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a7_class) ?><?php $a8_class='text';$a8_key='GLOBAL_TYPE';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?><?php $a8_class='text';$a8_raw='_/_';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a8_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_raw,$a8_escape,$a8_cut) ?><?php $a8_class='text';$a8_key='GLOBAL_NAME';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?></td><?php $a7_class='help'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a7_class) ?><?php $a8_class='text';$a8_key='GLOBAL_LASTCHANGE';$a8_escape=true;$a8_cut='both'; ?><?php
		$a8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a8_class ?>" title="<?php echo $a8_title ?>"><?php
		$langF = $a8_escape?'langHtml':'lang';
		$tmp_text = $langF($a8_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a8_class,$a8_key,$a8_escape,$a8_cut) ?></td></tr><?php $a6_list='object';$a6_extract=true;$a6_key='list_key';$a6_value='list_value'; ?><?php
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
?><?php unset($a6_list,$a6_extract,$a6_key,$a6_value) ?><?php $a7_class='data'; ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a7_class) ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a9_title=$desc;$a9_target='_self';$a9_url=$url;$a9_class=$class; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $a9_url;
?><a<?php if (isset($a9_name)) echo ' name="'.$a9_name.'"'; else echo ' href="'.$tmp_url.(isset($a9_anchor)?'#'.$a9_anchor:'').'"' ?> class="<?php echo $a9_class ?>" target="<?php echo $a9_target ?>"<?php if (isset($a9_accesskey)) echo ' accesskey="'.$a9_accesskey.'"' ?>  title="<?php echo encodeHtml($a9_title) ?>"><?php unset($a9_title,$a9_target,$a9_url,$a9_class) ?><?php $a10_align='left';$a10_type=$icon; ?><?php
	$a10_tmp_image_file = $image_dir.'icon_'.$a10_type.IMG_ICON_EXT;
	$a10_size = '16x16';
	$a10_tmp_title = basename($a10_tmp_image_file);
?><img alt="<?php echo $a10_tmp_title; if (isset($a10_size)) { echo ' ('; list($a10_tmp_width,$a10_tmp_height)=explode('x',$a10_size);echo $a10_tmp_width.'x'.$a10_tmp_height; echo')';} ?>" src="<?php echo $a10_tmp_image_file ?>" border="0"<?php if(isset($a10_align)) echo ' align="'.$a10_align.'"' ?><?php if (isset($a10_size)) { list($a10_tmp_width,$a10_tmp_height)=explode('x',$a10_size);echo ' width="'.$a10_tmp_width.'" height="'.$a10_tmp_height.'"';} ?>><?php unset($a10_align,$a10_type) ?><?php $a10_class='text';$a10_var='name';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = isset($$a10_var)?$$a10_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_var,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_raw='_';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a10_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_raw,$a10_escape,$a10_cut) ?></a></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a9_date=$date; ?><?php	
    global $conf;
	$time = $a9_date;
	if	( isset($_COOKIE['or_timezone_offset']) )
	{
		$time -= (int)date('Z');
		$time += ((int)$_COOKIE['or_timezone_offset']*60);
	}
	if	( $time==0)
		echo lang('GLOBAL_UNKNOWN');
	elseif ( !$conf['interface']['human_date_format'] )
	{
		echo '<span title="';
		$dl = date(lang('DATE_FORMAT_LONG'),$time);
		$dl = str_replace('{weekday}',lang('DATE_WEEKDAY'.strval(date('w',$time))),$dl);
		$dl = str_replace('{month}'  ,lang('DATE_MONTH'  .strval(date('n',$time))),$dl);
		echo $dl;
		unset($dl);
		echo '">';
		echo date(lang('DATE_FORMAT'),$time);
		echo '</span>';
	}
	else
	{
		$sekunden = time()-$time;
		$minuten = intval($sekunden/60);
		$stunden = intval($minuten /60);
		$tage    = intval($stunden /24);
		$monate  = intval($tage    /30);
		$jahre   = intval($monate  /12);
		echo '<span title="'.date(lang('DATE_FORMAT'),$time).'"">';
		if	( $time==0)
			echo lang('GLOBAL_UNKNOWN');
		elseif ( !$conf['interface']['human_date_format'] )
			echo date(lang('DATE_FORMAT'),$time);
		elseif	( $sekunden == 1 )
			echo $sekunden.' '.lang('GLOBAL_SECOND');
		elseif	( $sekunden < 60 )
			echo $sekunden.' '.lang('GLOBAL_SECONDS');
		elseif	( $minuten == 1 )
			echo $minuten.' '.lang('GLOBAL_MINUTE');
		elseif	( $minuten < 60 )
			echo $minuten.' '.lang('GLOBAL_MINUTES');
		elseif	( $stunden == 1 )
			echo $stunden.' '.lang('GLOBAL_HOUR');
		elseif	( $stunden < 60 )
			echo $stunden.' '.lang('GLOBAL_HOURS');
		elseif	( $tage == 1 )
			echo $tage.' '.lang('GLOBAL_DAY');
		elseif	( $tage < 60 )
			echo $tage.' '.lang('GLOBAL_DAYS');
		elseif	( $monate == 1 )
			echo $monate.' '.lang('GLOBAL_MONTH');
		elseif	( $monate < 12 )
			echo $monate.' '.lang('GLOBAL_MONTHS');
		elseif	( $jahre == 1 )
			echo $jahre.' '.lang('GLOBAL_YEAR');
		else
			echo $jahre.' '.lang('GLOBAL_YEARS');
		echo '</span>';
	}
?><?php unset($a9_date) ?></td></tr><?php } ?><?php $a6_empty='object'; ?><?php 
	if	( !isset($$a6_empty) )
		$a6_tmp_exec = empty($a6_empty);
	elseif	( is_array($$a6_empty) )
		$a6_tmp_exec = (count($$a6_empty)==0);
	elseif	( is_bool($$a6_empty) )
		$a6_tmp_exec = true;
	else
		$a6_tmp_exec = empty( $$a6_empty );
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_empty) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a8_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a8_colspan) ?><?php $a9_class='text';$a9_text='GLOBAL_NOT_FOUND';$a9_escape=true;$a9_cut='both'; ?><?php
		$a9_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a9_class ?>" title="<?php echo $a9_title ?>"><?php
		$langF = $a9_escape?'langHtml':'lang';
		$tmp_text = $langF($a9_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a9_class,$a9_text,$a9_escape,$a9_cut) ?></td></tr><?php } ?><?php $a6_true=$writable; ?><?php 
	if	(gettype($a6_true) === '' && gettype($a6_true) === '1')
		$a6_tmp_exec = $$a6_true == true;
	else
		$a6_tmp_exec = $a6_true == true;
	$a6_tmp_last_exec = $a6_tmp_exec;
	if	( $a6_tmp_exec )
	{
?>
<?php unset($a6_true) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a8_class='act'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="act"
><?php unset($a8_class) ?><br/><?php $a9_action='filemanager';$a9_subaction='upload';$a9_id=$id;$a9_name='';$a9_target='_self';$a9_method='post';$a9_enctype='multipart/form-data'; ?><?php
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$a9_method    = 'POST';
		}
		else
		{
			$a9_method    = 'GET';
			$a9_subaction = $subActionName;
		}
	}
?><form name="<?php echo $a9_name ?>"
      target="<?php echo $a9_target ?>"
      action="<?php echo Html::url( $a9_action,$a9_subaction,$a9_id ) ?>"
      method="<?php echo $a9_method ?>"
      enctype="<?php echo $a9_enctype ?>" style="margin:0px;padding:0px;">
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $a9_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $a9_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $a9_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($a9_action,$a9_subaction,$a9_id,$a9_name,$a9_target,$a9_method,$a9_enctype) ?><?php $a10_name='CKEditorFuncNum'; ?><?php
if (isset($$a10_name))
	$a10_tmp_value = $$a10_name;
elseif ( isset($a10_default) )
	$a10_tmp_value = $a10_default;
else
	$a10_tmp_value = "";
?><input type="hidden" name="<?php echo $a10_name ?>" value="<?php echo $a10_tmp_value ?>" /><?php unset($a10_name) ?><?php $a10_class='text';$a10_key='file';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $langF($a10_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_key,$a10_escape,$a10_cut) ?><?php $a10_name='file';$a10_class='upload';$a10_size='40'; ?><input size="<?php echo $a10_size ?>" id="id_<?php echo $a10_name ?>" type="file" <?php if (isset($a10_maxlength))echo ' maxlength="'.$a10_maxlength.'"' ?> name="<?php echo $a10_name ?>" class="<?php echo $a10_class ?>" <?php if (in_array($a10_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php unset($a10_name,$a10_class,$a10_size) ?><br/><?php $a10_type='ok';$a10_class='ok';$a10_value='ok';$a10_text='add'; ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$a10_text = 'MODE_EDIT';
		$a10_type = 'submit';
		if	( $this->isEditable() && readonly() )
			$a10_type = ''; // Knopf nicht anzeigen
		$a10_src  = '';
	if	( !empty($a10_type) ) {
?><input type="<?php echo $a10_type ?>"<?php if(isset($a10_src)) { ?> src="<?php echo $image_dir.'icon_'.$a10_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $a10_value ?>" class="ok" title="<?php echo lang($a10_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($a10_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($a10_src)
?><?php } 
?><?php unset($a10_type,$a10_class,$a10_value,$a10_text) ?></form>
</td><?php $a8_class='act'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="act"
><?php unset($a8_class) ?><?php $a9_var='name';$a9_value=''; ?><?php
	if (isset($a9_key))
		$$a9_var = $a9_value[$a9_key];
	else
		$$a9_var = $a9_value;
?><?php unset($a9_var,$a9_value) ?><?php $a9_action='filemanager';$a9_subaction='addfolder';$a9_id=$id;$a9_name='';$a9_target='_self';$a9_method='post';$a9_enctype='application/x-www-form-urlencoded'; ?><?php
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$a9_method    = 'POST';
		}
		else
		{
			$a9_method    = 'GET';
			$a9_subaction = $subActionName;
		}
	}
?><form name="<?php echo $a9_name ?>"
      target="<?php echo $a9_target ?>"
      action="<?php echo Html::url( $a9_action,$a9_subaction,$a9_id ) ?>"
      method="<?php echo $a9_method ?>"
      enctype="<?php echo $a9_enctype ?>" style="margin:0px;padding:0px;">
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $a9_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $a9_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $a9_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($a9_action,$a9_subaction,$a9_id,$a9_name,$a9_target,$a9_method,$a9_enctype) ?><?php $a10_name='CKEditorFuncNum'; ?><?php
if (isset($$a10_name))
	$a10_tmp_value = $$a10_name;
elseif ( isset($a10_default) )
	$a10_tmp_value = $a10_default;
else
	$a10_tmp_value = "";
?><input type="hidden" name="<?php echo $a10_name ?>" value="<?php echo $a10_tmp_value ?>" /><?php unset($a10_name) ?><?php $a10_class='text';$a10_key='name';$a10_escape=true;$a10_cut='both'; ?><?php
		$a10_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a10_class ?>" title="<?php echo $a10_title ?>"><?php
		$langF = $a10_escape?'langHtml':'lang';
		$tmp_text = $langF($a10_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a10_class,$a10_key,$a10_escape,$a10_cut) ?><?php $a10_class='text';$a10_default='';$a10_type='text';$a10_name='name';$a10_size='40';$a10_maxlength='256';$a10_onchange='';$a10_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a10_readonly=true;
	  if ($a10_readonly && empty($$a10_name)) $$a10_name = '- '.lang('EMPTY').' -';
      if(!isset($a10_default)) $a10_default='';
?><?php if (!$a10_readonly || $a10_type=='hidden') {
?><input<?php if ($a10_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a10_name ?><?php if ($a10_readonly) echo '_disabled' ?>" name="<?php echo $a10_name ?><?php if ($a10_readonly) echo '_disabled' ?>" type="<?php echo $a10_type ?>" size="<?php echo $a10_size ?>" maxlength="<?php echo $a10_maxlength ?>" class="<?php echo $a10_class ?>" value="<?php echo isset($$a10_name)?$$a10_name:$a10_default ?>" <?php if (in_array($a10_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($a10_readonly) {
?><input type="hidden" id="id_<?php echo $a10_name ?>" name="<?php echo $a10_name ?>" value="<?php echo isset($$a10_name)?$$a10_name:$a10_default ?>" /><?php
 } } else { ?><span class="<?php echo $a10_class ?>"><?php echo isset($$a10_name)?$$a10_name:$a10_default ?></span><?php } ?><?php unset($a10_class,$a10_default,$a10_type,$a10_name,$a10_size,$a10_maxlength,$a10_onchange,$a10_readonly) ?><br/><?php $a10_type='ok';$a10_class='ok';$a10_value='ok';$a10_text='add'; ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$a10_text = 'MODE_EDIT';
		$a10_type = 'submit';
		if	( $this->isEditable() && readonly() )
			$a10_type = ''; // Knopf nicht anzeigen
		$a10_src  = '';
	if	( !empty($a10_type) ) {
?><input type="<?php echo $a10_type ?>"<?php if(isset($a10_src)) { ?> src="<?php echo $image_dir.'icon_'.$a10_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $a10_value ?>" class="ok" title="<?php echo lang($a10_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($a10_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($a10_src)
?><?php } 
?><?php unset($a10_type,$a10_class,$a10_value,$a10_text) ?></form>
</td></tr><?php } ?><?php
	$row_idx    = $last_row_idx;
	$column_idx = $last_column_idx;
?>
</table></td></tr><?php
	$row_idx    = $last_row_idx;
	$column_idx = $last_column_idx;
?>
</table></body>
</html>