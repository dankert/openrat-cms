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
<?php unset($a2_class,$a2_width,$a2_space,$a2_padding) ?><?php $a3_list='notices';$a3_extract=true;$a3_key='list_key';$a3_value='list_value'; ?><?php
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
?><?php unset($a3_list,$a3_extract,$a3_key,$a3_value) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a5_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a5_colspan) ?><?php $a6_class='text';$a6_key=$key;$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?><br/></td></tr><?php } ?><?php $a3_present='up_url'; ?><?php 
	$a3_tmp_exec = isset($$a3_present);
	$a3_tmp_last_exec = $a3_tmp_exec;
	if	( $a3_tmp_exec )
	{
?>
<?php unset($a3_present) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a5_width='50%';$a5_colspan='8'; ?><?php $column_idx++; ?><td
 width="50%"
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="8"
><?php unset($a5_width,$a5_colspan) ?><?php $a6_title='';$a6_target='_self';$a6_url=$up_url;$a6_class=''; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $a6_url;
?><a<?php if (isset($a6_name)) echo ' name="'.$a6_name.'"'; else echo ' href="'.$tmp_url.(isset($a6_anchor)?'#'.$a6_anchor:'').'"' ?> class="<?php echo $a6_class ?>" target="<?php echo $a6_target ?>"<?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_target,$a6_url,$a6_class) ?><?php $a7_align='left';$a7_type='folder'; ?><?php
	$a7_tmp_image_file = $image_dir.'icon_'.$a7_type.IMG_ICON_EXT;
	$a7_size = '16x16';
	$a7_tmp_title = basename($a7_tmp_image_file);
?><img alt="<?php echo $a7_tmp_title; if (isset($a7_size)) { echo ' ('; list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo $a7_tmp_width.'x'.$a7_tmp_height; echo')';} ?>" src="<?php echo $a7_tmp_image_file ?>" border="0"<?php if(isset($a7_align)) echo ' align="'.$a7_align.'"' ?><?php if (isset($a7_size)) { list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo ' width="'.$a7_tmp_width.'" height="'.$a7_tmp_height.'"';} ?>><?php unset($a7_align,$a7_type) ?><?php $a7_class='text';$a7_raw='__.._____________________';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a7_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_raw,$a7_escape,$a7_cut) ?></a></td></tr><?php } ?><?php $a3_class='headline'; ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
 class="headline"
>
<?php unset($a3_class) ?><?php $a4_class='help'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a4_class) ?><?php $a5_class='text';$a5_key='GLOBAL_TYPE';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?><?php $a5_class='text';$a5_raw='_/_';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a5_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_raw,$a5_escape,$a5_cut) ?><?php $a5_class='text';$a5_key='GLOBAL_NAME';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?></td><?php $a4_class='help'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
 class="help"
><?php unset($a4_class) ?><?php $a5_class='text';$a5_key='GLOBAL_LASTCHANGE';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = $langF($a5_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_key,$a5_escape,$a5_cut) ?></td></tr><?php $a3_list='object';$a3_extract=true;$a3_key='list_key';$a3_value='list_value'; ?><?php
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
?><?php unset($a3_list,$a3_extract,$a3_key,$a3_value) ?><?php $a4_class='data'; ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
 class="data"
>
<?php unset($a4_class) ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a6_title=$desc;$a6_target='_self';$a6_url=$url;$a6_class=$class; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $a6_url;
?><a<?php if (isset($a6_name)) echo ' name="'.$a6_name.'"'; else echo ' href="'.$tmp_url.(isset($a6_anchor)?'#'.$a6_anchor:'').'"' ?> class="<?php echo $a6_class ?>" target="<?php echo $a6_target ?>"<?php if (isset($a6_accesskey)) echo ' accesskey="'.$a6_accesskey.'"' ?>  title="<?php echo encodeHtml($a6_title) ?>"><?php unset($a6_title,$a6_target,$a6_url,$a6_class) ?><?php $a7_align='left';$a7_type=$icon; ?><?php
	$a7_tmp_image_file = $image_dir.'icon_'.$a7_type.IMG_ICON_EXT;
	$a7_size = '16x16';
	$a7_tmp_title = basename($a7_tmp_image_file);
