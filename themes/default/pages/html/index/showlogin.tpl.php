<?php  $attr1_class='main';  ?><?php
 if (!headers_sent()) header('Content-Type: text/html; charset='.$charset)
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo isset($attr1_title)?$attr1_title.' - ':(isset($windowTitle)?lang($windowTitle).' - ':'') ?><?php echo $cms_title ?></title>
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
<?php /* Debug-Information */ if ($showDuration) { echo "<!--\n";print_r($this->templateVars);echo "\n-->";} ?><?php unset($attr1_class); ?><?php  $attr2_action='index';  $attr2_subaction='login';  $attr2_name='';  $attr2_target='_top';  $attr2_method='post';  $attr2_enctype='application/x-www-form-urlencoded';  ?><?php
		$attr2_id = $this->getRequestId();
	if ($this->isEditable() && !$this->isEditMode())
		$attr2_subaction = $subActionName;
?><form name="<?php echo $attr2_name ?>"
      target="<?php echo $attr2_target ?>"
      action="<?php echo Html::url( $attr2_action,$attr2_subaction,$attr2_id ) ?>"
      method="<?php echo $attr2_method ?>"
      enctype="<?php echo $attr2_enctype ?>" style="margin:0px;padding:0px;">
<?php if ($this->isEditable() && !$this->isEditMode()) { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr2_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr2_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr2_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr2_action);unset($attr2_subaction);unset($attr2_name);unset($attr2_target);unset($attr2_method);unset($attr2_enctype); ?><?php  $attr3_title='GLOBAL_LOGIN';  $attr3_name='login';  $attr3_icon='user';  $attr3_width='400px';  $attr3_rowclasses='odd,even';  $attr3_columnclasses='1,2,3';  ?><?php
	$coloumn_widths=array();
	if	(!empty($attr3_widths))
	{
		$column_widths = explode(',',$attr3_widths);
		unset($attr3['widths']);
	}
	if	(!empty($attr3_rowclasses))
	{
		$row_classes   = explode(',',$attr3_rowclasses);
		$row_class_idx = 999;
		unset($attr3['rowclasses']);
	}
	if	(!empty($attr3_columnclasses))
	{
		$column_classes = explode(',',$attr3_columnclasses);
		unset($attr3['columnclasses']);
	}
		global $image_dir;
		if (@$conf['interface']['application_mode'] )
		{
			echo '<table class="main" cellspacing="0" cellpadding="4" width="100%" style="margin:0px;border:0px; padding:0px;" height_oo="100%">';
		}
		else
		{
			echo '<br/><br/><br/><center>';
			echo '<table class="main" cellspacing="0" cellpadding="4" width="'.$attr3_width.'">';
		}
		if (!@$conf['interface']['application_mode'] )
		{
		echo '<tr><td class="menu">';
		echo '<img src="'.$image_dir.'icon_'.$actionName.IMG_ICON_EXT.'" align="left" border="0">';
		if ($this->isEditable()) { ?>
  <?php if ($this->isEditMode()) { 
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId()                       ) ?>" accesskey="1" title="<?php echo langHtml('MODE_EDIT_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>mode-edit.png" style="vertical-align:top; " border="0" /></a> <?php } else {
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId(),array('mode'=>'edit') ) ?>" accesskey="1" title="<?php echo langHtml('MODE_SHOW_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>readonly.png" style="vertical-align:top; " border="0" /></a> <?php }
  ?><?php }
		echo '<span class="path">'.langHtml('GLOBAL_'.$actionName).'</span>&nbsp;<strong>&raquo;</strong>&nbsp;';
		if	( !isset($path) || is_array($path) )
			$path = array();
		foreach( $path as $pathElement)
		{
			extract($pathElement);
			echo '<a href="'.$url.'" class="path">'.langHtml($name).'</a>';
			echo '&nbsp;&raquo;&nbsp;';
		}
		echo '<span class="title">'.langHtml($windowTitle).'</span>';
		?>
		</td>
		<?php
		}
		?>
<?php ?>		<!--<td class="menu" style="align:right;">
    <?php if (isset($windowIcons)) foreach( $windowIcons as $icon )
          {
          	?><a href="<?php echo $icon['url'] ?>" title="<?php echo 'ICON_'.langHtml($menu['type'].'_DESC') ?>"><image border="0" src="<?php echo $image_dir.$icon['type'].IMG_ICON_EXT ?>"></a>&nbsp;<?php
          }
     ?>
    </td>-->
  </tr>
  <tr><td class="subaction">
    <?php if	( !isset($windowMenu) || !is_array($windowMenu) )
			$windowMenu = array();
    foreach( $windowMenu as $menu )
          {
          	$tmp_text = langHtml($menu['text']);
          	$tmp_key  = strtoupper(langHtml($menu['key' ]));
			$tmp_pos = strpos(strtolower($tmp_text),strtolower($tmp_key));
			if	( $tmp_pos !== false )
				$tmp_text = substr($tmp_text,0,max($tmp_pos,0)).'<span class="accesskey">'. substr($tmp_text,$tmp_pos,1).'</span>'.substr($tmp_text,$tmp_pos+1);
          	if	( isset($menu['url']) )
          	{
          		?><a href="<?php echo Html::url($actionName,$menu['subaction'],$this->getRequestId() ) ?>" accesskey="<?php echo $tmp_key ?>" title="<?php echo langHtml($menu['text'].'_DESC') ?>" class="menu<?php echo $this->subActionName==$menu['subaction']?'_highlight':'' ?>"><?php echo $tmp_text ?></a>&nbsp;&nbsp;&nbsp;<?php
          	}
          	else
          	{
          		?><span class="menu_disabled" title="<?php echo langHtml($menu['text'].'_DESC') ?>" class="menu_disabled"><?php echo $tmp_text ?></span>&nbsp;&nbsp;&nbsp;<?php
          	}
          }
          	if (@$conf['help']['enabled'] )
          	{
             ?><a href="<?php echo $conf['help']['url'].$actionName.'/'.$subActionName.@$conf['help']['suffix'] ?> " target="_new" title="<?php echo langHtml('MENU_HELP_DESC') ?>" class="menu" style="cursor:help;"><?php echo @$conf['help']['only_question_mark']?'?':langHtml('MENU_HELP') ?></a><?php
          	}
          	?></td>
  </tr>
<?php if (isset($notices) && count($notices)>0 )
      { ?>
  <tr>
    <td align="center" class="notice">
  <?php foreach( $notices as $notice_idx=>$notice ) { ?>
    	<br><table class="notice" width="80%">
  <?php if ($notice['name']!='') { ?>
  <tr>
    <th colspan="2"><img src="<?php echo $image_dir.'icon_'.$notice['type'].IMG_ICON_EXT ?>" align="left" /><?php echo $notice['name'] ?>
    </th>
  </tr>
<?php } ?>
  <tr class="<?php echo $notice['status'] ?>">
    <td style="padding:10px;" width="30px"><img src="<?php echo $image_dir.'notice_'.$notice['status'].IMG_ICON_EXT ?>" style="padding:10px" /></td>
    <td style="padding:10px;padding-right:10px;padding-bottom:10px;"><?php if ($notice['status']=='error') { ?><strong><?php } ?><?php echo langHtml($notice['key'],$notice['vars']) ?><?php if ($notice['status']=='error') { ?></strong><?php } ?>
    <?php if (!empty($notice['log'])) { ?><pre><?php echo htmlentities(implode("\n",$notice['log'])) ?></pre><?php } ?>
    </td>
  </tr>
    </table>
  <?php } ?>
    </td>
  </tr>
  <tr>
  <td colspan="2"><fieldset></fieldset></td>
  </tr>
<?php } ?>
  <tr>
    <td>
      <table cellspacing="0" width="100%" cellpadding="4">
<?php unset($attr3_title);unset($attr3_name);unset($attr3_icon);unset($attr3_width);unset($attr3_rowclasses);unset($attr3_columnclasses); ?><?php  $attr4_present=@$conf['login']['logo']['file'];  ?><?php 
	$attr4_tmp_exec = isset($$attr4_present);
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_present); ?><?php  $attr5_false=$this->mustChangePassword;  ?><?php 
	if	(gettype($attr5_false) === '' && gettype($attr5_false) === '1')
		$attr5_tmp_exec = $$attr5_false == false;
	else
		$attr5_tmp_exec = $attr5_false == false;
	$attr5_tmp_last_exec = $attr5_tmp_exec;
	if	( $attr5_tmp_exec )
	{
?>
<?php unset($attr5_false); ?><?php  ?><?php
	$attr6_tmp_class='';
	$attr6_last_class = $attr6_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr6_tmp_class));
