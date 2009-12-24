<?php  $attr1_class='main';  ?><?php
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
<?php /* Debug-Information */ if ($showDuration) { echo "<!-- Output Variables are:\n";echo str_replace('-->','-- >',print_r($this->templateVars,true));echo "\n-->";} ?><?php unset($attr1_class); ?><?php  $attr2_width='93%';  $attr2_rowclasses='odd,even';  $attr2_columnclasses='1,2,3';  ?><?php
	$coloumn_widths=array();
	$row_classes   = explode(',',$attr2_rowclasses);
	$row_class_idx = 999;
	$column_classes = explode(',',$attr2_columnclasses);
		global $image_dir;
		if (@$conf['interface']['application_mode'] )
		{
			echo '<table class="main" cellspacing="0" cellpadding="4" width="100%" style="margin:0px;border:0px; padding:0px;" height_oo="100%">';
		}
		else
		{
			echo '<br/><br/><br/><center>';
			echo '<table class="main" cellspacing="0" cellpadding="4" width="'.$attr2_width.'">';
		}
		if (!@$conf['interface']['application_mode'] )
		{
		echo '<tr><td class="menu">';
		echo '<img src="'.$image_dir.'icon_'.$actionName.IMG_ICON_EXT.'" align="left" border="0">';
		if ($this->isEditable()) { ?>
  <?php if ($this->isEditMode()) { 
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId()                       ) ?>" accesskey="1" title="<?php echo langHtml('MODE_EDIT_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="<?php echo $image_dir ?>mode-edit.png" style="vertical-align:top; " border="0" /></a> <?php }
   elseif (readonly()) {
  ?><img src="<?php echo $image_dir ?>readonly.png" style="vertical-align:top; " border="0" /> <?php } else {
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
    <td class="window">
      <table cellspacing="0" width="100%" cellpadding="4">
<?php unset($attr2_width);unset($attr2_rowclasses);unset($attr2_columnclasses); ?><?php  ?><?php
	$attr3_tmp_class='';
	$attr3_last_class = $attr3_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr3_tmp_class));
?><?php  ?><?php  $attr4_class='help';  $attr4_colspan='7';  ?><?php
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
?> colspan="<?php echo $attr4_colspan ?>" <?php
?>><?php unset($attr4_class);unset($attr4_colspan); ?><?php  $attr5_class='text';  $attr5_text='GLOBAL_FOLDER_DESC';  $attr5_escape=true;  ?><?php
		$attr5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
		$langF = $attr5_escape?'langHtml':'lang';
		$tmp_text = $langF($attr5_text);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_class);unset($attr5_text);unset($attr5_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  $attr3_class='headline';  ?><?php
	$attr3_tmp_class='';
	$attr3_tmp_class=$attr3_class;
	$attr3_last_class = $attr3_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr3_tmp_class));
