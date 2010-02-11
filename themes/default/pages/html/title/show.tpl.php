<?php $a1_class='title'; ?><?php
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
<body class="title" <?php if (@$conf['interface']['application_mode']) { ?> style="padding:0px;margin:0px;"<?php } ?> >
<?php /* Debug-Information */ if ($showDuration) { echo "<!-- Output Variables are:\n";echo str_replace('-->','-- >',print_r($this->templateVars,true));echo "\n-->";} ?><?php unset($a1_class) ?><?php $a2_width='100%';$a2_space='0';$a2_padding='5'; ?><?php
	$last_row_idx    = @$row_idx;
	$last_column_idx = @$column_idx;
	$row_idx    = 0;
	$column_idx = 0;
	$coloumn_widths = array();
	$row_classes    = array();
	$column_classes = array();
?><table class="%class%" cellspacing="0" width="100%" cellpadding="5">
<?php unset($a2_width,$a2_space,$a2_padding) ?><?php
	$row_idx++;
	$column_idx = 0;
?>
<tr
>
<?php $a4_width='30%';$a4_class='title'; ?><?php $column_idx++; ?><td
 width="30%"
 class="title"
><?php unset($a4_width,$a4_class) ?><?php $a5_icon='database';$a5_align='left'; ?><?php
	$a5_tmp_image_file = $image_dir.'icon_'.$a5_icon.IMG_ICON_EXT;
	$a5_size = '16x16';
	$a5_tmp_title = basename($a5_tmp_image_file);
?><img alt="<?php echo $a5_tmp_title; if (isset($a5_size)) { echo ' ('; list($a5_tmp_width,$a5_tmp_height)=explode('x',$a5_size);echo $a5_tmp_width.'x'.$a5_tmp_height; echo')';} ?>" src="<?php echo $a5_tmp_image_file ?>" border="0"<?php if(isset($a5_align)) echo ' align="'.$a5_align.'"' ?><?php if (isset($a5_size)) { list($a5_tmp_width,$a5_tmp_height)=explode('x',$a5_size);echo ' width="'.$a5_tmp_width.'" height="'.$a5_tmp_height.'"';} ?>><?php unset($a5_icon,$a5_align) ?><?php $a5_title=lang('database');$a5_class='text';$a5_var='dbname';$a5_maxlength='25';$a5_escape=true;$a5_cut='both'; ?><?php
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = isset($$a5_var)?$$a5_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a5_maxlength),'..',constant('STR_PAD_'.strtoupper($a5_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_title,$a5_class,$a5_var,$a5_maxlength,$a5_escape,$a5_cut) ?><?php $a5_class='text';$a5_raw='_-_';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a5_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_raw,$a5_escape,$a5_cut) ?><?php $a5_class='text';$a5_var='cms_title';$a5_escape=true;$a5_cut='both'; ?><?php
		$a5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a5_class ?>" title="<?php echo $a5_title ?>"><?php
		$langF = $a5_escape?'langHtml':'lang';
		$tmp_text = isset($$a5_var)?$$a5_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a5_class,$a5_var,$a5_escape,$a5_cut) ?></td><?php $a4_width='40%';$a4_style='text-align:center;';$a4_class='title'; ?><?php $column_idx++; ?><td
 width="40%"
 style="text-align:center;"
 class="title"
><?php unset($a4_width,$a4_style,$a4_class) ?><?php $a5_present='projectname'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php $a6_title=lang('project');$a6_class='text';$a6_var='projectname';$a6_maxlength='20';$a6_escape=true;$a6_cut='both'; ?><?php
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a6_maxlength),'..',constant('STR_PAD_'.strtoupper($a6_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_title,$a6_class,$a6_var,$a6_maxlength,$a6_escape,$a6_cut) ?><?php } ?><?php $a5_present='modelname'; ?><?php 
	$a5_tmp_exec = isset($$a5_present);
	$a5_tmp_last_exec = $a5_tmp_exec;
	if	( $a5_tmp_exec )
	{
?>
<?php unset($a5_present) ?><?php $a6_class='text';$a6_raw='_(';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_raw,$a6_escape,$a6_cut) ?><?php $a6_title=lang('model');$a6_class='text';$a6_var='modelname';$a6_maxlength='20';$a6_escape=true;$a6_cut='both'; ?><?php
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a6_maxlength),'..',constant('STR_PAD_'.strtoupper($a6_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_title,$a6_class,$a6_var,$a6_maxlength,$a6_escape,$a6_cut) ?><?php $a6_class='text';$a6_raw=',';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_raw,$a6_escape,$a6_cut) ?><?php $a6_title=lang('language');$a6_class='text';$a6_var='languagename';$a6_maxlength='20';$a6_escape=true;$a6_cut='both'; ?><?php
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a6_maxlength),'..',constant('STR_PAD_'.strtoupper($a6_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_title,$a6_class,$a6_var,$a6_maxlength,$a6_escape,$a6_cut) ?><?php $a6_class='text';$a6_raw=')';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$a6_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_raw,$a6_escape,$a6_cut) ?><?php } ?></td><?php $a4_width='20%';$a4_style='text-align:right;';$a4_class='title'; ?><?php $column_idx++; ?><td
 width="20%"
 style="text-align:right;"
 class="title"
