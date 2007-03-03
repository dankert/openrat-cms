<?php $attr = array('class'=>'main','title'=>'var') ?><?php $attr_class='main' ?><?php $attr_title='var' ?><?php header('Content-Type: text/html; charset='.lang('CHARSET'))
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<!-- $Id$ -->
<head>
  <title><?php echo $attr_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo lang('CHARSET') ?>" />
  <meta name="MSSmartTagsPreventParsing" content="true" />
  <meta name="robots" content="noindex,nofollow" />
  <link rel="stylesheet" type="text/css" href="./themes/default/css/default.css" />
<?php if($stylesheet!='default') { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $stylesheet ?>" />
<?php } ?>
</head>

<body class="<?php echo $attr_class ?>">

<?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_title) ?><?php $attr = array('width'=>'93%','rowclasses'=>'odd,even','columnclasses'=>'1,2,3') ?><?php $attr_width='93%' ?><?php $attr_rowclasses='odd,even' ?><?php $attr_columnclasses='1,2,3' ?><?php
	$coloumn_widths=array();
	if	(!empty($attr_widths))
	{
		$column_widths = explode(',',$attr_widths);
		unset($attr['widths']);
	}
	if	(!empty($attr_rowclasses))
	{
		$row_classes   = explode(',',$attr_rowclasses);
		$row_class_idx = 999;
		unset($attr['rowclasses']);
	}
	if	(!empty($attr_columnclasses))
	{
		$column_classes = explode(',',$attr_columnclasses);
		unset($attr['columnclasses']);
	}
		global $image_dir;
		echo '<br/><br/><br/><center>';
		echo '<table class="main" cellspacing="0" cellpadding="4" width="'.$attr_width.'">';
		echo '<tr><td class="menu">';
		if	( !empty($attr_icon) )
			echo '<img src="'.$image_dir.'icon_'.$attr_icon.IMG_ICON_EXT.'" align="left" border="0">';
		if	( !is_array($path) )
			$path = array();
		foreach( $path as $pathElement)
		{
			extract($pathElement);
			echo '<a href="'.$url.'" class="path">'.lang($name).'</a>';
			echo '&nbsp;&raquo;&nbsp;';
		}
		echo '<span class="title">'.lang($windowTitle).'</span>';
		?>
		</td><td class="menu" style="align:right;">
    <?php if (isset($windowIcons)) foreach( $windowIcons as $icon )
          {
          	?><a href="<?php echo $icon['url'] ?>" title="<?php echo 'ICON_'.lang($menu['type'].'_DESC') ?>"><image border="0" src="<?php echo $image_dir.$icon['type'].IMG_ICON_EXT ?>"></a>&nbsp;<?php
          }
     ?>
    </td>
  </tr>
  <tr><td class="subaction">
    <?php foreach( $windowMenu as $menu )
          {
          	?><a href="<?php echo Html::url($actionName,$menu['subaction'],$this->getRequestId() ) ?>" title="<?php echo lang($menu['text'].'_DESC') ?>" class="menu<?php if($this->subActionName==$menu['subaction']) echo '_active' ?>"><?php echo lang($menu['text']) ?></a>&nbsp;&nbsp;&nbsp;<?php
          }
          	if ($conf['help']['enabled'] )
          	{
             ?><a href="<?php echo $conf['help']['url'].$actionName.'/'.$subActionName.$conf['help']['suffix'] ?> " target="_new" title="<?php echo lang('GLOBAL_HELP') ?>" class="menu">?</a><?php
          	}
          	?></td>
  </tr>

<?php if (isset($notices) && count($notices)>0 )
      { ?>
      	
  <tr>
    <td><table>
    
  <?php foreach( $notices as $notice ) { ?>
    
    <td><img src="<?php echo $image_dir.'notice_'.$notice['status'].IMG_ICON_EXT ?>" style="padding:10px" /></td>
    <td class="f1"><?php if ($notice['name']!='') { ?><img src="<?php echo $image_dir.'icon_'.$notice['type'].IMG_ICON_EXT ?>" align="left" /><?php echo $notice['name'] ?>: <?php } ?><?php if ($notice['status']=='error') { ?><strong><?php } ?><?php echo $notice['text'] ?><?php if ($notice['status']=='error') { ?></strong><?php } ?></td>
  </tr>
  <?php } ?>
  
    </table></td>
  </tr>

<?php } ?>



  <tr>
    <td>
      <table class="n" cellspacing="0" width="100%" cellpadding="4"><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_rowclasses) ?><?php unset($attr_columnclasses) ?><?php $attr = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr_class))
		$attr_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr_class ?>"><?php unset($attr) ?><?php $attr = array('class'=>'help','colspan'=>'7') ?><?php $attr_class='help' ?><?php $attr_colspan='7' ?><?php