?><?php unset($attr3_class); ?><?php  $attr4_class='help';  $attr4_colspan='4';  ?><?php
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
?> colspan="<?php echo $attr4_colspan ?>" <?php
?>><?php unset($attr4_class);unset($attr4_colspan); ?><?php  $attr5_title=lang('FOLDER_FLIP');  $attr5_target='_self';  $attr5_url=$flip_url;  $attr5_class='';  ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $attr5_url;
?><a<?php if (isset($attr5_name)) echo ' name="'.$attr5_name.'"'; else echo ' href="'.$tmp_url.(isset($attr5_anchor)?'#'.$attr5_anchor:'').'"' ?> class="<?php echo $attr5_class ?>" target="<?php echo $attr5_target ?>"<?php if (isset($attr5_accesskey)) echo ' accesskey="'.$attr5_accesskey.'"' ?>  title="<?php echo encodeHtml($attr5_title) ?>"><?php unset($attr5_title);unset($attr5_target);unset($attr5_url);unset($attr5_class); ?><?php  $attr6_class='text';  $attr6_key='FOLDER_ORDER';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($attr6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_key);unset($attr6_escape); ?><?php  ?></a><?php  ?><?php  ?></td><?php  ?><?php  $attr4_class='help';  ?><?php
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
?>><?php unset($attr4_class); ?><?php  $attr5_title=lang('FOLDER_ORDERBYTYPE');  $attr5_target='_self';  $attr5_url=$orderbytype_url;  $attr5_class='';  ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $attr5_url;
?><a<?php if (isset($attr5_name)) echo ' name="'.$attr5_name.'"'; else echo ' href="'.$tmp_url.(isset($attr5_anchor)?'#'.$attr5_anchor:'').'"' ?> class="<?php echo $attr5_class ?>" target="<?php echo $attr5_target ?>"<?php if (isset($attr5_accesskey)) echo ' accesskey="'.$attr5_accesskey.'"' ?>  title="<?php echo encodeHtml($attr5_title) ?>"><?php unset($attr5_title);unset($attr5_target);unset($attr5_url);unset($attr5_class); ?><?php  $attr6_class='text';  $attr6_key='GLOBAL_TYPE';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($attr6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_key);unset($attr6_escape); ?><?php  ?></a><?php  ?><?php  $attr5_class='text';  $attr5_raw='_/_';  $attr5_escape=true;  ?><?php
		$attr5_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
		$langF = $attr5_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_class);unset($attr5_raw);unset($attr5_escape); ?><?php  $attr5_title=lang('FOLDER_ORDERBYNAME');  $attr5_target='_self';  $attr5_url=$orderbyname_url;  $attr5_class='';  ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $attr5_url;
?><a<?php if (isset($attr5_name)) echo ' name="'.$attr5_name.'"'; else echo ' href="'.$tmp_url.(isset($attr5_anchor)?'#'.$attr5_anchor:'').'"' ?> class="<?php echo $attr5_class ?>" target="<?php echo $attr5_target ?>"<?php if (isset($attr5_accesskey)) echo ' accesskey="'.$attr5_accesskey.'"' ?>  title="<?php echo encodeHtml($attr5_title) ?>"><?php unset($attr5_title);unset($attr5_target);unset($attr5_url);unset($attr5_class); ?><?php  $attr6_class='text';  $attr6_key='GLOBAL_NAME';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($attr6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_key);unset($attr6_escape); ?><?php  ?></a><?php  ?><?php  ?></td><?php  ?><?php  $attr4_class='help';  ?><?php
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
?>><?php unset($attr4_class); ?><?php  $attr5_title=lang('FOLDER_ORDERBYLASTCHANGE');  $attr5_target='_self';  $attr5_url=$orderbylastchange_url;  $attr5_class='';  ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $attr5_url;
?><a<?php if (isset($attr5_name)) echo ' name="'.$attr5_name.'"'; else echo ' href="'.$tmp_url.(isset($attr5_anchor)?'#'.$attr5_anchor:'').'"' ?> class="<?php echo $attr5_class ?>" target="<?php echo $attr5_target ?>"<?php if (isset($attr5_accesskey)) echo ' accesskey="'.$attr5_accesskey.'"' ?>  title="<?php echo encodeHtml($attr5_title) ?>"><?php unset($attr5_title);unset($attr5_target);unset($attr5_url);unset($attr5_class); ?><?php  $attr6_class='text';  $attr6_key='GLOBAL_LASTCHANGE';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = $langF($attr6_key);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_key);unset($attr6_escape); ?><?php  ?></a><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  $attr3_list='object';  $attr3_extract=true;  $attr3_key='list_key';  $attr3_value='list_value';  ?><?php
	$attr3_list_tmp_key   = $attr3_key;
	$attr3_list_tmp_value = $attr3_value;
	$attr3_list_extract   = $attr3_extract;
	unset($attr3_key);
	unset($attr3_value);
	if	( !isset($$attr3_list) || !is_array($$attr3_list) )
		$$attr3_list = array();
	foreach( $$attr3_list as $$attr3_list_tmp_key => $$attr3_list_tmp_value )
	{
		if	( $attr3_list_extract )
		{
			if	( !is_array($$attr3_list_tmp_value) )
			{
				print_r($$attr3_list_tmp_value);
				die( 'not an array at key: '.$$attr3_list_tmp_key );
			}
			extract($$attr3_list_tmp_value);
		}
?><?php unset($attr3_list);unset($attr3_extract);unset($attr3_key);unset($attr3_value); ?><?php  $attr4_class='data';  ?><?php
	$attr4_tmp_class='';
	$attr4_tmp_class=$attr4_class;
	$attr4_last_class = $attr4_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr4_tmp_class));