?><?php  ?><?php  $attr7_colspan='2';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> colspan="<?php echo $attr7_colspan ?>" <?php
?>><?php unset($attr7_colspan); ?><?php  $attr8_present=@$conf['login']['logo']['url'];  ?><?php 
	$attr8_tmp_exec = isset($$attr8_present);
	$attr8_tmp_last_exec = $attr8_tmp_exec;
	if	( $attr8_tmp_exec )
	{
?>
<?php unset($attr8_present); ?><?php  $attr9_title='';  $attr9_target='_top';  $attr9_url=@$conf['login']['logo']['url'];  $attr9_class='';  ?><?php
	$params = array();
		$tmp_url = $attr9_url;
?><a<?php if (isset($attr9_name)) echo ' name="'.$attr9_name.'"'; else echo ' href="'.$tmp_url.($attr9_anchor?'#'.$attr9_anchor:'').'"' ?> class="<?php echo $attr9_class ?>" target="<?php echo $attr9_target ?>"<?php if (isset($attr9_accesskey)) echo ' accesskey="'.$attr9_accesskey.'"' ?>  title="<?php echo encodeHtml($attr9_title) ?>"><?php unset($attr9_title);unset($attr9_target);unset($attr9_url);unset($attr9_class); ?><?php  $attr10_url=@$conf['login']['logo']['file'];  $attr10_align='left';  ?><?php
	$attr10_tmp_image_file = $attr10_url;
?><img alt="<?php echo basename($attr10_tmp_image_file); echo ' ('; if (isset($attr10_size)) { list($attr10_tmp_width,$attr10_tmp_height)=explode('x',$attr10_size);echo $attr10_tmp_width.'x'.$attr10_tmp_height; echo')';} ?>" src="<?php echo $attr10_tmp_image_file ?>" border="0"<?php if(isset($attr10_align)) echo ' align="'.$attr10_align.'"' ?><?php if (isset($attr10_size)) { list($attr10_tmp_width,$attr10_tmp_height)=explode('x',$attr10_size);echo ' width="'.$attr10_tmp_width.'" height="'.$attr10_tmp_height.'"';} ?>><?php unset($attr10_url);unset($attr10_align); ?><?php  ?></a><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr8_empty=@$conf['login']['logo']['url'];  ?><?php 
	if	( !isset($$attr8_empty) )
		$attr8_tmp_exec = empty($attr8_empty);
	elseif	( is_array($$attr8_empty) )
		$attr8_tmp_exec = (count($$attr8_empty)==0);
	elseif	( is_bool($$attr8_empty) )
		$attr8_tmp_exec = true;
	else
		$attr8_tmp_exec = empty( $$attr8_empty );
	$attr8_tmp_last_exec = $attr8_tmp_exec;
	if	( $attr8_tmp_exec )
	{
?>
<?php unset($attr8_empty); ?><?php  $attr9_url=@$conf['login']['logo']['file'];  $attr9_align='left';  ?><?php
	$attr9_tmp_image_file = $attr9_url;
?><img alt="<?php echo basename($attr9_tmp_image_file); echo ' ('; if (isset($attr9_size)) { list($attr9_tmp_width,$attr9_tmp_height)=explode('x',$attr9_size);echo $attr9_tmp_width.'x'.$attr9_tmp_height; echo')';} ?>" src="<?php echo $attr9_tmp_image_file ?>" border="0"<?php if(isset($attr9_align)) echo ' align="'.$attr9_align.'"' ?><?php if (isset($attr9_size)) { list($attr9_tmp_width,$attr9_tmp_height)=explode('x',$attr9_size);echo ' width="'.$attr9_tmp_width.'" height="'.$attr9_tmp_height.'"';} ?>><?php unset($attr9_url);unset($attr9_align); ?><?php  ?><?php } ?><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr4_not='';  $attr4_empty=@$conf['login']['motd'];  ?><?php 
	if	( !isset($$attr4_empty) )
		$attr4_tmp_exec = empty($attr4_empty);
	elseif	( is_array($$attr4_empty) )
		$attr4_tmp_exec = (count($$attr4_empty)==0);
	elseif	( is_bool($$attr4_empty) )
		$attr4_tmp_exec = true;
	else
		$attr4_tmp_exec = empty( $$attr4_empty );
	$attr4_tmp_exec = !$attr4_tmp_exec;
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_not);unset($attr4_empty); ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_class='motd';  $attr6_colspan='2';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> class="<?php   echo $attr6_class   ?>" <?php
?> colspan="<?php echo $attr6_colspan ?>" <?php
?>><?php unset($attr6_class);unset($attr6_colspan); ?><?php  $attr7_class='text';  $attr7_raw=@$conf['login']['motd'];  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_raw);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr4_true=@$conf['login']['nologin'];  ?><?php 
	if	(gettype($attr4_true) === '' && gettype($attr4_true) === '1')
		$attr4_tmp_exec = $$attr4_true == true;
	else
		$attr4_tmp_exec = $attr4_true == true;
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_true); ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_class='help';  $attr6_colspan='2';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> class="<?php   echo $attr6_class   ?>" <?php
?> colspan="<?php echo $attr6_colspan ?>" <?php
?>><?php unset($attr6_class);unset($attr6_colspan); ?><?php  $attr7_class='text';  $attr7_key='LOGIN_NOLOGIN_DESC';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($attr7_key);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_key);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr4_true=@$conf['security']['readonly'];  ?><?php 
	if	(gettype($attr4_true) === '' && gettype($attr4_true) === '1')
		$attr4_tmp_exec = $$attr4_true == true;
	else
		$attr4_tmp_exec = $attr4_true == true;
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_true); ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_class='help';  $attr6_colspan='2';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> class="<?php   echo $attr6_class   ?>" <?php
?> colspan="<?php echo $attr6_colspan ?>" <?php
?>><?php unset($attr6_class);unset($attr6_colspan); ?><?php  $attr7_class='text';  $attr7_key='GLOBAL_READONLY_DESC';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($attr7_key);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_key);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr4_true=@$conf['security']['nopublish'];  ?><?php 
	if	(gettype($attr4_true) === '' && gettype($attr4_true) === '1')
		$attr4_tmp_exec = $$attr4_true == true;
	else
		$attr4_tmp_exec = $attr4_true == true;
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_true); ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_class='help';  $attr6_colspan='2';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> class="<?php   echo $attr6_class   ?>" <?php
?> colspan="<?php echo $attr6_colspan ?>" <?php
?>><?php unset($attr6_class);unset($attr6_colspan); ?><?php  $attr7_class='text';  $attr7_key='GLOBAL_NOPUBLISH_DESC';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($attr7_key);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_key);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr4_false=@$conf['login']['nologin'];  ?><?php 
	if	(gettype($attr4_false) === '' && gettype($attr4_false) === '1')
		$attr4_tmp_exec = $$attr4_false == false;
	else
		$attr4_tmp_exec = $attr4_false == false;
	$attr4_tmp_last_exec = $attr4_tmp_exec;
	if	( $attr4_tmp_exec )
	{
?>
<?php unset($attr4_false); ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_class='logo';  $attr6_colspan='2';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> class="<?php   echo $attr6_class   ?>" <?php
?> colspan="<?php echo $attr6_colspan ?>" <?php
?>><?php unset($attr6_class);unset($attr6_colspan); ?><?php  $attr7_name='login';  ?><img src="<?php echo $image_dir.'logo_'.$attr7_name.IMG_ICON_EXT ?>" border="0" align="left"><h2 class="logo"><?php echo langHtml('logo_'.$attr7_name) ?></h2><p class="logo"><?php echo langHtml('logo_'.$attr7_name.'_text') ?></p><?php unset($attr7_name); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr7_class='text';  $attr7_key='USER_USERNAME';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($attr7_key);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_key);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr7_not=true;  $attr7_present='force_username';  ?><?php 
	$attr7_tmp_exec = isset($$attr7_present);
	$attr7_tmp_exec = !$attr7_tmp_exec;
	$attr7_tmp_last_exec = $attr7_tmp_exec;
	if	( $attr7_tmp_exec )
	{
?>
<?php unset($attr7_not);unset($attr7_present); ?><?php  $attr8_class='name';  $attr8_default='';  $attr8_type='text';  $attr8_name='login_name';  $attr8_value='';  $attr8_size='20';  $attr8_maxlength='256';  $attr8_onchange='';  $attr8_readonly=false;  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr8_readonly=true;
	  if ($attr8_readonly && empty($$attr8_name)) $$attr8_name = '- '.lang('EMPTY').' -';
      if(!isset($attr8_default)) $attr8_default='';
?><?php if (!$attr8_readonly || $attr8_type=='hidden') {
?><input<?php if ($attr8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr8_name ?><?php if ($attr8_readonly) echo '_disabled' ?>" name="<?php echo $attr8_name ?><?php if ($attr8_readonly) echo '_disabled' ?>" type="<?php echo $attr8_type ?>" size="<?php echo $attr8_size ?>" maxlength="<?php echo $attr8_maxlength ?>" class="<?php echo $attr8_class ?>" value="<?php echo isset($$attr8_name)?$$attr8_name:$attr8_default ?>" <?php if (in_array($attr8_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr8_readonly) {
?><input type="hidden" id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name ?>" value="<?php echo isset($$attr8_name)?$$attr8_name:$attr8_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr8_class ?>"><?php echo isset($$attr8_name)?$$attr8_name:$attr8_default ?></span><?php } ?><?php unset($attr8_class);unset($attr8_default);unset($attr8_type);unset($attr8_name);unset($attr8_value);unset($attr8_size);unset($attr8_maxlength);unset($attr8_onchange);unset($attr8_readonly); ?><?php  ?><?php } ?><?php  ?><?php  ?><?php if (!$attr7_tmp_last_exec) { ?>
<?php  ?><?php  $attr8_class='text';  $attr8_default='';  $attr8_type='hidden';  $attr8_name='login_name';  $attr8_value=$force_username;  $attr8_size='40';  $attr8_maxlength='256';  $attr8_onchange='';  $attr8_readonly=false;  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr8_readonly=true;
	  if ($attr8_readonly && empty($$attr8_name)) $$attr8_name = '- '.lang('EMPTY').' -';
      if(!isset($attr8_default)) $attr8_default='';
?><?php if (!$attr8_readonly || $attr8_type=='hidden') {
?><input<?php if ($attr8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr8_name ?><?php if ($attr8_readonly) echo '_disabled' ?>" name="<?php echo $attr8_name ?><?php if ($attr8_readonly) echo '_disabled' ?>" type="<?php echo $attr8_type ?>" size="<?php echo $attr8_size ?>" maxlength="<?php echo $attr8_maxlength ?>" class="<?php echo $attr8_class ?>" value="<?php echo isset($$attr8_name)?$$attr8_name:$attr8_default ?>" <?php if (in_array($attr8_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr8_readonly) {
?><input type="hidden" id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name ?>" value="<?php echo isset($$attr8_name)?$$attr8_name:$attr8_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr8_class ?>"><?php echo isset($$attr8_name)?$$attr8_name:$attr8_default ?></span><?php } ?><?php unset($attr8_class);unset($attr8_default);unset($attr8_type);unset($attr8_name);unset($attr8_value);unset($attr8_size);unset($attr8_maxlength);unset($attr8_onchange);unset($attr8_readonly); ?><?php  $attr8_class='text';  $attr8_value=$force_username;  $attr8_escape=true;  ?><?php
		$attr8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
		$langF = $attr8_escape?'langHtml':'lang';
		$tmp_text = $attr8_value;
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_value);unset($attr8_escape); ?><?php  ?><?php }
unset($attr6_tmp_last_exec) ?><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr7_class='text';  $attr7_key='USER_PASSWORD';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = $langF($attr7_key);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_key);unset($attr7_escape); ?><?php  ?></td><?php  ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr7_name='login_password';  $attr7_default='';  $attr7_class='name';  $attr7_size='20';  $attr7_maxlength='256';  ?><input type="password" name="<?php echo $attr7_name ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php if (count($errors)==0) echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" <?php if (in_array($attr7_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php unset($attr7_name);unset($attr7_default);unset($attr7_class);unset($attr7_size);unset($attr7_maxlength); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  $attr5_true=$this->mustChangePassword;  ?><?php 
	if	(gettype($attr5_true) === '' && gettype($attr5_true) === '1')
		$attr5_tmp_exec = $$attr5_true == true;
	else
		$attr5_tmp_exec = $attr5_true == true;
	$attr5_tmp_last_exec = $attr5_tmp_exec;
	if	( $attr5_tmp_exec )
	{
?>
<?php unset($attr5_true); ?><?php  ?><?php
	$attr6_tmp_class='';
	$attr6_last_class = $attr6_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr6_tmp_class));
?><?php  ?><?php  $attr7_colspan='2';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> colspan="<?php echo $attr7_colspan ?>" <?php
?>><?php unset($attr7_colspan); ?><?php  $attr8_title=lang('USER_NEW_PASSWORD');  ?><fieldset><?php if(isset($attr8_title)) { ?><legend><?php echo encodeHtml($attr8_title) ?></legend><?php } ?><?php unset($attr8_title); ?><?php  ?></fieldset><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr6_tmp_class='';
	$attr6_last_class = $attr6_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr6_tmp_class));
?><?php  ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr8_class='text';  $attr8_key='USER_NEW_PASSWORD';  $attr8_escape=true;  ?><?php
		$attr8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
		$langF = $attr8_escape?'langHtml':'lang';
		$tmp_text = $langF($attr8_key);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_key);unset($attr8_escape); ?><?php  ?></td><?php  ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr8_name='password1';  $attr8_default='';  $attr8_class='';  $attr8_size='25';  $attr8_maxlength='256';  ?><input type="password" name="<?php echo $attr8_name ?>" size="<?php echo $attr8_size ?>" maxlength="<?php echo $attr8_maxlength ?>" class="<?php echo $attr8_class ?>" value="<?php if (count($errors)==0) echo isset($$attr8_name)?$$attr8_name:$attr8_default ?>" <?php if (in_array($attr8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php unset($attr8_name);unset($attr8_default);unset($attr8_class);unset($attr8_size);unset($attr8_maxlength); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr6_tmp_class='';
	$attr6_last_class = $attr6_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr6_tmp_class));