//	if (empty($attr_class))
//		$attr['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr_class))
		$attr['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('class'=>'text','text'=>'GLOBAL_FOLDER_DESC') ?><?php $attr_class='text' ?><?php $attr_text='GLOBAL_FOLDER_DESC' ?><?php
	if(empty($attr_title))
		if (!empty($attr_key))
			$attr_title = lang($attr_key).'_HELP';
		else
			$attr_title = '';

?><span class="<?php echo $attr_class ?>" title="<?php echo $attr_title ?>"><?php
	$attr_title = '';
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			$tmp_text = $tmpArray[$attr_var];
		else
			$tmp_text = lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		if	( isset($$attr_text))
			$tmp_text = lang($$attr_text);
		else
			$tmp_text = lang($attr_text);
	elseif (!empty($attr_textvar))
		$tmp_text = lang($$attr_textvar);
	elseif (!empty($attr_key))
		$tmp_text = lang($attr_key);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	elseif (!empty($attr_value))
		$tmp_text = $attr_value;
	else
	{ Html::debug($attr);echo 'text error';
	}
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_text) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr_class))
		$attr_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr_class ?>"><?php unset($attr) ?><?php $attr = array('class'=>'help') ?><?php $attr_class='help' ?><?php
//	if (empty($attr_class))
//		$attr['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr_class))
		$attr['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_class) ?><?php $attr = array('title'=>'FOLDER_ORDERBYTYPE','target'=>'_self','url'=>$orderbytype_url,'class'=>'') ?><?php $attr_title='FOLDER_ORDERBYTYPE' ?><?php $attr_target='_self' ?><?php $attr_url=$orderbytype_url ?><?php $attr_class='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo $attr_title ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php $attr = array('class'=>'text','text'=>'GLOBAL_TYPE') ?><?php $attr_class='text' ?><?php $attr_text='GLOBAL_TYPE' ?><?php
	if(empty($attr_title))
		if (!empty($attr_key))
			$attr_title = lang($attr_key).'_HELP';
		else
			$attr_title = '';

?><span class="<?php echo $attr_class ?>" title="<?php echo $attr_title ?>"><?php
	$attr_title = '';
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			$tmp_text = $tmpArray[$attr_var];
		else
			$tmp_text = lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		if	( isset($$attr_text))
			$tmp_text = lang($$attr_text);
		else
			$tmp_text = lang($attr_text);
	elseif (!empty($attr_textvar))
		$tmp_text = lang($$attr_textvar);
	elseif (!empty($attr_key))
		$tmp_text = lang($attr_key);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	elseif (!empty($attr_value))
		$tmp_text = $attr_value;
	else
	{ Html::debug($attr);echo 'text error';
	}
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_text) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array('class'=>'text','raw'=>'_/_') ?><?php $attr_class='text' ?><?php $attr_raw='_/_' ?><?php
	if(empty($attr_title))
		if (!empty($attr_key))
			$attr_title = lang($attr_key).'_HELP';
		else
			$attr_title = '';

?><span class="<?php echo $attr_class ?>" title="<?php echo $attr_title ?>"><?php
	$attr_title = '';
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			$tmp_text = $tmpArray[$attr_var];
		else
			$tmp_text = lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		if	( isset($$attr_text))
			$tmp_text = lang($$attr_text);
		else
			$tmp_text = lang($attr_text);
	elseif (!empty($attr_textvar))
		$tmp_text = lang($$attr_textvar);
	elseif (!empty($attr_key))
		$tmp_text = lang($attr_key);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	elseif (!empty($attr_value))
		$tmp_text = $attr_value;
	else
	{ Html::debug($attr);echo 'text error';
	}
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_raw) ?><?php $attr = array('title'=>'FOLDER_ORDERBYNAME','target'=>'_self','url'=>$orderbyname_url,'class'=>'') ?><?php $attr_title='FOLDER_ORDERBYNAME' ?><?php $attr_target='_self' ?><?php $attr_url=$orderbyname_url ?><?php $attr_class='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo $attr_title ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php $attr = array('class'=>'text','text'=>'GLOBAL_NAME') ?><?php $attr_class='text' ?><?php $attr_text='GLOBAL_NAME' ?><?php
	if(empty($attr_title))
		if (!empty($attr_key))
			$attr_title = lang($attr_key).'_HELP';
		else
			$attr_title = '';