?><?php unset($attr4_class); ?><?php  $attr5_width='3%';  ?><?php
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
?> width="<?php echo $attr5_width ?>"<?php
?>><?php unset($attr5_width); ?><?php  $attr6_present='upurl';  ?><?php 
	$attr6_tmp_exec = isset($$attr6_present);
	$attr6_tmp_last_exec = $attr6_tmp_exec;
	if	( $attr6_tmp_exec )
	{
?>
<?php unset($attr6_present); ?><?php  $attr7_title='GLOBAL_UP';  $attr7_target='_self';  $attr7_url=$upurl;  $attr7_class='';  ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $attr7_url;
?><a<?php if (isset($attr7_name)) echo ' name="'.$attr7_name.'"'; else echo ' href="'.$tmp_url.(isset($attr7_anchor)?'#'.$attr7_anchor:'').'"' ?> class="<?php echo $attr7_class ?>" target="<?php echo $attr7_target ?>"<?php if (isset($attr7_accesskey)) echo ' accesskey="'.$attr7_accesskey.'"' ?>  title="<?php echo encodeHtml($attr7_title) ?>"><?php unset($attr7_title);unset($attr7_target);unset($attr7_url);unset($attr7_class); ?><?php  $attr8_var='bild';  $attr8_value='arrow_up';  ?><?php
	if (isset($attr8_key))
		$$attr8_var = $attr8_value[$attr8_key];
	else
		$$attr8_var = $attr8_value;
?><?php unset($attr8_var);unset($attr8_value); ?><?php  $attr8_file=$bild;  $attr8_align='left';  ?><?php
	$attr8_tmp_image_file = $image_dir.$attr8_file.IMG_ICON_EXT;
	$attr8_tmp_title = basename($attr8_tmp_image_file);
?><img alt="<?php echo $attr8_tmp_title; if (isset($attr8_size)) { echo ' ('; list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo $attr8_tmp_width.'x'.$attr8_tmp_height; echo')';} ?>" src="<?php echo $attr8_tmp_image_file ?>" border="0"<?php if(isset($attr8_align)) echo ' align="'.$attr8_align.'"' ?><?php if (isset($attr8_size)) { list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo ' width="'.$attr8_tmp_width.'" height="'.$attr8_tmp_height.'"';} ?>><?php unset($attr8_file);unset($attr8_align); ?><?php  ?></a><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr6_empty='upurl';  ?><?php 
	if	( !isset($$attr6_empty) )
		$attr6_tmp_exec = empty($attr6_empty);
	elseif	( is_array($$attr6_empty) )
		$attr6_tmp_exec = (count($$attr6_empty)==0);
	elseif	( is_bool($$attr6_empty) )
		$attr6_tmp_exec = true;
	else
		$attr6_tmp_exec = empty( $$attr6_empty );
	$attr6_tmp_last_exec = $attr6_tmp_exec;
	if	( $attr6_tmp_exec )
	{
?>
<?php unset($attr6_empty); ?><?php  $attr7_class='text';  $attr7_raw='_';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_raw);unset($attr7_escape); ?><?php  ?><?php } ?><?php  ?><?php  ?></td><?php  ?><?php  $attr5_width='3%';  ?><?php
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
?> width="<?php echo $attr5_width ?>"<?php
?>><?php unset($attr5_width); ?><?php  $attr6_present='topurl';  ?><?php 
	$attr6_tmp_exec = isset($$attr6_present);
	$attr6_tmp_last_exec = $attr6_tmp_exec;
	if	( $attr6_tmp_exec )
	{
?>
<?php unset($attr6_present); ?><?php  $attr7_title='GLOBAL_TOP';  $attr7_target='_self';  $attr7_url=$topurl;  $attr7_class='';  ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $attr7_url;
?><a<?php if (isset($attr7_name)) echo ' name="'.$attr7_name.'"'; else echo ' href="'.$tmp_url.(isset($attr7_anchor)?'#'.$attr7_anchor:'').'"' ?> class="<?php echo $attr7_class ?>" target="<?php echo $attr7_target ?>"<?php if (isset($attr7_accesskey)) echo ' accesskey="'.$attr7_accesskey.'"' ?>  title="<?php echo encodeHtml($attr7_title) ?>"><?php unset($attr7_title);unset($attr7_target);unset($attr7_url);unset($attr7_class); ?><?php  $attr8_var='bild';  $attr8_value='arrow_top';  ?><?php
	if (isset($attr8_key))
		$$attr8_var = $attr8_value[$attr8_key];
	else
		$$attr8_var = $attr8_value;
?><?php unset($attr8_var);unset($attr8_value); ?><?php  $attr8_file=$bild;  $attr8_align='left';  ?><?php
	$attr8_tmp_image_file = $image_dir.$attr8_file.IMG_ICON_EXT;
	$attr8_tmp_title = basename($attr8_tmp_image_file);
?><img alt="<?php echo $attr8_tmp_title; if (isset($attr8_size)) { echo ' ('; list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo $attr8_tmp_width.'x'.$attr8_tmp_height; echo')';} ?>" src="<?php echo $attr8_tmp_image_file ?>" border="0"<?php if(isset($attr8_align)) echo ' align="'.$attr8_align.'"' ?><?php if (isset($attr8_size)) { list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo ' width="'.$attr8_tmp_width.'" height="'.$attr8_tmp_height.'"';} ?>><?php unset($attr8_file);unset($attr8_align); ?><?php  ?></a><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr6_empty='topurl';  ?><?php 
	if	( !isset($$attr6_empty) )
		$attr6_tmp_exec = empty($attr6_empty);
	elseif	( is_array($$attr6_empty) )
		$attr6_tmp_exec = (count($$attr6_empty)==0);
	elseif	( is_bool($$attr6_empty) )
		$attr6_tmp_exec = true;
	else
		$attr6_tmp_exec = empty( $$attr6_empty );
	$attr6_tmp_last_exec = $attr6_tmp_exec;
	if	( $attr6_tmp_exec )
	{
?>
<?php unset($attr6_empty); ?><?php  $attr7_class='text';  $attr7_raw='_';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_raw);unset($attr7_escape); ?><?php  ?><?php } ?><?php  ?><?php  ?></td><?php  ?><?php  $attr5_width='3%';  ?><?php
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
?> width="<?php echo $attr5_width ?>"<?php
?>><?php unset($attr5_width); ?><?php  $attr6_present='bottomurl';  ?><?php 
	$attr6_tmp_exec = isset($$attr6_present);
	$attr6_tmp_last_exec = $attr6_tmp_exec;
	if	( $attr6_tmp_exec )
	{
?>
<?php unset($attr6_present); ?><?php  $attr7_title='GLOBAL_BOTTOM';  $attr7_target='_self';  $attr7_url=$bottomurl;  $attr7_class='';  ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $attr7_url;
?><a<?php if (isset($attr7_name)) echo ' name="'.$attr7_name.'"'; else echo ' href="'.$tmp_url.(isset($attr7_anchor)?'#'.$attr7_anchor:'').'"' ?> class="<?php echo $attr7_class ?>" target="<?php echo $attr7_target ?>"<?php if (isset($attr7_accesskey)) echo ' accesskey="'.$attr7_accesskey.'"' ?>  title="<?php echo encodeHtml($attr7_title) ?>"><?php unset($attr7_title);unset($attr7_target);unset($attr7_url);unset($attr7_class); ?><?php  $attr8_var='bild';  $attr8_value='arrow_bottom';  ?><?php
	if (isset($attr8_key))
		$$attr8_var = $attr8_value[$attr8_key];
	else
		$$attr8_var = $attr8_value;
?><?php unset($attr8_var);unset($attr8_value); ?><?php  $attr8_file=$bild;  $attr8_align='left';  ?><?php
	$attr8_tmp_image_file = $image_dir.$attr8_file.IMG_ICON_EXT;
	$attr8_tmp_title = basename($attr8_tmp_image_file);
?><img alt="<?php echo $attr8_tmp_title; if (isset($attr8_size)) { echo ' ('; list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo $attr8_tmp_width.'x'.$attr8_tmp_height; echo')';} ?>" src="<?php echo $attr8_tmp_image_file ?>" border="0"<?php if(isset($attr8_align)) echo ' align="'.$attr8_align.'"' ?><?php if (isset($attr8_size)) { list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo ' width="'.$attr8_tmp_width.'" height="'.$attr8_tmp_height.'"';} ?>><?php unset($attr8_file);unset($attr8_align); ?><?php  ?></a><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr6_empty='bottomurl';  ?><?php 
	if	( !isset($$attr6_empty) )
		$attr6_tmp_exec = empty($attr6_empty);
	elseif	( is_array($$attr6_empty) )
		$attr6_tmp_exec = (count($$attr6_empty)==0);
	elseif	( is_bool($$attr6_empty) )
		$attr6_tmp_exec = true;
	else
		$attr6_tmp_exec = empty( $$attr6_empty );
	$attr6_tmp_last_exec = $attr6_tmp_exec;
	if	( $attr6_tmp_exec )
	{
?>
<?php unset($attr6_empty); ?><?php  $attr7_class='text';  $attr7_raw='_';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_raw);unset($attr7_escape); ?><?php  ?><?php } ?><?php  ?><?php  ?></td><?php  ?><?php  $attr5_width='3%';  ?><?php
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
?> width="<?php echo $attr5_width ?>"<?php
?>><?php unset($attr5_width); ?><?php  $attr6_present='downurl';  ?><?php 
	$attr6_tmp_exec = isset($$attr6_present);
	$attr6_tmp_last_exec = $attr6_tmp_exec;
	if	( $attr6_tmp_exec )
	{
?>
<?php unset($attr6_present); ?><?php  $attr7_title='GLOBAL_DOWN';  $attr7_target='_self';  $attr7_url=$downurl;  $attr7_class='';  ?><?php
	$params = array();
	$tmp_url = '';
		$tmp_url = $attr7_url;
?><a<?php if (isset($attr7_name)) echo ' name="'.$attr7_name.'"'; else echo ' href="'.$tmp_url.(isset($attr7_anchor)?'#'.$attr7_anchor:'').'"' ?> class="<?php echo $attr7_class ?>" target="<?php echo $attr7_target ?>"<?php if (isset($attr7_accesskey)) echo ' accesskey="'.$attr7_accesskey.'"' ?>  title="<?php echo encodeHtml($attr7_title) ?>"><?php unset($attr7_title);unset($attr7_target);unset($attr7_url);unset($attr7_class); ?><?php  $attr8_var='bild';  $attr8_value='arrow_down';  ?><?php
	if (isset($attr8_key))
		$$attr8_var = $attr8_value[$attr8_key];
	else
		$$attr8_var = $attr8_value;
?><?php unset($attr8_var);unset($attr8_value); ?><?php  $attr8_file=$bild;  $attr8_align='left';  ?><?php
	$attr8_tmp_image_file = $image_dir.$attr8_file.IMG_ICON_EXT;
	$attr8_tmp_title = basename($attr8_tmp_image_file);
?><img alt="<?php echo $attr8_tmp_title; if (isset($attr8_size)) { echo ' ('; list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo $attr8_tmp_width.'x'.$attr8_tmp_height; echo')';} ?>" src="<?php echo $attr8_tmp_image_file ?>" border="0"<?php if(isset($attr8_align)) echo ' align="'.$attr8_align.'"' ?><?php if (isset($attr8_size)) { list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo ' width="'.$attr8_tmp_width.'" height="'.$attr8_tmp_height.'"';} ?>><?php unset($attr8_file);unset($attr8_align); ?><?php  ?></a><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr6_empty='downurl';  ?><?php 
	if	( !isset($$attr6_empty) )
		$attr6_tmp_exec = empty($attr6_empty);
	elseif	( is_array($$attr6_empty) )
		$attr6_tmp_exec = (count($$attr6_empty)==0);
	elseif	( is_bool($$attr6_empty) )
		$attr6_tmp_exec = true;
	else
		$attr6_tmp_exec = empty( $$attr6_empty );
	$attr6_tmp_last_exec = $attr6_tmp_exec;
	if	( $attr6_tmp_exec )
	{
?>
<?php unset($attr6_empty); ?><?php  $attr7_class='text';  $attr7_raw='_';  $attr7_escape=true;  ?><?php
		$attr7_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
		$langF = $attr7_escape?'langHtml':'lang';
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_raw);unset($attr7_escape); ?><?php  ?><?php } ?><?php  ?><?php  ?></td><?php  ?><?php  $attr5_width='40%';  ?><?php
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
?> width="<?php echo $attr5_width ?>"<?php
?>><?php unset($attr5_width); ?><?php  $attr6_align='left';  $attr6_type=$icon;  ?><?php
	$attr6_tmp_image_file = $image_dir.'icon_'.$attr6_type.IMG_ICON_EXT;
	$attr6_size = '16x16';
	$attr6_tmp_title = basename($attr6_tmp_image_file);