?><?php  ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr8_class='text';  $attr8_key='USER_NEW_PASSWORD_REPEAT';  $attr8_escape=true;  ?><?php
		$attr8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
		$langF = $attr8_escape?'langHtml':'lang';
		$tmp_text = $langF($attr8_key);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_key);unset($attr8_escape); ?><?php  ?></td><?php  ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr8_name='password2';  $attr8_default='';  $attr8_class='';  $attr8_size='25';  $attr8_maxlength='256';  ?><input type="password" name="<?php echo $attr8_name ?>" size="<?php echo $attr8_size ?>" maxlength="<?php echo $attr8_maxlength ?>" class="<?php echo $attr8_class ?>" value="<?php if (count($errors)==0) echo isset($$attr8_name)?$$attr8_name:$attr8_default ?>" <?php if (in_array($attr8_name,$errors)) echo 'style="border:2px dashed red;"' ?> /><?php unset($attr8_name);unset($attr8_default);unset($attr8_class);unset($attr8_size);unset($attr8_maxlength); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr5_true=@$conf['security']['openid']['enable'];  ?><?php 
	if	(gettype($attr5_true) === '' && gettype($attr5_true) === '1')
		$attr5_tmp_exec = $$attr5_true == true;
	else
		$attr5_tmp_exec = $attr5_true == true;
	$attr5_tmp_last_exec = $attr5_tmp_exec;
	if	( $attr5_tmp_exec )
	{
?>
<?php unset($attr5_true); ?><?php  ?><?php
	$attr6_tmp_class='';
	$attr6_last_class = $attr6_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr6_tmp_class));