?><span class="<?php echo $attr_class ?>" title="<?php echo $attr_title ?>"><?php
	$attr_title = '';
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			$tmp_text = $tmpArray[$attr_var];
		else
			$tmp_text = lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		if	( isset($$attr_text))
			$tmp_text = lang($$attr_text);
		else
			$tmp_text = lang($attr_text);
	elseif (!empty($attr_textvar))
		$tmp_text = lang($$attr_textvar);
	elseif (!empty($attr_key))
		$tmp_text = lang($attr_key);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	elseif (!empty($attr_value))
		$tmp_text = $attr_value;
	else
	{ Html::debug($attr);echo 'text error';
	}
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_text) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('class'=>'help') ?><?php $attr_class='help' ?><?php
//	if (empty($attr_class))
//		$attr['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr_class))
		$attr['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_class) ?><?php $attr = array('title'=>'FOLDER_ORDERBYLASTCHANGE','target'=>'_self','url'=>$orderbylastchange_url,'class'=>'') ?><?php $attr_title='FOLDER_ORDERBYLASTCHANGE' ?><?php $attr_target='_self' ?><?php $attr_url=$orderbylastchange_url ?><?php $attr_class='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo $attr_title ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php $attr = array('class'=>'text','text'=>'GLOBAL_LASTCHANGE') ?><?php $attr_class='text' ?><?php $attr_text='GLOBAL_LASTCHANGE' ?><?php
	if(empty($attr_title))
		if (!empty($attr_key))
			$attr_title = lang($attr_key).'_HELP';
		else
			$attr_title = '';

?><span class="<?php echo $attr_class ?>" title="<?php echo $attr_title ?>"><?php
	$attr_title = '';
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			$tmp_text = $tmpArray[$attr_var];
		else
			$tmp_text = lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		if	( isset($$attr_text))
			$tmp_text = lang($$attr_text);
		else
			$tmp_text = lang($attr_text);
	elseif (!empty($attr_textvar))
		$tmp_text = lang($$attr_textvar);
	elseif (!empty($attr_key))
		$tmp_text = lang($attr_key);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	elseif (!empty($attr_value))
		$tmp_text = $attr_value;
	else
	{ Html::debug($attr);echo 'text error';
	}
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_text) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('class'=>'help','colspan'=>'4') ?><?php $attr_class='help' ?><?php $attr_colspan='4' ?><?php
//	if (empty($attr_class))
//		$attr['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr_class))
		$attr['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'FOLDER_FLIP','target'=>'_self','url'=>$flip_url,'class'=>'') ?><?php $attr_title='FOLDER_FLIP' ?><?php $attr_target='_self' ?><?php $attr_url=$flip_url ?><?php $attr_class='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo $attr_title ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php $attr = array('class'=>'text','text'=>'FOLDER_ORDER') ?><?php $attr_class='text' ?><?php $attr_text='FOLDER_ORDER' ?><?php
	if(empty($attr_title))
		if (!empty($attr_key))
			$attr_title = lang($attr_key).'_HELP';
		else
			$attr_title = '';

?><span class="<?php echo $attr_class ?>" title="<?php echo $attr_title ?>"><?php
	$attr_title = '';
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			$tmp_text = $tmpArray[$attr_var];
		else
			$tmp_text = lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		if	( isset($$attr_text))
			$tmp_text = lang($$attr_text);
		else
			$tmp_text = lang($attr_text);
	elseif (!empty($attr_textvar))
		$tmp_text = lang($$attr_textvar);
	elseif (!empty($attr_key))
		$tmp_text = lang($attr_key);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	elseif (!empty($attr_value))
		$tmp_text = $attr_value;
	else
	{ Html::debug($attr);echo 'text error';
	}
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_text) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array('list'=>'object','extract'=>'1','key'=>'list_key','value'=>'list_value') ?><?php $attr_list='object' ?><?php $attr_extract='1' ?><?php $attr_key='list_key' ?><?php $attr_value='list_value' ?><?php
	$list_tmp_key   = $attr_key;
	$list_tmp_value = $attr_value;
	$list_extract   = ($attr_extract==true);

	
	foreach( $$attr_list as $$list_tmp_key => $$list_tmp_value )
	{
		if	( $list_extract )
		{
			if	( !is_array($$list_tmp_value) )
			{
				print_r($$list_tmp_value);
				die( 'not an array at key: '.$$list_tmp_key );
			}
			extract($$list_tmp_value);
		}
?><?php unset($attr) ?><?php unset($attr_list) ?><?php unset($attr_extract) ?><?php unset($attr_key) ?><?php unset($attr_value) ?><?php $attr = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr_class))
		$attr_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr_class ?>"><?php unset($attr) ?><?php $attr = array('width'=>'40%','class'=>'fx') ?><?php $attr_width='40%' ?><?php $attr_class='fx' ?><?php