?><img alt="<?php echo $attr6_tmp_title; if (isset($attr6_size)) { echo ' ('; list($attr6_tmp_width,$attr6_tmp_height)=explode('x',$attr6_size);echo $attr6_tmp_width.'x'.$attr6_tmp_height; echo')';} ?>" src="<?php echo $attr6_tmp_image_file ?>" border="0"<?php if(isset($attr6_align)) echo ' align="'.$attr6_align.'"' ?><?php if (isset($attr6_size)) { list($attr6_tmp_width,$attr6_tmp_height)=explode('x',$attr6_size);echo ' width="'.$attr6_tmp_width.'" height="'.$attr6_tmp_height.'"';} ?>><?php unset($attr6_align);unset($attr6_type); ?><?php  $attr6_class='text';  $attr6_var='name';  $attr6_escape=true;  ?><?php
		$attr6_title = '';
		$tmp_tag = 'span';
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
		$langF = $attr6_escape?'langHtml':'lang';
		$tmp_text = isset($$attr6_var)?$$attr6_var:$langF('UNKNOWN');
	$tmp_text = nl2br($tmp_text);
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_var);unset($attr6_escape); ?><?php  ?></td><?php  ?><?php  $attr5_width='18%';  ?><?php
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
?> width="<?php echo $attr5_width ?>"<?php
?>><?php unset($attr5_width); ?><?php  $attr6_date=$date;  ?><?php	
    global $conf;
	$time = $attr6_date;
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
?><?php unset($attr6_date); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php } ?><?php  ?><?php  ?>      </table>
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
<?php  ?><?php  ?></body>
</html><?php  ?>