?><?php  ?><?php  $attr7_colspan='2';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> colspan="<?php echo $attr7_colspan ?>" <?php
?>><?php unset($attr7_colspan); ?><?php  $attr8_title=lang('OPENID');  ?><fieldset><?php if(isset($attr8_title)) { ?><legend><?php echo encodeHtml($attr8_title) ?></legend><?php } ?><?php unset($attr8_title); ?><?php  ?></fieldset><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr6_tmp_class='';
	$attr6_last_class = $attr6_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr6_tmp_class));
?><?php  ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr8_not=true;  $attr8_empty=@$conf['security']['openid']['logo_url'];  ?><?php 
	if	( !isset($$attr8_empty) )
		$attr8_tmp_exec = empty($attr8_empty);
	elseif	( is_array($$attr8_empty) )
		$attr8_tmp_exec = (count($$attr8_empty)==0);
	elseif	( is_bool($$attr8_empty) )
		$attr8_tmp_exec = true;
	else
		$attr8_tmp_exec = empty( $$attr8_empty );
	$attr8_tmp_exec = !$attr8_tmp_exec;
	$attr8_tmp_last_exec = $attr8_tmp_exec;
	if	( $attr8_tmp_exec )
	{
?>
<?php unset($attr8_not);unset($attr8_empty); ?><?php  $attr9_url=@$conf['security']['openid']['logo_url'];  $attr9_align='left';  ?><?php
	$attr9_tmp_image_file = $attr9_url;
?><img alt="<?php echo basename($attr9_tmp_image_file); echo ' ('; if (isset($attr9_size)) { list($attr9_tmp_width,$attr9_tmp_height)=explode('x',$attr9_size);echo $attr9_tmp_width.'x'.$attr9_tmp_height; echo')';} ?>" src="<?php echo $attr9_tmp_image_file ?>" border="0"<?php if(isset($attr9_align)) echo ' align="'.$attr9_align.'"' ?><?php if (isset($attr9_size)) { list($attr9_tmp_width,$attr9_tmp_height)=explode('x',$attr9_size);echo ' width="'.$attr9_tmp_width.'" height="'.$attr9_tmp_height.'"';} ?>><?php unset($attr9_url);unset($attr9_align); ?><?php  ?><?php } ?><?php  ?><?php  $attr8_class='text';  $attr8_key='openid_user';  $attr8_escape=true;  ?><?php
		$attr8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
		$langF = $attr8_escape?'langHtml':'lang';
		$tmp_text = $langF($attr8_key);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_key);unset($attr8_escape); ?><?php  ?></td><?php  ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr8_class='name';  $attr8_default='';  $attr8_type='text';  $attr8_name='openid_url';  $attr8_size='20';  $attr8_maxlength='256';  $attr8_onchange='';  $attr8_readonly=false;  ?><?php if ($this->isEditable() && !$this->isEditMode()) $attr8_readonly=true;
	  if ($attr8_readonly && empty($$attr8_name)) $$attr8_name = '- '.lang('EMPTY').' -';
      if(!isset($attr8_default)) $attr8_default='';