//	if (empty($attr_class))
//		$attr['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr_class))
		$attr['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_class) ?><?php $attr = array('align'=>'left','type'=>$icon) ?><?php $attr_align='left' ?><?php $attr_type=$icon ?><?php
if (isset($attr_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_url)) {
?><img src="<?php echo $attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_file)) {
?><img src="<?php echo $image_dir.$attr_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?><?php unset($attr) ?><?php unset($attr_align) ?><?php unset($attr_type) ?><?php $attr = array('class'=>'text','var'=>'name') ?><?php $attr_class='text' ?><?php $attr_var='name' ?><?php
	if(empty($attr_title))
		if (!empty($attr_key))
			$attr_title = lang($attr_key).'_HELP';
		else
			$attr_title = '';

?><span class="<?php echo $attr_class ?>" title="<?php echo $attr_title ?>"><?php
	$attr_title = '';
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			$tmp_text = $tmpArray[$attr_var];
		else
			$tmp_text = lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		if	( isset($$attr_text))
			$tmp_text = lang($$attr_text);
		else
			$tmp_text = lang($attr_text);
	elseif (!empty($attr_textvar))
		$tmp_text = lang($$attr_textvar);
	elseif (!empty($attr_key))
		$tmp_text = lang($attr_key);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	elseif (!empty($attr_value))
		$tmp_text = $attr_value;
	else
	{ Html::debug($attr);echo 'text error';
	}
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'18%','class'=>'fx') ?><?php $attr_width='18%' ?><?php $attr_class='fx' ?><?php
//	if (empty($attr_class))
//		$attr['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr_class))
		$attr['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_class) ?><?php $attr = array('class'=>'text','var'=>'date') ?><?php $attr_class='text' ?><?php $attr_var='date' ?><?php
	if(empty($attr_title))
		if (!empty($attr_key))
			$attr_title = lang($attr_key).'_HELP';
		else
			$attr_title = '';

?><span class="<?php echo $attr_class ?>" title="<?php echo $attr_title ?>"><?php
	$attr_title = '';
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			$tmp_text = $tmpArray[$attr_var];
		else
			$tmp_text = lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		if	( isset($$attr_text))
			$tmp_text = lang($$attr_text);
		else
			$tmp_text = lang($attr_text);
	elseif (!empty($attr_textvar))
		$tmp_text = lang($$attr_textvar);
	elseif (!empty($attr_key))
		$tmp_text = lang($attr_key);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	elseif (!empty($attr_value))
		$tmp_text = $attr_value;
	else
	{ Html::debug($attr);echo 'text error';
	}
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'3%','class'=>'fx') ?><?php $attr_width='3%' ?><?php $attr_class='fx' ?><?php
//	if (empty($attr_class))
//		$attr['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr_class))
		$attr['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_class) ?><?php $attr = array('present'=>'upurl') ?><?php $attr_present='upurl' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr);
	
	if	( isset($attr_true) )
	{
		if	(gettype($attr_true) === '' && gettype($attr_true) === '1')
			$exec = $$attr_true == true;
		else
			$exec = $attr_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr_false) )
	{
		if	(gettype($attr_false) === '' && gettype($attr_false) === '1')
			$exec = $$attr_false == false;
		else
			$exec = $attr_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr_contains) )
		$exec = in_array($$attr_var,explode(',',$attr_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr_var) )
		$exec = $$attr_var == $attr_value;

	// Vergleich auf leer
	elseif	( isset($attr_empty) )
	{
		if	( !isset($$attr_empty) )
			$exec = empty($attr_empty);
		elseif	( is_array($$attr_empty) )
			$exec = (count($$attr_empty)==0);
		elseif	( is_bool($$attr_empty) )
			$exec = true;
		else
			$exec = empty( $$attr_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr_present) )
	{
		if	( !isset($$attr_present) )
			$exec = false;
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = $$attr_present;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	else
	{
		Html::debug( $attr );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr_not) )
		$exec = !$exec;

	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_not);
	unset($attr_value);
	unset($attr_var);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_present) ?><?php $attr = array('title'=>'GLOBAL_UP','target'=>'_self','url'=>$upurl,'class'=>'') ?><?php $attr_title='GLOBAL_UP' ?><?php $attr_target='_self' ?><?php $attr_url=$upurl ?><?php $attr_class='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo $attr_title ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php $attr = array('var'=>'bild','value'=>'arrow_up') ?><?php $attr_var='bild' ?><?php $attr_value='arrow_up' ?><?php $$attr_var = $attr_value ?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php $attr = array('file'=>$bild,'align'=>'left') ?><?php $attr_file=$bild ?><?php $attr_align='left' ?><?php
