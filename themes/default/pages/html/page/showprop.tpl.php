<?php  $attr1_class='main';  ?><?php
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
?><?php if(!empty($root_stylesheet)) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $root_stylesheet ?>" />
<?php } ?>
<?php if($root_stylesheet!=$user_stylesheet) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $user_stylesheet ?>" />
<?php } ?>
</head>
<body class="<?php echo $attr1_class ?>" <?php if (@$conf['interface']['application_mode']) { ?> style="padding:0px;margin:0px;"<?php } ?> >
<?php unset($attr1_class); ?><?php  $attr2_icon='folder';  $attr2_widths='40%,60%';  $attr2_width='93%';  $attr2_rowclasses='odd,even';  $attr2_columnclasses='1,2,3';  ?><?php
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
<?php unset($attr2_icon);unset($attr2_widths);unset($attr2_width);unset($attr2_rowclasses);unset($attr2_columnclasses); ?><?php  ?><?php
	$attr3_tmp_class='';
	$attr3_last_class = $attr3_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr3_tmp_class));
?><?php  ?><?php  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php  ?><?php  $attr5_class='text';  $attr5_text='global_name';  $attr5_escape=true;  ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
	if(empty($attr5_title))
			$attr5_title = '';
	if	(empty($attr5_type))
		$tmp_tag = 'span';
	else
		switch( $attr5_type )
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
			case 'preformatted';
				$tmp_tag = 'pre';
				break;
			case 'code';
				$tmp_tag = 'code';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';
	if	( $attr5_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr5_array))
	{
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = $langF($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		$tmp_text = $langF($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = $langF($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = $langF($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_class);unset($attr5_text);unset($attr5_escape); ?><?php  ?></td><?php  ?><?php  $attr4_class='name';  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php unset($attr4_class); ?><?php  $attr5_class='text';  $attr5_var='name';  $attr5_escape=true;  ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
	if(empty($attr5_title))
			$attr5_title = '';
	if	(empty($attr5_type))
		$tmp_tag = 'span';
	else
		switch( $attr5_type )
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
			case 'preformatted';
				$tmp_tag = 'pre';
				break;
			case 'code';
				$tmp_tag = 'code';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';
	if	( $attr5_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr5_array))
	{
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = $langF($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		$tmp_text = $langF($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = $langF($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = $langF($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_class);unset($attr5_var);unset($attr5_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr3_tmp_class='';
	$attr3_last_class = $attr3_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr3_tmp_class));
?><?php  ?><?php  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php  ?><?php  $attr5_class='text';  $attr5_text=lang('global_description');  $attr5_escape=true;  ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
	if(empty($attr5_title))
			$attr5_title = '';
	if	(empty($attr5_type))
		$tmp_tag = 'span';
	else
		switch( $attr5_type )
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
			case 'preformatted';
				$tmp_tag = 'pre';
				break;
			case 'code';
				$tmp_tag = 'code';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';
	if	( $attr5_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr5_array))
	{
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = $langF($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		$tmp_text = $langF($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = $langF($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = $langF($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_class);unset($attr5_text);unset($attr5_escape); ?><?php  ?></td><?php  ?><?php  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php  ?><?php  $attr5_class='text';  $attr5_text=$description;  $attr5_escape=true;  ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
	if(empty($attr5_title))
			$attr5_title = '';
	if	(empty($attr5_type))
		$tmp_tag = 'span';
	else
		switch( $attr5_type )
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
			case 'preformatted';
				$tmp_tag = 'pre';
				break;
			case 'code';
				$tmp_tag = 'code';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';
	if	( $attr5_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr5_array))
	{
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = $langF($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		$tmp_text = $langF($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = $langF($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = $langF($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_class);unset($attr5_text);unset($attr5_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr3_tmp_class='';
	$attr3_last_class = $attr3_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr3_tmp_class));
?><?php  ?><?php  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php  ?><?php  $attr5_class='text';  $attr5_text='global_full_filename';  $attr5_escape=true;  ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
	if(empty($attr5_title))
			$attr5_title = '';
	if	(empty($attr5_type))
		$tmp_tag = 'span';
	else
		switch( $attr5_type )
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
			case 'preformatted';
				$tmp_tag = 'pre';
				break;
			case 'code';
				$tmp_tag = 'code';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';
	if	( $attr5_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr5_array))
	{
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = $langF($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		$tmp_text = $langF($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = $langF($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = $langF($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_class);unset($attr5_text);unset($attr5_escape); ?><?php  ?></td><?php  ?><?php  $attr4_class='filename';  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php unset($attr4_class); ?><?php  $attr5_class='text';  $attr5_var='full_filename';  $attr5_escape=true;  ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
	if(empty($attr5_title))
			$attr5_title = '';
	if	(empty($attr5_type))
		$tmp_tag = 'span';
	else
		switch( $attr5_type )
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
			case 'preformatted';
				$tmp_tag = 'pre';
				break;
			case 'code';
				$tmp_tag = 'code';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';
	if	( $attr5_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr5_array))
	{
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = $langF($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		$tmp_text = $langF($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = $langF($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = $langF($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_class);unset($attr5_var);unset($attr5_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr3_tmp_class='';
	$attr3_last_class = $attr3_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr3_tmp_class));
?><?php  ?><?php  $attr4_colspan='2';  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php unset($attr4_colspan); ?><?php  $attr5_title=lang('additional_info');  ?><fieldset><?php if(isset($attr5_title)) { ?><legend><?php echo encodeHtml($attr5_title) ?></legend><?php } ?><?php unset($attr5_title); ?><?php  ?></fieldset><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr3_tmp_class='';
	$attr3_last_class = $attr3_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr3_tmp_class));
?><?php  ?><?php  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php  ?><?php  $attr5_class='text';  $attr5_text='global_template';  $attr5_escape=true;  ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
	if(empty($attr5_title))
			$attr5_title = '';
	if	(empty($attr5_type))
		$tmp_tag = 'span';
	else
		switch( $attr5_type )
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
			case 'preformatted';
				$tmp_tag = 'pre';
				break;
			case 'code';
				$tmp_tag = 'code';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';
	if	( $attr5_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr5_array))
	{
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = $langF($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		$tmp_text = $langF($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = $langF($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = $langF($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_class);unset($attr5_text);unset($attr5_escape); ?><?php  ?></td><?php  ?><?php  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php  ?><?php  $attr5_present='template_url';  ?><?php 
	$attr5_tmp_exec = isset($$attr5_present);
	$attr5_tmp_last_exec = $attr5_tmp_exec;
	if	( $attr5_tmp_exec )
	{
?>
<?php unset($attr5_present); ?><?php  $attr6_title='';  $attr6_target='cms_main';  $attr6_url=$template_url;  $attr6_class='';  ?><?php
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
?><a<?php if (isset($attr6_name)) echo ' name="'.$attr6_name.'"'; else echo ' href="'.$tmp_url.($attr6_anchor?'#'.$attr6_anchor:'').'"' ?> class="<?php echo $attr6_class ?>" target="<?php echo $attr6_target ?>"<?php if (isset($attr6_accesskey)) echo ' accesskey="'.$attr6_accesskey.'"' ?>  title="<?php echo encodeHtml($attr6_title) ?>"><?php unset($attr6_title);unset($attr6_target);unset($attr6_url);unset($attr6_class); ?><?php  $attr7_file='icon_template';  $attr7_align='left';  ?><?php
	$attr7_tmp_image_file = $image_dir.$attr7_fileext;
	$attr7_tmp_image_file = $image_dir.$attr7_file.IMG_ICON_EXT;
?><img src="<?php echo $attr7_tmp_image_file ?>" border="0"<?php if(isset($attr7_align)) echo ' align="'.$attr7_align.'"' ?><?php if (isset($attr7_size)) { list($attr7_tmp_width,$attr7_tmp_height)=explode('x',$attr7_size);echo ' width="'.$attr7_tmp_width.'" height="'.$attr7_tmp_height.'"';} ?>><?php unset($attr7_file);unset($attr7_align); ?><?php  $attr7_class='text';  $attr7_var='template_name';  $attr7_escape=true;  ?><?php
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
			case 'preformatted';
				$tmp_tag = 'pre';
				break;
			case 'code';
				$tmp_tag = 'code';
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
?></<?php echo $tmp_tag ?>><?php unset($attr7_class);unset($attr7_var);unset($attr7_escape); ?><?php  ?></a><?php  ?><?php  ?><?php } ?><?php  ?><?php  $attr5_empty='template_url';  ?><?php 
	if	( !isset($$attr5_empty) )
		$attr5_tmp_exec = empty($attr5_empty);
	elseif	( is_array($$attr5_empty) )
		$attr5_tmp_exec = (count($$attr5_empty)==0);
	elseif	( is_bool($$attr5_empty) )
		$attr5_tmp_exec = true;
	else
		$attr5_tmp_exec = empty( $$attr5_empty );
	$attr5_tmp_last_exec = $attr5_tmp_exec;
	if	( $attr5_tmp_exec )
	{
?>
<?php unset($attr5_empty); ?><?php  $attr6_file='icon_template';  $attr6_align='left';  ?><?php
	$attr6_tmp_image_file = $image_dir.$attr6_fileext;
	$attr6_tmp_image_file = $image_dir.$attr6_file.IMG_ICON_EXT;
?><img src="<?php echo $attr6_tmp_image_file ?>" border="0"<?php if(isset($attr6_align)) echo ' align="'.$attr6_align.'"' ?><?php if (isset($attr6_size)) { list($attr6_tmp_width,$attr6_tmp_height)=explode('x',$attr6_size);echo ' width="'.$attr6_tmp_width.'" height="'.$attr6_tmp_height.'"';} ?>><?php unset($attr6_file);unset($attr6_align); ?><?php  $attr6_class='text';  $attr6_var='template_name';  $attr6_escape=true;  ?><?php
	if	( isset($attr6_prefix)&& isset($attr6_key))
		$attr6_key = $attr6_prefix.$attr6_key;
	if	( isset($attr6_suffix)&& isset($attr6_key))
		$attr6_key = $attr6_key.$attr6_suffix;
	if(empty($attr6_title))
			$attr6_title = '';
	if	(empty($attr6_type))
		$tmp_tag = 'span';
	else
		switch( $attr6_type )
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
			case 'preformatted';
				$tmp_tag = 'pre';
				break;
			case 'code';
				$tmp_tag = 'code';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
	$attr6_title = '';
	if	( $attr6_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr6_array))
	{
		$tmpArray = $$attr6_array;
		if (!empty($attr6_var))
			$tmp_text = $tmpArray[$attr6_var];
		else
			$tmp_text = $langF($tmpArray[$attr6_text]);
	}
	elseif (!empty($attr6_text))
		$tmp_text = $langF($attr6_text);
	elseif (!empty($attr6_textvar))
		$tmp_text = $langF($$attr6_textvar);
	elseif (!empty($attr6_key))
		$tmp_text = $langF($attr6_key);
	elseif (!empty($attr6_var))
		$tmp_text = isset($$attr6_var)?$$attr6_var:'?unset:'.$attr6_var.'?';	
	elseif (!empty($attr6_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	elseif (!empty($attr6_value))
		$tmp_text = $attr6_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
	if	(isset($attr6_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr6_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr6_class);unset($attr6_var);unset($attr6_escape); ?><?php  ?><?php } ?><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr3_tmp_class='';
	$attr3_last_class = $attr3_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr3_tmp_class));
?><?php  ?><?php  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php  ?><?php  $attr5_class='text';  $attr5_key='FILE_MIMETYPE';  $attr5_escape=true;  ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
	if(empty($attr5_title))
			$attr5_title = '';
	if	(empty($attr5_type))
		$tmp_tag = 'span';
	else
		switch( $attr5_type )
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
			case 'preformatted';
				$tmp_tag = 'pre';
				break;
			case 'code';
				$tmp_tag = 'code';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';
	if	( $attr5_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr5_array))
	{
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = $langF($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		$tmp_text = $langF($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = $langF($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = $langF($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_class);unset($attr5_key);unset($attr5_escape); ?><?php  ?></td><?php  ?><?php  $attr4_class='filename';  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php unset($attr4_class); ?><?php  $attr5_class='text';  $attr5_var='mime_type';  $attr5_escape=true;  ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
	if(empty($attr5_title))
			$attr5_title = '';
	if	(empty($attr5_type))
		$tmp_tag = 'span';
	else
		switch( $attr5_type )
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
			case 'preformatted';
				$tmp_tag = 'pre';
				break;
			case 'code';
				$tmp_tag = 'code';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';
	if	( $attr5_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr5_array))
	{
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = $langF($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		$tmp_text = $langF($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = $langF($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = $langF($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_class);unset($attr5_var);unset($attr5_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr3_tmp_class='';
	$attr3_last_class = $attr3_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr3_tmp_class));
?><?php  ?><?php  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php  ?><?php  $attr5_class='text';  $attr5_key='id';  $attr5_escape=true;  ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
	if(empty($attr5_title))
			$attr5_title = '';
	if	(empty($attr5_type))
		$tmp_tag = 'span';
	else
		switch( $attr5_type )
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
			case 'preformatted';
				$tmp_tag = 'pre';
				break;
			case 'code';
				$tmp_tag = 'code';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';
	if	( $attr5_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr5_array))
	{
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = $langF($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		$tmp_text = $langF($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = $langF($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = $langF($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_class);unset($attr5_key);unset($attr5_escape); ?><?php  ?></td><?php  ?><?php  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php  ?><?php  $attr5_class='text';  $attr5_var='objectid';  $attr5_escape=true;  ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
	if(empty($attr5_title))
			$attr5_title = '';
	if	(empty($attr5_type))
		$tmp_tag = 'span';
	else
		switch( $attr5_type )
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
			case 'preformatted';
				$tmp_tag = 'pre';
				break;
			case 'code';
				$tmp_tag = 'code';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';
	if	( $attr5_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr5_array))
	{
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = $langF($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		$tmp_text = $langF($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = $langF($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = $langF($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_class);unset($attr5_var);unset($attr5_escape); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr3_tmp_class='';
	$attr3_last_class = $attr3_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr3_tmp_class));
?><?php  ?><?php  $attr4_colspan='2';  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php unset($attr4_colspan); ?><?php  $attr5_title=lang('prop_userinfo');  ?><fieldset><?php if(isset($attr5_title)) { ?><legend><?php echo encodeHtml($attr5_title) ?></legend><?php } ?><?php unset($attr5_title); ?><?php  ?></fieldset><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr3_tmp_class='';
	$attr3_last_class = $attr3_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr3_tmp_class));
?><?php  ?><?php  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php  ?><?php  $attr5_class='text';  $attr5_text='global_created';  $attr5_escape=true;  ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
	if(empty($attr5_title))
			$attr5_title = '';
	if	(empty($attr5_type))
		$tmp_tag = 'span';
	else
		switch( $attr5_type )
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
			case 'preformatted';
				$tmp_tag = 'pre';
				break;
			case 'code';
				$tmp_tag = 'code';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';
	if	( $attr5_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr5_array))
	{
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = $langF($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		$tmp_text = $langF($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = $langF($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = $langF($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_class);unset($attr5_text);unset($attr5_escape); ?><?php  ?></td><?php  ?><?php  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php  ?><?php  $attr5_width='100%';  $attr5_space='0px';  $attr5_padding='0px';  ?><?php
	$coloumn_widths=array();
	$row_classes   = array('');
	$column_classes= array('');
	if(empty($attr5_class))
		$attr5_class='';
	if	(!empty($attr5_widths))
	{
		$column_widths = explode(',',$attr5_widths);
		unset($attr5['widths']);
	}
	if	(!empty($attr5_classes))
	{
		$row_classes   = explode(',',$attr5_rowclasses);
		$row_class_idx = 999;
		unset($attr5['rowclasses']);
	}
	if	(!empty($attr5_rowclasses))
	{
		$row_classes   = explode(',',$attr5_rowclasses);
		$row_class_idx = 999;
		unset($attr5['rowclasses']);
	}
	if	(!empty($attr5_columnclasses))
	{
		$column_classes   = explode(',',$attr5_columnclasses);
		unset($attr5['columnclasses']);
	}
?><table class="<?php echo $attr5_class ?>" cellspacing="<?php echo $attr5_space ?>" width="<?php echo $attr5_width ?>" cellpadding="<?php echo $attr5_padding ?>"><?php unset($attr5_width);unset($attr5_space);unset($attr5_padding); ?><?php  ?><?php
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
if	( isset($attr7_width  )) { ?> width="<?php   echo $attr7_width   ?>" <?php }
if	( isset($attr7_style  )) { ?> style="<?php   echo $attr7_style   ?>" <?php }
if	( isset($attr7_class  )) { ?> class="<?php   echo $attr7_class   ?>" <?php }
if	( isset($attr7_colspan)) { ?> colspan="<?php echo $attr7_colspan ?>" <?php }
if	( isset($attr7_rowspan)) { ?> rowspan="<?php echo $attr7_rowspan ?>" <?php }
?>><?php  ?><?php  $attr8_icon='el_date';  $attr8_align='left';  ?><?php
	$attr8_tmp_image_file = $image_dir.'icon_'.$attr8_icon.IMG_ICON_EXT;
	$attr8_size = '16x16';
?><img src="<?php echo $attr8_tmp_image_file ?>" border="0"<?php if(isset($attr8_align)) echo ' align="'.$attr8_align.'"' ?><?php if (isset($attr8_size)) { list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo ' width="'.$attr8_tmp_width.'" height="'.$attr8_tmp_height.'"';} ?>><?php unset($attr8_icon);unset($attr8_align); ?><?php  $attr8_date=$create_date;  ?><?php	
    global $conf;
	$time = $attr8_date;
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
?><?php unset($attr8_date); ?><?php  ?></td><?php  ?><?php  ?><?php
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
if	( isset($attr7_width  )) { ?> width="<?php   echo $attr7_width   ?>" <?php }
if	( isset($attr7_style  )) { ?> style="<?php   echo $attr7_style   ?>" <?php }
if	( isset($attr7_class  )) { ?> class="<?php   echo $attr7_class   ?>" <?php }
if	( isset($attr7_colspan)) { ?> colspan="<?php echo $attr7_colspan ?>" <?php }
if	( isset($attr7_rowspan)) { ?> rowspan="<?php echo $attr7_rowspan ?>" <?php }
?>><?php  ?><?php  $attr8_icon='user';  $attr8_align='left';  ?><?php
	$attr8_tmp_image_file = $image_dir.'icon_'.$attr8_icon.IMG_ICON_EXT;
	$attr8_size = '16x16';
?><img src="<?php echo $attr8_tmp_image_file ?>" border="0"<?php if(isset($attr8_align)) echo ' align="'.$attr8_align.'"' ?><?php if (isset($attr8_size)) { list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo ' width="'.$attr8_tmp_width.'" height="'.$attr8_tmp_height.'"';} ?>><?php unset($attr8_icon);unset($attr8_align); ?><?php  $attr8_user=$create_user;  ?><?php
		if	( is_object($attr8_user) )
			$user = $attr8_user;
		else
			$user = $$attr8_user;
		if	( empty($user->name) )
			$user->name = lang('GLOBAL_UNKNOWN');
		if	( empty($user->fullname) )
			$user->fullname = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
		if	( !empty($user->mail) && $conf['security']['user']['show_mail'] )
			echo '<a href="mailto:'.$user->mail.'" title="'.$user->fullname.'">'.$user->name.'</a>';
		else
			echo '<span title="'.$user->fullname.'">'.$user->name.'</span>';
?><?php unset($attr8_user); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?></table><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?><?php
	$attr3_tmp_class='';
	$attr3_last_class = $attr3_tmp_class;
	echo Html::open_tag('tr',array('class'=>$attr3_tmp_class));
?><?php  ?><?php  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php  ?><?php  $attr5_class='text';  $attr5_text='global_lastchange';  $attr5_escape=true;  ?><?php
	if	( isset($attr5_prefix)&& isset($attr5_key))
		$attr5_key = $attr5_prefix.$attr5_key;
	if	( isset($attr5_suffix)&& isset($attr5_key))
		$attr5_key = $attr5_key.$attr5_suffix;
	if(empty($attr5_title))
			$attr5_title = '';
	if	(empty($attr5_type))
		$tmp_tag = 'span';
	else
		switch( $attr5_type )
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
			case 'preformatted';
				$tmp_tag = 'pre';
				break;
			case 'code';
				$tmp_tag = 'code';
				break;
			default:
				$tmp_tag = 'span';
		}
?><<?php echo $tmp_tag ?> class="<?php echo $attr5_class ?>" title="<?php echo $attr5_title ?>"><?php
	$attr5_title = '';
	if	( $attr5_escape )
		$langF = 'langHtml';
	else
		$langF = 'lang';
	if (!empty($attr5_array))
	{
		$tmpArray = $$attr5_array;
		if (!empty($attr5_var))
			$tmp_text = $tmpArray[$attr5_var];
		else
			$tmp_text = $langF($tmpArray[$attr5_text]);
	}
	elseif (!empty($attr5_text))
		$tmp_text = $langF($attr5_text);
	elseif (!empty($attr5_textvar))
		$tmp_text = $langF($$attr5_textvar);
	elseif (!empty($attr5_key))
		$tmp_text = $langF($attr5_key);
	elseif (!empty($attr5_var))
		$tmp_text = isset($$attr5_var)?$$attr5_var:'?unset:'.$attr5_var.'?';	
	elseif (!empty($attr5_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr5_raw);
	elseif (!empty($attr5_value))
		$tmp_text = $attr5_value;
	else
	  $tmp_text = '&nbsp;';
	if	( !empty($attr5_maxlength) && intval($attr5_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr5_maxlength) );
	if	(isset($attr5_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr5_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
	echo $tmp_text;
	unset($tmp_text);
?></<?php echo $tmp_tag ?>><?php unset($attr5_class);unset($attr5_text);unset($attr5_escape); ?><?php  ?></td><?php  ?><?php  ?><?php
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
if	( isset($attr4_width  )) { ?> width="<?php   echo $attr4_width   ?>" <?php }
if	( isset($attr4_style  )) { ?> style="<?php   echo $attr4_style   ?>" <?php }
if	( isset($attr4_class  )) { ?> class="<?php   echo $attr4_class   ?>" <?php }
if	( isset($attr4_colspan)) { ?> colspan="<?php echo $attr4_colspan ?>" <?php }
if	( isset($attr4_rowspan)) { ?> rowspan="<?php echo $attr4_rowspan ?>" <?php }
?>><?php  ?><?php  $attr5_width='100%';  $attr5_space='0px';  $attr5_padding='0px';  ?><?php
	$coloumn_widths=array();
	$row_classes   = array('');
	$column_classes= array('');
	if(empty($attr5_class))
		$attr5_class='';
	if	(!empty($attr5_widths))
	{
		$column_widths = explode(',',$attr5_widths);
		unset($attr5['widths']);
	}
	if	(!empty($attr5_classes))
	{
		$row_classes   = explode(',',$attr5_rowclasses);
		$row_class_idx = 999;
		unset($attr5['rowclasses']);
	}
	if	(!empty($attr5_rowclasses))
	{
		$row_classes   = explode(',',$attr5_rowclasses);
		$row_class_idx = 999;
		unset($attr5['rowclasses']);
	}
	if	(!empty($attr5_columnclasses))
	{
		$column_classes   = explode(',',$attr5_columnclasses);
		unset($attr5['columnclasses']);
	}
?><table class="<?php echo $attr5_class ?>" cellspacing="<?php echo $attr5_space ?>" width="<?php echo $attr5_width ?>" cellpadding="<?php echo $attr5_padding ?>"><?php unset($attr5_width);unset($attr5_space);unset($attr5_padding); ?><?php  ?><?php
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
if	( isset($attr7_width  )) { ?> width="<?php   echo $attr7_width   ?>" <?php }
if	( isset($attr7_style  )) { ?> style="<?php   echo $attr7_style   ?>" <?php }
if	( isset($attr7_class  )) { ?> class="<?php   echo $attr7_class   ?>" <?php }
if	( isset($attr7_colspan)) { ?> colspan="<?php echo $attr7_colspan ?>" <?php }
if	( isset($attr7_rowspan)) { ?> rowspan="<?php echo $attr7_rowspan ?>" <?php }
?>><?php  ?><?php  $attr8_icon='el_date';  $attr8_align='left';  ?><?php
	$attr8_tmp_image_file = $image_dir.'icon_'.$attr8_icon.IMG_ICON_EXT;
	$attr8_size = '16x16';
?><img src="<?php echo $attr8_tmp_image_file ?>" border="0"<?php if(isset($attr8_align)) echo ' align="'.$attr8_align.'"' ?><?php if (isset($attr8_size)) { list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo ' width="'.$attr8_tmp_width.'" height="'.$attr8_tmp_height.'"';} ?>><?php unset($attr8_icon);unset($attr8_align); ?><?php  $attr8_date=$lastchange_date;  ?><?php	
    global $conf;
	$time = $attr8_date;
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
?><?php unset($attr8_date); ?><?php  ?></td><?php  ?><?php  ?><?php
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
if	( isset($attr7_width  )) { ?> width="<?php   echo $attr7_width   ?>" <?php }
if	( isset($attr7_style  )) { ?> style="<?php   echo $attr7_style   ?>" <?php }
if	( isset($attr7_class  )) { ?> class="<?php   echo $attr7_class   ?>" <?php }
if	( isset($attr7_colspan)) { ?> colspan="<?php echo $attr7_colspan ?>" <?php }
if	( isset($attr7_rowspan)) { ?> rowspan="<?php echo $attr7_rowspan ?>" <?php }
?>><?php  ?><?php  $attr8_icon='user';  $attr8_align='left';  ?><?php
	$attr8_tmp_image_file = $image_dir.'icon_'.$attr8_icon.IMG_ICON_EXT;
	$attr8_size = '16x16';
?><img src="<?php echo $attr8_tmp_image_file ?>" border="0"<?php if(isset($attr8_align)) echo ' align="'.$attr8_align.'"' ?><?php if (isset($attr8_size)) { list($attr8_tmp_width,$attr8_tmp_height)=explode('x',$attr8_size);echo ' width="'.$attr8_tmp_width.'" height="'.$attr8_tmp_height.'"';} ?>><?php unset($attr8_icon);unset($attr8_align); ?><?php  $attr8_user=$lastchange_user;  ?><?php
		if	( is_object($attr8_user) )
			$user = $attr8_user;
		else
			$user = $$attr8_user;
		if	( empty($user->name) )
			$user->name = lang('GLOBAL_UNKNOWN');
		if	( empty($user->fullname) )
			$user->fullname = lang('GLOBAL_NO_DESCRIPTION_AVAILABLE');
		if	( !empty($user->mail) && $conf['security']['user']['show_mail'] )
			echo '<a href="mailto:'.$user->mail.'" title="'.$user->fullname.'">'.$user->name.'</a>';
		else
			echo '<span title="'.$user->fullname.'">'.$user->name.'</span>';
?><?php unset($attr8_user); ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?></table><?php  ?><?php  ?></td><?php  ?><?php  ?></tr><?php  ?><?php  ?>      </table>
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