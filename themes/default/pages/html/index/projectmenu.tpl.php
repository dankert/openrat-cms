<?php $attr1_debug_info = 'a:2:{s:5:"class";s:4:"main";s:5:"title";s:30:"message:MENU_INDEX_PROJECTMENU";}' ?><?php $attr1 = array('class'=>'main','title'=>lang('MENU_INDEX_PROJECTMENU')) ?><?php $attr1_class='main' ?><?php $attr1_title=lang('MENU_INDEX_PROJECTMENU') ?><?php
 if (!headers_sent()) header('Content-Type: text/html; charset='.$charset)
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo isset($attr1_title)?$attr1_title.' - ':(isset($windowTitle)?lang($windowTitle).' - ':'') ?><?php echo $cms_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo $charset ?>" />
  <meta name="MSSmartTagsPreventParsing" content="true" />
  <meta name="robots" content="noindex,nofollow" />
<?php if (isset($windowMenu) && is_array($windowMenu)) foreach( $windowMenu as $menu )
      {
       	?>
  <link rel="section" href="<?php echo Html::url($actionName,@$menu['subaction'],$this->getRequestId() ) ?>" title="<?php echo lang($menu['text']) ?>" />
<?php
      }
?><?php if (isset($metaList) && is_array($metaList)) foreach( $metaList as $meta )
      {
       	?>
  <link rel="<?php echo $meta['name'] ?>" href="<?php echo $meta['url'] ?>" title="<?php echo lang($meta['title']) ?>" /><?php
      }
?><script type="text/javascript" src="themes/default/js/jquery.js"></script>
    <script type="text/javascript" src="themes/default/js/jquery-lightbox.js"></script>
    <link rel="stylesheet" type="text/css" href="themes/default/js/lightbox/css/jquery-lightbox.css" media="screen" />
    <script type="text/javascript">
    $(function() {
        $('a.image').lightBox();
    });
    </script>
<?php if(!empty($root_stylesheet)) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $root_stylesheet ?>" />
<?php } ?>
<?php if($root_stylesheet!=$user_stylesheet) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $user_stylesheet ?>" />
<?php } ?>
</head>
<body class="<?php echo $attr1_class ?>" <?php if (@$conf['interface']['application_mode']) { ?> style="padding:0px;margin:0px;"<?php } ?> >
<?php unset($attr1) ?><?php unset($attr1_class) ?><?php unset($attr1_title) ?><?php $attr2_debug_info = 'a:6:{s:5:"title";s:15:"GLOBAL_PROJECTS";s:4:"name";s:5:"login";s:4:"icon";s:7:"project";s:5:"width";s:3:"600";s:10:"rowclasses";s:8:"odd,even";s:13:"columnclasses";s:5:"1,2,3";}' ?><?php $attr2 = array('title'=>'GLOBAL_PROJECTS','name'=>'login','icon'=>'project','width'=>'600','rowclasses'=>'odd,even','columnclasses'=>'1,2,3') ?><?php $attr2_title='GLOBAL_PROJECTS' ?><?php $attr2_name='login' ?><?php $attr2_icon='project' ?><?php $attr2_width='600' ?><?php $attr2_rowclasses='odd,even' ?><?php $attr2_columnclasses='1,2,3' ?><?php
	$coloumn_widths=array();
	if	(!empty($attr2_widths))
	{
		$column_widths = explode(',',$attr2_widths);
		unset($attr2['widths']);
	}
	if	(!empty($attr2_rowclasses))
	{
		$row_classes   = explode(',',$attr2_rowclasses);
		$row_class_idx = 999;
		unset($attr2['rowclasses']);
	}
	if	(!empty($attr2_columnclasses))
	{
		$column_classes = explode(',',$attr2_columnclasses);
		unset($attr2['columnclasses']);
	}
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
  <?php if ($this->getRequestVar('mode')=='edit') { 
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId()                       ) ?>" accesskey="1" title="<?php echo langHtml('MODE_EDIT_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="themes/default/images/mode-edit.png" style="vertical-align:top; " border="0" /></a> <?php } else {
  ?><a href="<?php echo Html::url($actionName,$subActionName,$this->getRequestId(),array('mode'=>'edit') ) ?>" accesskey="1" title="<?php echo langHtml('MODE_SHOW_DESC') ?>" class="path" style="text-align:right;font-weight:bold;font-weight:bold;"><img src="themes/default/images/readonly.png" style="vertical-align:top; " border="0" /></a> <?php }
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
    <td colspan="2" class="subaction" style="padding:2px; white-space:nowrap; border-bottom:1px solid black;"><img src="<?php echo $image_dir.'icon_'.$notice['type'].IMG_ICON_EXT ?>" align="left" /><?php echo $notice['name'] ?>
    </td>
  </tr>