if (isset($attr_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_url)) {
?><img src="<?php echo $attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_file)) {
?><img src="<?php echo $image_dir.$attr_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?><?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_align) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array() ?><?php
	}
	
?><?php unset($attr) ?><?php $attr = array('empty'=>'upurl') ?><?php $attr_empty='upurl' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr);
	
	if	( isset($attr_true) )
	{
		if	(gettype($attr_true) === '' && gettype($attr_true) === '1')
			$exec = $$attr_true == true;
		else
			$exec = $attr_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr_false) )
	{
		if	(gettype($attr_false) === '' && gettype($attr_false) === '1')
			$exec = $$attr_false == false;
		else
			$exec = $attr_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr_contains) )
		$exec = in_array($$attr_var,explode(',',$attr_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr_var) )
		$exec = $$attr_var == $attr_value;

	// Vergleich auf leer
	elseif	( isset($attr_empty) )
	{
		if	( !isset($$attr_empty) )
			$exec = empty($attr_empty);
		elseif	( is_array($$attr_empty) )
			$exec = (count($$attr_empty)==0);
		elseif	( is_bool($$attr_empty) )
			$exec = true;
		else
			$exec = empty( $$attr_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr_present) )
	{
		if	( !isset($$attr_present) )
			$exec = false;
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = $$attr_present;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	else
	{
		Html::debug( $attr );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr_not) )
		$exec = !$exec;

	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_not);
	unset($attr_value);
	unset($attr_var);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_empty) ?><?php $attr = array('class'=>'text','raw'=>'_') ?><?php $attr_class='text' ?><?php $attr_raw='_' ?><?php
	if(empty($attr_title))
		if (!empty($attr_key))
			$attr_title = lang($attr_key).'_HELP';
		else
			$attr_title = '';

?><span class="<?php echo $attr_class ?>" title="<?php echo $attr_title ?>"><?php
	$attr_title = '';
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			$tmp_text = $tmpArray[$attr_var];
		else
			$tmp_text = lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		if	( isset($$attr_text))
			$tmp_text = lang($$attr_text);
		else
			$tmp_text = lang($attr_text);
	elseif (!empty($attr_textvar))
		$tmp_text = lang($$attr_textvar);
	elseif (!empty($attr_key))
		$tmp_text = lang($attr_key);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	elseif (!empty($attr_value))
		$tmp_text = $attr_value;
	else
	{ Html::debug($attr);echo 'text error';
	}
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_raw) ?><?php $attr = array() ?><?php
	}
	
?><?php unset($attr) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'3%','class'=>'fx') ?><?php $attr_width='3%' ?><?php $attr_class='fx' ?><?php
//	if (empty($attr_class))
//		$attr['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr_class))
		$attr['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_class) ?><?php $attr = array('present'=>'topurl') ?><?php $attr_present='topurl' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr);
	
	if	( isset($attr_true) )
	{
		if	(gettype($attr_true) === '' && gettype($attr_true) === '1')
			$exec = $$attr_true == true;
		else
			$exec = $attr_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr_false) )
	{
		if	(gettype($attr_false) === '' && gettype($attr_false) === '1')
			$exec = $$attr_false == false;
		else
			$exec = $attr_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr_contains) )
		$exec = in_array($$attr_var,explode(',',$attr_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr_var) )
		$exec = $$attr_var == $attr_value;

	// Vergleich auf leer
	elseif	( isset($attr_empty) )
	{
		if	( !isset($$attr_empty) )
			$exec = empty($attr_empty);
		elseif	( is_array($$attr_empty) )
			$exec = (count($$attr_empty)==0);
		elseif	( is_bool($$attr_empty) )
			$exec = true;
		else
			$exec = empty( $$attr_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr_present) )
	{
		if	( !isset($$attr_present) )
			$exec = false;
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = $$attr_present;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	else
	{
		Html::debug( $attr );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr_not) )
		$exec = !$exec;

	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_not);
	unset($attr_value);
	unset($attr_var);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_present) ?><?php $attr = array('title'=>'GLOBAL_TOP','target'=>'_self','url'=>$topurl,'class'=>'') ?><?php $attr_title='GLOBAL_TOP' ?><?php $attr_target='_self' ?><?php $attr_url=$topurl ?><?php $attr_class='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo $attr_title ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php $attr = array('var'=>'bild','value'=>'arrow_top') ?><?php $attr_var='bild' ?><?php $attr_value='arrow_top' ?><?php $$attr_var = $attr_value ?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php $attr = array('file'=>$bild,'align'=>'left') ?><?php $attr_file=$bild ?><?php $attr_align='left' ?><?php