?><img alt="<?php echo $a7_tmp_title; if (isset($a7_size)) { echo ' ('; list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo $a7_tmp_width.'x'.$a7_tmp_height; echo')';} ?>" src="<?php echo $a7_tmp_image_file ?>" border="0"<?php if(isset($a7_align)) echo ' align="'.$a7_align.'"' ?><?php if (isset($a7_size)) { list($a7_tmp_width,$a7_tmp_height)=explode('x',$a7_size);echo ' width="'.$a7_tmp_width.'" height="'.$a7_tmp_height.'"';} ?>><?php unset($a7_align,$a7_type) ?><?php $a7_class='text';$a7_var='name';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = isset($$a7_var)?$$a7_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_var,$a7_escape,$a7_cut) ?><?php $a7_class='text';$a7_raw='_';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a7_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_raw,$a7_escape,$a7_cut) ?></a></td><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
><?php $a6_date=$date; ?><?php	
    global $conf;
	$time = $a6_date;
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
?><?php unset($a6_date) ?></td></tr><?php } ?><?php $a3_empty='object'; ?><?php 
	if	( !isset($$a3_empty) )
		$a3_tmp_exec = empty($a3_empty);
	elseif	( is_array($$a3_empty) )
		$a3_tmp_exec = (count($$a3_empty)==0);
	elseif	( is_bool($$a3_empty) )
		$a3_tmp_exec = true;
	else
		$a3_tmp_exec = empty( $$a3_empty );
	$a3_tmp_last_exec = $a3_tmp_exec;
	if	( $a3_tmp_exec )
	{
?>
<?php unset($a3_empty) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a5_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a5_colspan) ?><?php $a6_class='text';$a6_text='GLOBAL_NOT_FOUND';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_text,$a6_escape,$a6_cut) ?></td></tr><?php } ?><?php $a3_true=$writable; ?><?php 
	if	(gettype($a3_true) === '' && gettype($a3_true) === '1')
		$a3_tmp_exec = $$a3_true == true;
	else
		$a3_tmp_exec = $a3_true == true;
	$a3_tmp_last_exec = $a3_tmp_exec;
	if	( $a3_tmp_exec )
	{
?>
<?php unset($a3_true) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a5_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a5_colspan) ?><br/><br/><?php $a6_title=lang('file'); ?><fieldset><?php if(isset($a6_title)) { ?><legend><?php echo encodeHtml($a6_title) ?></legend><?php } ?><?php unset($a6_title) ?></fieldset></td></tr><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a5_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a5_colspan) ?><?php $a6_action='filemanager';$a6_subaction='upload';$a6_id=$id;$a6_name='';$a6_target='_self';$a6_method='post';$a6_enctype='multipart/form-data'; ?><?php
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$a6_method    = 'POST';
		}
		else
		{
			$a6_method    = 'GET';
			$a6_subaction = $subActionName;
		}
	}
?><form name="<?php echo $a6_name ?>"
      target="<?php echo $a6_target ?>"
      action="<?php echo Html::url( $a6_action,$a6_subaction,$a6_id ) ?>"
      method="<?php echo $a6_method ?>"
      enctype="<?php echo $a6_enctype ?>" style="margin:0px;padding:0px;">
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $a6_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $a6_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $a6_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($a6_action,$a6_subaction,$a6_id,$a6_name,$a6_target,$a6_method,$a6_enctype) ?><?php $a7_name='CKEditorFuncNum'; ?><?php
if (isset($$a7_name))
	$a7_tmp_value = $$a7_name;
elseif ( isset($a7_default) )
	$a7_tmp_value = $a7_default;
else
	$a7_tmp_value = "";