><?php unset($a4_width,$a4_style,$a4_class) ?><?php $a5_title=lang('USER_PROFILE_DESC');$a5_target='cms_main_main';$a5_url=$profile_url;$a5_class=''; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $a5_url;
?><a<?php if (isset($a5_name)) echo ' name="'.$a5_name.'"'; else echo ' href="'.$tmp_url.(isset($a5_anchor)?'#'.$a5_anchor:'').'"' ?> class="<?php echo $a5_class ?>" target="<?php echo $a5_target ?>"<?php if (isset($a5_accesskey)) echo ' accesskey="'.$a5_accesskey.'"' ?>  title="<?php echo encodeHtml($a5_title) ?>"><?php unset($a5_title,$a5_target,$a5_url,$a5_class) ?><?php $a6_icon='user';$a6_align='right'; ?><?php
	$a6_tmp_image_file = $image_dir.'icon_'.$a6_icon.IMG_ICON_EXT;
	$a6_size = '16x16';
	$a6_tmp_title = basename($a6_tmp_image_file);
?><img alt="<?php echo $a6_tmp_title; if (isset($a6_size)) { echo ' ('; list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo $a6_tmp_width.'x'.$a6_tmp_height; echo')';} ?>" src="<?php echo $a6_tmp_image_file ?>" border="0"<?php if(isset($a6_align)) echo ' align="'.$a6_align.'"' ?><?php if (isset($a6_size)) { list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo ' width="'.$a6_tmp_width.'" height="'.$a6_tmp_height.'"';} ?>><?php unset($a6_icon,$a6_align) ?><?php $a6_class='text';$a6_var='userfullname';$a6_maxlength='20';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = isset($$a6_var)?$$a6_var:$langF('UNKNOWN');
		$tmp_text = Text::maxLength( $tmp_text,intval($a6_maxlength),'..',constant('STR_PAD_'.strtoupper($a6_cut)) );
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_var,$a6_maxlength,$a6_escape,$a6_cut) ?></a></td><?php $a4_width='10%';$a4_style='text-align:right;';$a4_class='title'; ?><?php $column_idx++; ?><td
 width="10%"
 style="text-align:right;"
 class="title"
><?php unset($a4_width,$a4_style,$a4_class) ?><?php $a5_title=lang('USER_LOGOUT_DESC');$a5_target='_top';$a5_url=$logout_url;$a5_class=''; ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $a5_url;
?><a<?php if (isset($a5_name)) echo ' name="'.$a5_name.'"'; else echo ' href="'.$tmp_url.(isset($a5_anchor)?'#'.$a5_anchor:'').'"' ?> class="<?php echo $a5_class ?>" target="<?php echo $a5_target ?>"<?php if (isset($a5_accesskey)) echo ' accesskey="'.$a5_accesskey.'"' ?>  title="<?php echo encodeHtml($a5_title) ?>"><?php unset($a5_title,$a5_target,$a5_url,$a5_class) ?><?php $a6_icon='close';$a6_align='right'; ?><?php
	$a6_tmp_image_file = $image_dir.'icon_'.$a6_icon.IMG_ICON_EXT;
	$a6_size = '16x16';
	$a6_tmp_title = basename($a6_tmp_image_file);
?><img alt="<?php echo $a6_tmp_title; if (isset($a6_size)) { echo ' ('; list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo $a6_tmp_width.'x'.$a6_tmp_height; echo')';} ?>" src="<?php echo $a6_tmp_image_file ?>" border="0"<?php if(isset($a6_align)) echo ' align="'.$a6_align.'"' ?><?php if (isset($a6_size)) { list($a6_tmp_width,$a6_tmp_height)=explode('x',$a6_size);echo ' width="'.$a6_tmp_width.'" height="'.$a6_tmp_height.'"';} ?>><?php unset($a6_icon,$a6_align) ?><?php $a6_class='text';$a6_key='USER_LOGOUT';$a6_escape=true;$a6_cut='both'; ?><?php
		$a6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $a6_class ?>" title="<?php echo $a6_title ?>"><?php
		$langF = $a6_escape?'langHtml':'lang';
		$tmp_text = $langF($a6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($a6_class,$a6_key,$a6_escape,$a6_cut) ?></a></td></tr><?php
	$row_idx    = $last_row_idx;
	$column_idx = $last_column_idx;
?>
</table></body>
</html>