if (isset($attr_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_url)) {
?><img src="<?php echo $attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_file)) {
?><img src="<?php echo $image_dir.$attr_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?><?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_align) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array() ?><?php
	}
	
?><?php unset($attr) ?><?php $attr = array('empty'=>'topurl') ?><?php $attr_empty='topurl' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr);
	
	if	( isset($attr_true) )
	{
		if	(gettype($attr_true) === '' && gettype($attr_true) === '1')
			$exec = $$attr_true == true;
		else
			$exec = $attr_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr_false) )
	{
		if	(gettype($attr_false) === '' && gettype($attr_false) === '1')
			$exec = $$attr_false == false;
		else
			$exec = $attr_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr_contains) )
		$exec = in_array($$attr_var,explode(',',$attr_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr_var) )
		$exec = $$attr_var == $attr_value;

	// Vergleich auf leer
	elseif	( isset($attr_empty) )
	{
		if	( !isset($$attr_empty) )
			$exec = empty($attr_empty);
		elseif	( is_array($$attr_empty) )
			$exec = (count($$attr_empty)==0);
		elseif	( is_bool($$attr_empty) )
			$exec = true;
		else
			$exec = empty( $$attr_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr_present) )
	{
		if	( !isset($$attr_present) )
			$exec = false;
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = $$attr_present;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	else
	{
		Html::debug( $attr );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr_not) )
		$exec = !$exec;

	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_not);
	unset($attr_value);
	unset($attr_var);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_empty) ?><?php $attr = array('class'=>'text','raw'=>'_') ?><?php $attr_class='text' ?><?php $attr_raw='_' ?><?php
	if(empty($attr_title))
		if (!empty($attr_key))
			$attr_title = lang($attr_key).'_HELP';
		else
			$attr_title = '';

?><span class="<?php echo $attr_class ?>" title="<?php echo $attr_title ?>"><?php
	$attr_title = '';
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			$tmp_text = $tmpArray[$attr_var];
		else
			$tmp_text = lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		if	( isset($$attr_text))
			$tmp_text = lang($$attr_text);
		else
			$tmp_text = lang($attr_text);
	elseif (!empty($attr_textvar))
		$tmp_text = lang($$attr_textvar);
	elseif (!empty($attr_key))
		$tmp_text = lang($attr_key);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	elseif (!empty($attr_value))
		$tmp_text = $attr_value;
	else
	{ Html::debug($attr);echo 'text error';
	}
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_raw) ?><?php $attr = array() ?><?php
	}
	