?><?php if (!$attr8_readonly || $attr8_type=='hidden') {
?><input<?php if ($attr8_readonly) echo ' disabled="true"' ?> id="id_<?php echo $attr8_name ?><?php if ($attr8_readonly) echo '_disabled' ?>" name="<?php echo $attr8_name ?><?php if ($attr8_readonly) echo '_disabled' ?>" type="<?php echo $attr8_type ?>" size="<?php echo $attr8_size ?>" maxlength="<?php echo $attr8_maxlength ?>" class="<?php echo $attr8_class ?>" value="<?php echo isset($$attr8_name)?$$attr8_name:$attr8_default ?>" <?php if (in_array($attr8_name,$errors)) echo 'style="border-rightx:10px solid red; background-colorx:yellow; border:2px dashed red;"' ?> /><?php
if	($attr8_readonly) {
?><input type="hidden" id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name ?>" value="<?php echo isset($$attr8_name)?$$attr8_name:$attr8_default ?>" /><?php
 } } else { ?><span class="<?php echo $attr8_class ?>"><?php echo isset($$attr8_name)?$$attr8_name:$attr8_default ?></span><?php } ?><?php unset($attr8_class);unset($attr8_default);unset($attr8_type);unset($attr8_name);unset($attr8_size);unset($attr8_maxlength);unset($attr8_onchange);unset($attr8_readonly); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr5_value=@count($dbids);  $attr5_greaterthan='1';  ?><?php 
	$attr5_tmp_exec = intval($attr5_greaterthan) < intval($attr5_value);
	$attr5_tmp_last_exec = $attr5_tmp_exec;
	if	( $attr5_tmp_exec )
	{
?>
<?php unset($attr5_value);unset($attr5_greaterthan); ?><?php  ?><?php
	$attr6_tmp_class='';
	$attr6_last_class = $attr6_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr6_tmp_class));