?><input type="hidden" name="<?php echo $a7_name ?>" value="<?php echo $a7_tmp_value ?>" /><?php unset($a7_name) ?><?php $a7_name='file';$a7_class='upload';$a7_size='40'; ?><input size="<?php echo $a7_size ?>" id="id_<?php echo $a7_name ?>" type="file" <?php if (isset($a7_maxlength))echo ' maxlength="'.$a7_maxlength.'"' ?> name="<?php echo $a7_name ?>" class="<?php echo $a7_class ?>" <?php if (in_array($a7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php unset($a7_name,$a7_class,$a7_size) ?><?php $a7_type='ok';$a7_class='ok';$a7_value='ok';$a7_text='add'; ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$a7_text = 'MODE_EDIT';
		$a7_type = 'submit';
		if	( $this->isEditable() && readonly() )
			$a7_type = ''; // Knopf nicht anzeigen
		$a7_src  = '';
	if	( !empty($a7_type) ) {
?><input type="<?php echo $a7_type ?>"<?php if(isset($a7_src)) { ?> src="<?php echo $image_dir.'icon_'.$a7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $a7_value ?>" class="ok" title="<?php echo lang($a7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($a7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($a7_src)
?><?php } 
?><?php unset($a7_type,$a7_class,$a7_value,$a7_text) ?></form>
</td></tr><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a5_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a5_colspan) ?><br/><br/><?php $a6_title=lang('folder'); ?><fieldset><?php if(isset($a6_title)) { ?><legend><?php echo encodeHtml($a6_title) ?></legend><?php } ?><?php unset($a6_title) ?></fieldset></td></tr><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a5_colspan='2'; ?><?php $column_idx++; ?><td
<?php if (!empty($column_widths)) { ?>
 width="<?php echo $column_widths[($column_idx-1)%count($column_widths)] ?>"
<?php } ?>
<?php if (!empty($column_classes)) { ?>
 class="<?php echo $column_classes[($column_idx-1)%count($column_classes)] ?>"
<?php } ?>
 colspan="2"
><?php unset($a5_colspan) ?><?php $a6_var='name';$a6_value=''; ?><?php
	if (isset($a6_key))
		$$a6_var = $a6_value[$a6_key];
	else
		$$a6_var = $a6_value;
?><?php unset($a6_var,$a6_value) ?><?php $a6_action='filemanager';$a6_subaction='addfolder';$a6_id=$id;$a6_name='';$a6_target='_self';$a6_method='post';$a6_enctype='application/x-www-form-urlencoded'; ?><?php
	if ($this->isEditable())
	{
		if	($this->isEditMode())
		{
			$a6_method    = 'POST';
		}
		else
		{
			$a6_method    = 'GET';
			$a6_subaction = $subActionName;
		}
	}
?><form name="<?php echo $a6_name ?>"
      target="<?php echo $a6_target ?>"
      action="<?php echo Html::url( $a6_action,$a6_subaction,$a6_id ) ?>"
      method="<?php echo $a6_method ?>"
      enctype="<?php echo $a6_enctype ?>" style="margin:0px;padding:0px;">
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_TOKEN ?>" value="<?php echo token() ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $a6_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $a6_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $a6_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($a6_action,$a6_subaction,$a6_id,$a6_name,$a6_target,$a6_method,$a6_enctype) ?><?php $a7_name='CKEditorFuncNum'; ?><?php
if (isset($$a7_name))
	$a7_tmp_value = $$a7_name;
elseif ( isset($a7_default) )
	$a7_tmp_value = $a7_default;
else
	$a7_tmp_value = "";
?><input type="hidden" name="<?php echo $a7_name ?>" value="<?php echo $a7_tmp_value ?>" /><?php unset($a7_name) ?><?php $a7_class='text';$a7_key='name';$a7_escape=true;$a7_cut='both'; ?><?php
		$a7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a7_class ?>" title="<?php echo $a7_title ?>"><?php
		$langF = $a7_escape?'langHtml':'lang';
		$tmp_text = $langF($a7_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a7_class,$a7_key,$a7_escape,$a7_cut) ?><?php $a7_class='text';$a7_default='';$a7_type='text';$a7_name='name';$a7_size='40';$a7_maxlength='256';$a7_onchange='';$a7_readonly=false; ?><?php if ($this->isEditable() && !$this->isEditMode()) $a7_readonly=true;
	  if ($a7_readonly && empty($$a7_name)) $$a7_name = '- '.lang('EMPTY').' -';
      if(!isset($a7_default)) $a7_default='';
?><?php if (!$a7_readonly || $a7_type=='hidden') {
?><input<?php if ($a7_readonly) echo ' disabled="true"' ?> id="id_<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" name="<?php echo $a7_name ?><?php if ($a7_readonly) echo '_disabled' ?>" type="<?php echo $a7_type ?>" size="<?php echo $a7_size ?>" maxlength="<?php echo $a7_maxlength ?>" class="<?php echo $a7_class ?>" value="<?php echo isset($$a7_name)?$$a7_name:$a7_default ?>" <?php if (in_array($a7_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($a7_readonly) {
?><input type="hidden" id="id_<?php echo $a7_name ?>" name="<?php echo $a7_name ?>" value="<?php echo isset($$a7_name)?$$a7_name:$a7_default ?>" /><?php
 } } else { ?><span class="<?php echo $a7_class ?>"><?php echo isset($$a7_name)?$$a7_name:$a7_default ?></span><?php } ?><?php unset($a7_class,$a7_default,$a7_type,$a7_name,$a7_size,$a7_maxlength,$a7_onchange,$a7_readonly) ?><?php $a7_type='ok';$a7_class='ok';$a7_value='ok';$a7_text='add'; ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$a7_text = 'MODE_EDIT';
		$a7_type = 'submit';
		if	( $this->isEditable() && readonly() )
			$a7_type = ''; // Knopf nicht anzeigen
		$a7_src  = '';
	if	( !empty($a7_type) ) {
?><input type="<?php echo $a7_type ?>"<?php if(isset($a7_src)) { ?> src="<?php echo $image_dir.'icon_'.$a7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $a7_value ?>" class="ok" title="<?php echo lang($a7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($a7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($a7_src)
?><?php } 
?><?php unset($a7_type,$a7_class,$a7_value,$a7_text) ?></form>
</td></tr><?php } ?><?php
	$row_idx    = $last_row_idx;
	$column_idx = $last_column_idx;
?>
</table></body>
</html>