?><?php unset($attr) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'3%','class'=>'fx') ?><?php $attr_width='3%' ?><?php $attr_class='fx' ?><?php
//	if (empty($attr_class))
//		$attr['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr_class))
		$attr['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_class) ?><?php $attr = array('present'=>'bottomurl') ?><?php $attr_present='bottomurl' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr);
	
	if	( isset($attr_true) )
	{
		if	(gettype($attr_true) === '' && gettype($attr_true) === '1')
			$exec = $$attr_true == true;
		else
			$exec = $attr_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr_false) )
	{
		if	(gettype($attr_false) === '' && gettype($attr_false) === '1')
			$exec = $$attr_false == false;
		else
			$exec = $attr_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr_contains) )
		$exec = in_array($$attr_var,explode(',',$attr_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr_var) )
		$exec = $$attr_var == $attr_value;

	// Vergleich auf leer
	elseif	( isset($attr_empty) )
	{
		if	( !isset($$attr_empty) )
			$exec = empty($attr_empty);
		elseif	( is_array($$attr_empty) )
			$exec = (count($$attr_empty)==0);
		elseif	( is_bool($$attr_empty) )
			$exec = true;
		else
			$exec = empty( $$attr_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr_present) )
	{
		if	( !isset($$attr_present) )
			$exec = false;
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = $$attr_present;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	else
	{
		Html::debug( $attr );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr_not) )
		$exec = !$exec;

	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_not);
	unset($attr_value);
	unset($attr_var);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_present) ?><?php $attr = array('title'=>'GLOBAL_BOTTOM','target'=>'_self','url'=>$bottomurl,'class'=>'') ?><?php $attr_title='GLOBAL_BOTTOM' ?><?php $attr_target='_self' ?><?php $attr_url=$bottomurl ?><?php $attr_class='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo $attr_title ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php $attr = array('var'=>'bild','value'=>'arrow_bottom') ?><?php $attr_var='bild' ?><?php $attr_value='arrow_bottom' ?><?php $$attr_var = $attr_value ?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php $attr = array('file'=>$bild,'align'=>'left') ?><?php $attr_file=$bild ?><?php $attr_align='left' ?><?php
if (isset($attr_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_url)) {
?><img src="<?php echo $attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_file)) {
?><img src="<?php echo $image_dir.$attr_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?><?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_align) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array() ?><?php
	}
	
?><?php unset($attr) ?><?php $attr = array('empty'=>'bottomurl') ?><?php $attr_empty='bottomurl' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr);
	
	if	( isset($attr_true) )
	{
		if	(gettype($attr_true) === '' && gettype($attr_true) === '1')
			$exec = $$attr_true == true;
		else
			$exec = $attr_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr_false) )
	{
		if	(gettype($attr_false) === '' && gettype($attr_false) === '1')
			$exec = $$attr_false == false;
		else
			$exec = $attr_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr_contains) )
		$exec = in_array($$attr_var,explode(',',$attr_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr_var) )
		$exec = $$attr_var == $attr_value;

	// Vergleich auf leer
	elseif	( isset($attr_empty) )
	{
		if	( !isset($$attr_empty) )
			$exec = empty($attr_empty);
		elseif	( is_array($$attr_empty) )
			$exec = (count($$attr_empty)==0);
		elseif	( is_bool($$attr_empty) )
			$exec = true;
		else
			$exec = empty( $$attr_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr_present) )
	{
		if	( !isset($$attr_present) )
			$exec = false;
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = $$attr_present;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	else
	{
		Html::debug( $attr );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr_not) )
		$exec = !$exec;

	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_not);
	unset($attr_value);
	unset($attr_var);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_empty) ?><?php $attr = array('class'=>'text','raw'=>'_') ?><?php $attr_class='text' ?><?php $attr_raw='_' ?><?php
	if(empty($attr_title))
		if (!empty($attr_key))
			$attr_title = lang($attr_key).'_HELP';
		else
			$attr_title = '';

?><span class="<?php echo $attr_class ?>" title="<?php echo $attr_title ?>"><?php
	$attr_title = '';
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			$tmp_text = $tmpArray[$attr_var];
		else
			$tmp_text = lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		if	( isset($$attr_text))
			$tmp_text = lang($$attr_text);
		else
			$tmp_text = lang($attr_text);
	elseif (!empty($attr_textvar))
		$tmp_text = lang($$attr_textvar);
	elseif (!empty($attr_key))
		$tmp_text = lang($attr_key);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	elseif (!empty($attr_value))
		$tmp_text = $attr_value;
	else
	{ Html::debug($attr);echo 'text error';
	}
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_raw) ?><?php $attr = array() ?><?php
	}
	