?><?php  ?><?php  ?><?php
	$attr7_tmp_class='';
	$attr7_last_class = $attr7_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr7_tmp_class));
?><?php  ?><?php  $attr8_colspan='2';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr8_class))
		$attr8_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr8_rowspan) )
		$attr8_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> colspan="<?php echo $attr8_colspan ?>" <?php
?>><?php unset($attr8_colspan); ?><?php  $attr9_title=lang('DATABASE');  ?><fieldset><?php if(isset($attr9_title)) { ?><legend><?php echo encodeHtml($attr9_title) ?></legend><?php } ?><?php unset($attr9_title); ?><?php  ?></fieldset><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr8_class='text';  $attr8_key='DATABASE';  $attr8_escape=true;  ?><?php
		$attr8_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
		$langF = $attr8_escape?'langHtml':'lang';
		$tmp_text = $langF($attr8_key);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr8_class);unset($attr8_key);unset($attr8_escape); ?><?php  ?></td><?php  ?><?php  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7_width=$column_widths[$cell_column_nr-1];
?><td<?php
?>><?php  ?><?php  $attr8_list='dbids';  $attr8_name='dbid';  $attr8_default=$actdbid;  $attr8_onchange='';  $attr8_title='';  $attr8_class='';  $attr8_addempty=false;  $attr8_multiple=false;  $attr8_size='1';  $attr8_lang=false;  ?><?php
$attr8_tmp_list = $$attr8_list;
if ($this->isEditable() && !$this->isEditMode())
{
	echo empty($$attr8_name)?'- '.lang('EMPTY').' -':$attr8_tmp_list[$$attr8_name];
}
else
{
if ( $attr8_addempty!==FALSE  )
{
	if ($attr8_addempty===TRUE)
		$$attr8_list = array(''=>lang('LIST_ENTRY_EMPTY'))+$$attr8_list;
	else
		$$attr8_list = array(''=>'- '.lang($attr8_addempty).' -')+$$attr8_list;
}
?><select<?php if ($attr8_readonly) echo ' disabled="disabled"' ?> id="id_<?php echo $attr8_name ?>"  name="<?php echo $attr8_name; if ($attr8_multiple) echo '[]'; ?>" onchange="<?php echo $attr8_onchange ?>" title="<?php echo $attr8_title ?>" class="<?php echo $attr8_class ?>"<?php
if (count($$attr8_list)<=1) echo ' disabled="disabled"';
if	($attr8_multiple) echo ' multiple="multiple"';
if (in_array($attr8_name,$errors)) echo ' style="background-color:red; border:2px dashed red;"';
echo ' size="'.intval($attr8_size).'"';
?>><?php
		if	( isset($$attr8_name) && isset($attr8_tmp_list[$$attr8_name]) )
			$attr8_tmp_default = $$attr8_name;
		elseif ( isset($attr8_default) )
			$attr8_tmp_default = $attr8_default;
		else
			$attr8_tmp_default = '';
		foreach( $attr8_tmp_list as $box_key=>$box_value )
		{
			if	( is_array($box_value) )
			{
				$box_key   = $box_value['key'  ];
				$box_title = $box_value['title'];
				$box_value = $box_value['value'];
			}
			elseif( $attr8_lang )
			{
				$box_title = lang( $box_value.'_DESC');
				$box_value = lang( $box_value        );
			}
			else
			{
				$box_title = '';
			}
			echo '<option class="'.$attr8_class.'" value="'.$box_key.'" title="'.$box_title.'"';
			if ($box_key==$attr8_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr8_list)==0) echo '<input type="hidden" name="'.$attr8_name.'" value="" />';
if (count($$attr8_list)==1) echo '<input type="hidden" name="'.$attr8_name.'" value="'.$box_key.'" />';
}
?><?php unset($attr8_list);unset($attr8_name);unset($attr8_default);unset($attr8_onchange);unset($attr8_title);unset($attr8_class);unset($attr8_addempty);unset($attr8_multiple);unset($attr8_size);unset($attr8_lang); ?><?php  $attr8_name='screenwidth';  $attr8_default='9999';  ?><?php
if (isset($$attr8_name))
	$attr8_tmp_value = $$attr8_name;