<?php } ?>
  <tr class="notice_<?php echo $notice['status'] ?>">
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
      <table class="n" cellspacing="0" width="100%" cellpadding="4">
<?php unset($attr2) ?><?php unset($attr2_title) ?><?php unset($attr2_name) ?><?php unset($attr2_icon) ?><?php unset($attr2_width) ?><?php unset($attr2_rowclasses) ?><?php unset($attr2_columnclasses) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr3_class))
		$attr3_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr3_class ?>"><?php unset($attr3) ?><?php $attr4_debug_info = 'a:2:{s:5:"class";s:4:"logo";s:7:"colspan";s:1:"2";}' ?><?php $attr4 = array('class'=>'logo','colspan'=>'2') ?><?php $attr4_class='logo' ?><?php $attr4_colspan='2' ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr4_class))
		$attr4['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr4_rowspan) )
		$attr4['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr4 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr4) ?><?php unset($attr4_class) ?><?php unset($attr4_colspan) ?><?php $attr5_debug_info = 'a:1:{s:4:"name";s:11:"projectmenu";}' ?><?php $attr5 = array('name'=>'projectmenu') ?><?php $attr5_name='projectmenu' ?><img src="<?php echo $image_dir.'logo_'.$attr5_name.IMG_ICON_EXT ?>" border="0" align="left"><h2 class="logo"><?php echo langHtml('logo_'.$attr5_name) ?></h2><p class="logo"><?php echo langHtml('logo_'.$attr5_name.'_text') ?></p><?php unset($attr5) ?><?php unset($attr5_name) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></td><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?></tr><?php unset($attr2) ?><?php $attr3_debug_info = 'a:4:{s:4:"list";s:8:"projects";s:7:"extract";s:4:"true";s:3:"key";s:8:"list_key";s:5:"value";s:10:"list_value";}' ?><?php $attr3 = array('list'=>'projects','extract'=>true,'key'=>'list_key','value'=>'list_value') ?><?php $attr3_list='projects' ?><?php $attr3_extract=true ?><?php $attr3_key='list_key' ?><?php $attr3_value='list_value' ?><?php
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
?><?php unset($attr3) ?><?php unset($attr3_list) ?><?php unset($attr3_extract) ?><?php unset($attr3_key) ?><?php unset($attr3_value) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr4_class))
		$attr4_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5_debug_info = 'a:1:{s:7:"colspan";s:1:"3";}' ?><?php $attr5 = array('colspan'=>'3') ?><?php $attr5_colspan='3' ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr5_class))
		$attr5['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
		$attr5['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php unset($attr5_colspan) ?><?php $attr6_debug_info = 'a:1:{s:5:"title";s:8:"var:name";}' ?><?php $attr6 = array('title'=>$name) ?><?php $attr6_title=$name ?><fieldset><?php if(isset($attr6_title)) { ?><legend><?php echo encodeHtml($attr6_title) ?></legend><?php } ?><?php unset($attr6) ?><?php unset($attr6_title) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></fieldset><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr4_class))
		$attr4_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr5_class))
		$attr5['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
		$attr5['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php $attr6_debug_info = 'a:4:{s:5:"title";s:27:"message:TREE_CHOOSE_PROJECT";s:6:"target";s:5:"_self";s:3:"url";s:7:"var:url";s:5:"class";s:0:"";}' ?><?php $attr6 = array('title'=>lang('TREE_CHOOSE_PROJECT'),'target'=>'_self','url'=>$url,'class'=>'') ?><?php $attr6_title=lang('TREE_CHOOSE_PROJECT') ?><?php $attr6_target='_self' ?><?php $attr6_url=$url ?><?php $attr6_class='' ?><?php
	$params = array();
	if (!empty($attr6_var1) && isset($attr6_value1))
		$params[$attr6_var1]=$attr6_value1;
	if (!empty($attr6_var2) && isset($attr6_value2))
		$params[$attr6_var2]=$attr6_value2;
	if (!empty($attr6_var3) && isset($attr6_value3))
		$params[$attr6_var3]=$attr6_value3;
	if (!empty($attr6_var4) && isset($attr6_value4))
		$params[$attr6_var4]=$attr6_value4;
	if (!empty($attr6_var5) && isset($attr6_value5))
		$params[$attr6_var5]=$attr6_value5;
	if(empty($attr6_class))
		$attr6_class='';
	if(empty($attr6_title))
		$attr6_title = '';
	if(!empty($attr6_url))
		$tmp_url = $attr6_url;
	else
		$tmp_url = Html::url($attr6_action,$attr6_subaction,!empty($attr6_id)?$attr6_id:$this->getRequestId(),$params);
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr6_class ?>" target="<?php echo $attr6_target ?>"<?php if (isset($attr6_accesskey)) echo ' accesskey="'.$attr6_accesskey.'"' ?>  title="<?php echo encodeHtml($attr6_title) ?>"><?php unset($attr6) ?><?php unset($attr6_title) ?><?php unset($attr6_target) ?><?php unset($attr6_url) ?><?php unset($attr6_class) ?><?php $attr7_debug_info = 'a:2:{s:3:"var";s:7:"project";s:5:"value";s:7:"project";}' ?><?php $attr7 = array('var'=>'project','value'=>'project') ?><?php $attr7_var='project' ?><?php $attr7_value='project' ?><?php
	if (!isset($attr7_value))
		unset($$attr7_var);
	elseif (isset($attr7_key))
		$$attr7_var = $attr7_value[$attr7_key];
	else
		$$attr7_var = $attr7_value;
?><?php unset($attr7) ?><?php unset($attr7_var) ?><?php unset($attr7_value) ?><?php $attr7_debug_info = 'a:2:{s:5:"align";s:4:"left";s:4:"type";s:7:"project";}' ?><?php $attr7 = array('align'=>'left','type'=>'project') ?><?php $attr7_align='left' ?><?php $attr7_type='project' ?><?php
if (isset($attr7_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr7_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr7_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr7_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_url)) {
?><img src="<?php echo $attr7_url ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_fileext)) {
?><img src="<?php echo $image_dir.$attr7_fileext ?>" border="0" align="<?php echo $attr7_align ?>"><?php
} elseif (isset($attr7_file)) {
?><img src="<?php echo $image_dir.$attr7_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr7_align ?>"><?php } ?><?php unset($attr7) ?><?php unset($attr7_align) ?><?php unset($attr7_type) ?><?php $attr7_debug_info = 'a:3:{s:5:"class";s:4:"text";s:3:"var";s:4:"name";s:6:"escape";s:4:"true";}' ?><?php $attr7 = array('class'=>'text','var'=>'name','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_var='name' ?><?php $attr7_escape=true ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
	if(empty($attr7_title))
			$attr7_title = '';
	if	(empty($attr7_type))
		$tmp_tag = 'span';
	else
		switch( $attr7_type )
		{
			case 'emphatic':
			case 'italic':
				$tmp_tag = 'em';
				break;
			case 'strong':
			case 'bold':
				$tmp_tag = 'strong';
				break;
			case 'tt':
			case 'teletype':
				$tmp_tag = 'tt';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
	$attr7_title = '';
	if	( $attr7_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr7_array))
	{
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = $langF($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		$tmp_text = $langF($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = $langF($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = $langF($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?$$attr7_var:'?unset:'.$attr7_var.'?';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
	if	(isset($attr7_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_var) ?><?php unset($attr7_escape) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></a><?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr5_class))
		$attr5['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr5_rowspan) )
		$attr5['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php $attr6_debug_info = 'a:7:{s:6:"action";s:5:"index";s:9:"subaction";s:7:"project";s:2:"id";s:6:"var:id";s:4:"name";s:0:"";s:6:"target";s:5:"_self";s:6:"method";s:4:"post";s:7:"enctype";s:33:"application/x-www-form-urlencoded";}' ?><?php $attr6 = array('action'=>'index','subaction'=>'project','id'=>$id,'name'=>'','target'=>'_self','method'=>'post','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr6_action='index' ?><?php $attr6_subaction='project' ?><?php $attr6_id=$id ?><?php $attr6_name='' ?><?php $attr6_target='_self' ?><?php $attr6_method='post' ?><?php $attr6_enctype='application/x-www-form-urlencoded' ?><?php
	if	(empty($attr6_action))
		$attr6_action = $actionName;
	if	(empty($attr6_subaction))
		$attr6_subaction = $targetSubActionName;
	if	(empty($attr6_id))
		$attr6_id = $this->getRequestId();
	if ($this->isEditable() && $this->getRequestVar('mode')!='edit')
		$attr6_subaction = $subActionName;
?><form name="<?php echo $attr6_name ?>"
      target="<?php echo $attr6_target ?>"
      action="<?php echo Html::url( $attr6_action,$attr6_subaction,$attr6_id ) ?>"
      method="<?php echo $attr6_method ?>"
      enctype="<?php echo $attr6_enctype ?>" style="margin:0px;padding:0px;">
<?php if ($this->isEditable() && $this->getRequestVar('mode')!='edit') { ?>
<input type="hidden" name="mode" value="edit" />
<?php } ?>
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr6_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr6_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr6_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr6) ?><?php unset($attr6_action) ?><?php unset($attr6_subaction) ?><?php unset($attr6_id) ?><?php unset($attr6_name) ?><?php unset($attr6_target) ?><?php unset($attr6_method) ?><?php unset($attr6_enctype) ?><?php $attr7_debug_info = 'a:5:{s:5:"width";s:4:"100%";s:5:"space";s:3:"0px";s:7:"padding";s:3:"0px";s:6:"widths";s:11:"150px,150px";s:10:"rowclasses";s:8:"odd,even";}' ?><?php $attr7 = array('width'=>'100%','space'=>'0px','padding'=>'0px','widths'=>'150px,150px','rowclasses'=>'odd,even') ?><?php $attr7_width='100%' ?><?php $attr7_space='0px' ?><?php $attr7_padding='0px' ?><?php $attr7_widths='150px,150px' ?><?php $attr7_rowclasses='odd,even' ?><?php
	$coloumn_widths=array();
	$row_classes   = array('');
	$column_classes= array('');
	if(empty($attr7_class))
		$attr7_class='';
	if	(!empty($attr7_widths))
	{
		$column_widths = explode(',',$attr7_widths);
		unset($attr7['widths']);
	}
	if	(!empty($attr7_classes))
	{
		$row_classes   = explode(',',$attr7_rowclasses);
		$row_class_idx = 999;
		unset($attr7['rowclasses']);
	}
	if	(!empty($attr7_rowclasses))
	{
		$row_classes   = explode(',',$attr7_rowclasses);
		$row_class_idx = 999;
		unset($attr7['rowclasses']);
	}
	if	(!empty($attr7_columnclasses))
	{
		$column_classes   = explode(',',$attr7_columnclasses);
		unset($attr7['columnclasses']);
	}
?><table class="<?php echo $attr7_class ?>" cellspacing="<?php echo $attr7_space ?>" width="<?php echo $attr7_width ?>" cellpadding="<?php echo $attr7_padding ?>"><?php unset($attr7) ?><?php unset($attr7_width) ?><?php unset($attr7_space) ?><?php unset($attr7_padding) ?><?php unset($attr7_widths) ?><?php unset($attr7_rowclasses) ?><?php $attr8_debug_info = 'a:0:{}' ?><?php $attr8 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];
	if (empty($attr8_class))
		$attr8_class=$row_class;
	global $cell_column_nr;
	$cell_column_nr=0;
	$column_class_idx = 999;
?><tr class="<?php echo $attr8_class ?>"><?php unset($attr8) ?><?php $attr9_debug_info = 'a:0:{}' ?><?php $attr9 = array() ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr9_class))
		$attr9['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr9_rowspan) )
		$attr9['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr9 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr9) ?><?php $attr10_debug_info = 'a:6:{s:4:"list";s:6:"models";s:4:"name";s:7:"modelid";s:7:"default";s:18:"var:defaultmodelid";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";}' ?><?php $attr10 = array('list'=>'models','name'=>'modelid','default'=>$defaultmodelid,'onchange'=>'','title'=>'','class'=>'') ?><?php $attr10_list='models' ?><?php $attr10_name='modelid' ?><?php $attr10_default=$defaultmodelid ?><?php $attr10_onchange='' ?><?php $attr10_title='' ?><?php $attr10_class='' ?><?php $attr10_tmp_list = $$attr10_list;
		if	( isset($$attr10_name) && isset($attr10_tmp_list[$$attr10_name]) )
			$attr10_tmp_default = $$attr10_name;
		elseif ( isset($attr10_default) )
			$attr10_tmp_default = $attr10_default;
		else
			$attr10_tmp_default = '';
		foreach( $attr10_tmp_list as $box_key=>$box_value )
		{
			$id = 'id_'.$attr10_name.'_'.$box_key;
			echo '<input id="'.$id.'" name="'.$attr10_name.'" type="radio" class="'.$attr10_class.'" value="'.$box_key.'"';
			if ($box_key==$attr10_tmp_default)
				echo ' checked="checked"';
			echo '>&nbsp;<label for="'.$id.'">'.$box_value.'</label><br>';
		}
?><?php unset($attr10) ?><?php unset($attr10_list) ?><?php unset($attr10_name) ?><?php unset($attr10_default) ?><?php unset($attr10_onchange) ?><?php unset($attr10_title) ?><?php unset($attr10_class) ?><?php $attr8_debug_info = 'a:0:{}' ?><?php $attr8 = array() ?></td><?php unset($attr8) ?><?php $attr9_debug_info = 'a:0:{}' ?><?php $attr9 = array() ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr9_class))
		$attr9['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr9_rowspan) )
		$attr9['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr9 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr9) ?><?php $attr10_debug_info = 'a:6:{s:4:"list";s:9:"languages";s:4:"name";s:10:"languageid";s:7:"default";s:21:"var:defaultlanguageid";s:8:"onchange";s:0:"";s:5:"title";s:0:"";s:5:"class";s:0:"";}' ?><?php $attr10 = array('list'=>'languages','name'=>'languageid','default'=>$defaultlanguageid,'onchange'=>'','title'=>'','class'=>'') ?><?php $attr10_list='languages' ?><?php $attr10_name='languageid' ?><?php $attr10_default=$defaultlanguageid ?><?php $attr10_onchange='' ?><?php $attr10_title='' ?><?php $attr10_class='' ?><?php $attr10_tmp_list = $$attr10_list;
		if	( isset($$attr10_name) && isset($attr10_tmp_list[$$attr10_name]) )
			$attr10_tmp_default = $$attr10_name;
		elseif ( isset($attr10_default) )
			$attr10_tmp_default = $attr10_default;
		else
			$attr10_tmp_default = '';
		foreach( $attr10_tmp_list as $box_key=>$box_value )
		{
			$id = 'id_'.$attr10_name.'_'.$box_key;
			echo '<input id="'.$id.'" name="'.$attr10_name.'" type="radio" class="'.$attr10_class.'" value="'.$box_key.'"';
			if ($box_key==$attr10_tmp_default)
				echo ' checked="checked"';
			echo '>&nbsp;<label for="'.$id.'">'.$box_value.'</label><br>';
		}
?><?php unset($attr10) ?><?php unset($attr10_list) ?><?php unset($attr10_name) ?><?php unset($attr10_default) ?><?php unset($attr10_onchange) ?><?php unset($attr10_title) ?><?php unset($attr10_class) ?><?php $attr8_debug_info = 'a:0:{}' ?><?php $attr8 = array() ?></td><?php unset($attr8) ?><?php $attr9_debug_info = 'a:0:{}' ?><?php $attr9 = array() ?><?php
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr9_class))
		$attr9['class']=$column_class;
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr9_rowspan) )
		$attr9['width']=$column_widths[$cell_column_nr-1];
?><td <?php foreach( $attr9 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr9) ?><?php $attr10_debug_info = 'a:4:{s:4:"type";s:2:"ok";s:5:"class";s:2:"ok";s:5:"value";s:2:"ok";s:4:"text";s:9:"button_ok";}' ?><?php $attr10 = array('type'=>'ok','class'=>'ok','value'=>'ok','text'=>'button_ok') ?><?php $attr10_type='ok' ?><?php $attr10_class='ok' ?><?php $attr10_value='ok' ?><?php $attr10_text='button_ok' ?><?php
	if ($attr10_type=='ok')
	{
		if ($this->isEditable() && !$this->isEditMode())
		$attr10_text = 'MODE_EDIT';
	}
	if ($attr10_type=='ok')
		$attr10_type  = 'submit';
	if (isset($attr10_src))
		$attr10_type  = 'image';
	else
		$attr10_src  = '';
?><input type="<?php echo $attr10_type ?>"<?php if(isset($attr10_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr10_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr10_value ?>" class="<?php echo $attr10_class ?>" title="<?php echo lang($attr10_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo langHtml($attr10_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr10_src) ?><?php
?><?php unset($attr10) ?><?php unset($attr10_type) ?><?php unset($attr10_class) ?><?php unset($attr10_value) ?><?php unset($attr10_text) ?><?php $attr8_debug_info = 'a:0:{}' ?><?php $attr8 = array() ?></td><?php unset($attr8) ?><?php $attr7_debug_info = 'a:0:{}' ?><?php $attr7 = array() ?></tr><?php unset($attr7) ?><?php $attr6_debug_info = 'a:0:{}' ?><?php $attr6 = array() ?></table><?php unset($attr6) ?><?php $attr5_debug_info = 'a:0:{}' ?><?php $attr5 = array() ?></form>
<?php unset($attr5) ?><?php $attr4_debug_info = 'a:0:{}' ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3_debug_info = 'a:0:{}' ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr2_debug_info = 'a:0:{}' ?><?php $attr2 = array() ?><?php } ?><?php unset($attr2) ?><?php $attr1_debug_info = 'a:0:{}' ?><?php $attr1 = array() ?>      </table>
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
<?php unset($attr1) ?><?php $attr0_debug_info = 'a:0:{}' ?><?php $attr0 = array() ?></body>
</html><?php unset($attr0) ?>