?><?php unset($attr) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'3%','class'=>'fx') ?><?php $attr_width='3%' ?><?php $attr_class='fx' ?><?php
//	if (empty($attr_class))
//		$attr['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr_class))
		$attr['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_class) ?><?php $attr = array('present'=>'downurl') ?><?php $attr_present='downurl' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr);
	
	if	( isset($attr_true) )
	{
		if	(gettype($attr_true) === '' && gettype($attr_true) === '1')
			$exec = $$attr_true == true;
		else
			$exec = $attr_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr_false) )
	{
		if	(gettype($attr_false) === '' && gettype($attr_false) === '1')
			$exec = $$attr_false == false;
		else
			$exec = $attr_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr_contains) )
		$exec = in_array($$attr_var,explode(',',$attr_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr_var) )
		$exec = $$attr_var == $attr_value;

	// Vergleich auf leer
	elseif	( isset($attr_empty) )
	{
		if	( !isset($$attr_empty) )
			$exec = empty($attr_empty);
		elseif	( is_array($$attr_empty) )
			$exec = (count($$attr_empty)==0);
		elseif	( is_bool($$attr_empty) )
			$exec = true;
		else
			$exec = empty( $$attr_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr_present) )
	{
		if	( !isset($$attr_present) )
			$exec = false;
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = $$attr_present;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	else
	{
		Html::debug( $attr );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr_not) )
		$exec = !$exec;

	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_not);
	unset($attr_value);
	unset($attr_var);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_present) ?><?php $attr = array('title'=>'GLOBAL_DOWN','target'=>'_self','url'=>$downurl,'class'=>'') ?><?php $attr_title='GLOBAL_DOWN' ?><?php $attr_target='_self' ?><?php $attr_url=$downurl ?><?php $attr_class='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo $attr_title ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php $attr = array('var'=>'bild','value'=>'arrow_down') ?><?php $attr_var='bild' ?><?php $attr_value='arrow_down' ?><?php $$attr_var = $attr_value ?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php $attr = array('file'=>$bild,'align'=>'left') ?><?php $attr_file=$bild ?><?php $attr_align='left' ?><?php
if (isset($attr_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_url)) {
?><img src="<?php echo $attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_file)) {
?><img src="<?php echo $image_dir.$attr_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?><?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_align) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array() ?><?php
	}
	
?><?php unset($attr) ?><?php $attr = array('empty'=>'downurl') ?><?php $attr_empty='downurl' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr);
	
	if	( isset($attr_true) )
	{
		if	(gettype($attr_true) === '' && gettype($attr_true) === '1')
			$exec = $$attr_true == true;
		else
			$exec = $attr_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr_false) )
	{
		if	(gettype($attr_false) === '' && gettype($attr_false) === '1')
			$exec = $$attr_false == false;
		else
			$exec = $attr_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr_contains) )
		$exec = in_array($$attr_var,explode(',',$attr_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr_var) )
		$exec = $$attr_var == $attr_value;

	// Vergleich auf leer
	elseif	( isset($attr_empty) )
	{
		if	( !isset($$attr_empty) )
			$exec = empty($attr_empty);
		elseif	( is_array($$attr_empty) )
			$exec = (count($$attr_empty)==0);
		elseif	( is_bool($$attr_empty) )
			$exec = true;
		else
			$exec = empty( $$attr_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr_present) )
	{
		if	( !isset($$attr_present) )
			$exec = false;
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = $$attr_present;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	else
	{
		Html::debug( $attr );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr_not) )
		$exec = !$exec;

	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_not);
	unset($attr_value);
	unset($attr_var);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_empty) ?><?php $attr = array('class'=>'text','raw'=>'_') ?><?php $attr_class='text' ?><?php $attr_raw='_' ?><?php
	if(empty($attr_title))
		if (!empty($attr_key))
			$attr_title = lang($attr_key).'_HELP';
		else
			$attr_title = '';

?><span class="<?php echo $attr_class ?>" title="<?php echo $attr_title ?>"><?php
	$attr_title = '';
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			$tmp_text = $tmpArray[$attr_var];
		else
			$tmp_text = lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		if	( isset($$attr_text))
			$tmp_text = lang($$attr_text);
		else
			$tmp_text = lang($attr_text);
	elseif (!empty($attr_textvar))
		$tmp_text = lang($$attr_textvar);
	elseif (!empty($attr_key))
		$tmp_text = lang($attr_key);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	elseif (!empty($attr_value))
		$tmp_text = $attr_value;
	else
	{ Html::debug($attr);echo 'text error';
	}
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_raw) ?><?php $attr = array() ?><?php
	}
	
?><?php unset($attr) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php } ?><?php unset($attr) ?><?php $attr = array() ?>      </table>
	</td>
  </tr>
</table>

</center>

<?php if ($showDuration)
      { ?>
<br/>
<small>&nbsp;
<?php $dur = time()-START_TIME;
      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small>
<?php } ?>
<?php unset($attr) ?><?php $attr = array() ?>
<!-- $Id$ -->

<?php if ($showDuration) { ?>
<br/>
<small>&nbsp;
<?php $dur = time()-START_TIME;
//      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small>
<?php } ?>

</body>
</html><?php unset($attr) ?>