elseif ( isset($attr8_default) )
	$attr8_tmp_value = $attr8_default;
else
	$attr8_tmp_value = "";
?><input type="hidden" name="<?php echo $attr8_name ?>" value="<?php echo $attr8_tmp_value ?>" /><?php unset($attr8_name);unset($attr8_default); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  ?><?php
	$attr5_tmp_class='';
	$attr5_last_class = $attr5_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr5_tmp_class));
?><?php  ?><?php  $attr6_class='act';  $attr6_colspan='2';  ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6_class=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6_width=$column_widths[$cell_column_nr-1];
?><td<?php
?> class="<?php   echo $attr6_class   ?>" <?php
?> colspan="<?php echo $attr6_colspan ?>" <?php
?>><?php unset($attr6_class);unset($attr6_colspan); ?><?php  $attr7_type='ok';  $attr7_class='ok';  $attr7_value='ok';  $attr7_text='button_ok';  ?><?php
		if ($this->isEditable() && !$this->isEditMode())
		$attr7_text = 'MODE_EDIT';
		$attr7_type = 'submit';
		$attr7_src  = '';
?><input type="<?php echo $attr7_type ?>"<?php if(isset($attr7_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" title="<?php echo lang($attr7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7_src) ?><?php
?><?php unset($attr7_type);unset($attr7_class);unset($attr7_value);unset($attr7_text); ?><?php  $attr7_script='screenwidth';  $attr7_inline=false;  ?><?php
$attr7_tmp_file = $tpl_dir.'../../js/'.basename($attr7_script).'.js';
if	(!$attr7_inline)
{
	?><script src="<?php echo $attr7_tmp_file ?>" type="text/javascript"></script><?php 
}
else
{
	echo '<script type="text/javascript">';
	echo str_replace('  ',' ',str_replace('~','',strtr(implode('',file($attr7_tmp_file)),"\t\n\b",'~~~')));
	echo '</script>';
}
?>
<?php unset($attr7_script);unset($attr7_inline); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  ?>      </table>
	</td>
  </tr>
</table>
</center>
<?php if ($showDuration)
      { ?>
<br/>
<center><small>&nbsp;
<?php $dur = time()-START_TIME;
      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small></center>
<?php } ?>
<?php  ?><?php  $attr3_value=@count($dbids);  $attr3_lessthan='2';  ?><?php 
	$attr3_tmp_exec = intval($attr3_lessthan) > intval($attr3_value);
	$attr3_tmp_last_exec = $attr3_tmp_exec;
	if	( $attr3_tmp_exec )
	{
?>
<?php unset($attr3_value);unset($attr3_lessthan); ?><?php  $attr4_name='dbid';  $attr4_default=$actdbid;  ?><?php
if (isset($$attr4_name))
	$attr4_tmp_value = $$attr4_name;
elseif ( isset($attr4_default) )
	$attr4_tmp_value = $attr4_default;
else
	$attr4_tmp_value = "";
?><input type="hidden" name="<?php echo $attr4_name ?>" value="<?php echo $attr4_tmp_value ?>" /><?php unset($attr4_name);unset($attr4_default); ?><?php  ?><?php } ?><?php  ?><?php  $attr3_name='objectid';  ?><?php
if (isset($$attr3_name))
	$attr3_tmp_value = $$attr3_name;
elseif ( isset($attr3_default) )
	$attr3_tmp_value = $attr3_default;
else
	$attr3_tmp_value = "";
?><input type="hidden" name="<?php echo $attr3_name ?>" value="<?php echo $attr3_tmp_value ?>" /><?php unset($attr3_name); ?><?php  $attr3_name='modelid';  ?><?php
if (isset($$attr3_name))
	$attr3_tmp_value = $$attr3_name;
elseif ( isset($attr3_default) )
	$attr3_tmp_value = $attr3_default;
else
	$attr3_tmp_value = "";
?><input type="hidden" name="<?php echo $attr3_name ?>" value="<?php echo $attr3_tmp_value ?>" /><?php unset($attr3_name); ?><?php  $attr3_name='projectid';  ?><?php
if (isset($$attr3_name))
	$attr3_tmp_value = $$attr3_name;
elseif ( isset($attr3_default) )
	$attr3_tmp_value = $attr3_default;
else
	$attr3_tmp_value = "";
?><input type="hidden" name="<?php echo $attr3_name ?>" value="<?php echo $attr3_tmp_value ?>" /><?php unset($attr3_name); ?><?php  $attr3_name='languageid';  ?><?php
if (isset($$attr3_name))
	$attr3_tmp_value = $$attr3_name;
elseif ( isset($attr3_default) )
	$attr3_tmp_value = $attr3_default;
else
	$attr3_tmp_value = "";
?><input type="hidden" name="<?php echo $attr3_name ?>" value="<?php echo $attr3_tmp_value ?>" /><?php unset($attr3_name); ?><?php  ?></form>
<?php  ?><?php  ?><br/><?php  ?><?php  ?><br/><?php  ?><?php  $attr2_title='';  $attr2_target='_top';  $attr2_url=@$conf['login']['gpl']['url'];  $attr2_class='copyright';  ?><?php
	$params = array();
		$tmp_url = $attr2_url;
?><a<?php if (isset($attr2_name)) echo ' name="'.$attr2_name.'"'; else echo ' href="'.$tmp_url.($attr2_anchor?'#'.$attr2_anchor:'').'"' ?> class="<?php echo $attr2_class ?>" target="<?php echo $attr2_target ?>"<?php if (isset($attr2_accesskey)) echo ' accesskey="'.$attr2_accesskey.'"' ?>  title="<?php echo encodeHtml($attr2_title) ?>"><?php unset($attr2_title);unset($attr2_target);unset($attr2_url);unset($attr2_class); ?><?php  $attr3_class='text';  $attr3_value=lang('GPL');  $attr3_escape=true;  ?><?php
		$attr3_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr3_class ?>" title="<?php echo $attr3_title ?>"><?php
		$langF = $attr3_escape?'langHtml':'lang';
		$tmp_text = $attr3_value;
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr3_class);unset($attr3_value);unset($attr3_escape); ?><?php  ?></a><?php  ?><?php  $attr2_present='force_username';  ?><?php 
	$attr2_tmp_exec = isset($$attr2_present);
	$attr2_tmp_last_exec = $attr2_tmp_exec;
	if	( $attr2_tmp_exec )
	{
?>
<?php unset($attr2_present); ?><?php  $attr3_field='login_password';  ?><?php
if (isset($errors[0])) $attr3_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $attr3_field ?>.focus();
document.forms[0].<?php echo $attr3_field ?>.select();
</script>
<?php unset($attr3_field); ?><?php  ?><?php } ?><?php  ?><?php  ?><?php if (!$attr2_tmp_last_exec) { ?>
<?php  ?><?php  $attr3_field='login_name';  ?><?php
if (isset($errors[0])) $attr3_field = $errors[0];
?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $attr3_field ?>.focus();
document.forms[0].<?php echo $attr3_field ?>.select();
</script>
<?php unset($attr3_field); ?><?php  ?><?php }
unset($attr1_tmp_last_exec) ?><?php  ?><?php  ?></body>
</html><?php  ?>