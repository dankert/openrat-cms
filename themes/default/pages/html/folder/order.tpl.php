<?php $attr = array('class'=>'') ?><?php $attr_class='' ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<!-- $Id$ -->
<head>
  <title><?php echo $cms_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="MSSmartTagsPreventParsing" content="true" />
  <meta name="robots" content="noindex,nofollow" />
  <link rel="stylesheet" type="text/css" href="./themes/default/css/default.css" />
<?php if($stylesheet!='default') { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $stylesheet ?>" />
<?php } ?>
</head>

<body<?php echo !empty($$attr_class)?' class="'.$$attr_class.'"':' class="'.$attr_class.'"' ?>>


<?php unset($attr) ?><?php unset($attr_class) ?><?php $attr = array('title'=>'','name'=>'','icon'=>'','widths'=>'','width'=>'85%') ?><?php $attr_title='' ?><?php $attr_name='' ?><?php $attr_icon='' ?><?php $attr_widths='' ?><?php $attr_width='85%' ?><?php
	$coloumn_widths=array();
	if	(!empty($attr_widths))
	{
		$column_widths = explode(',',$attr_widths);
		unset($attr['widths']);
	}
		global $image_dir;
		echo '<br/><br/><br/><center>';
		echo '<table class="main" cellspacing="0" cellpadding="4" width="'.$attr_width.'">';
		echo '<tr><td class="menu">';
		if	( !empty($attr_icon) )
			echo '<img src="'.$image_dir.'icon_'.$attr_icon.IMG_ICON_EXT.'" align="left" border="0">';
		foreach( $path as $pathElement)
		{
			extract($pathElement);
			echo '<a href="'.$url.'" class="path">'.lang($name).'</a>';
			echo '&nbsp;&raquo;&nbsp;';
		}
		echo '<span class="title">'.lang($windowTitle).'</span>';
		?>
    </th>
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
      <table class="n" cellspacing="0" width="100%" cellpadding="4"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_name) ?><?php unset($attr_icon) ?><?php unset($attr_widths) ?><?php unset($attr_width) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'help','colspan'=>'7') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='help' ?><?php $attr_colspan='7' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'GLOBAL_FOLDER_DESC','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='GLOBAL_FOLDER_DESC' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
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
		$tmp_text = lang($attr_text);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'help','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='help' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'FOLDER_ORDERBYTYPE','target'=>'','url'=>'orderbytype_url','class'=>'','action'=>'','subaction'=>'','id'=>'','var1'=>'','value1'=>'') ?><?php $attr_title='FOLDER_ORDERBYTYPE' ?><?php $attr_target='' ?><?php $attr_url='orderbytype_url' ?><?php $attr_class='' ?><?php $attr_action='' ?><?php $attr_subaction='' ?><?php $attr_id='' ?><?php $attr_var1='' ?><?php $attr_value1='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $$attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo hasLang($attr_title)?lang($attr_title):lang($$attr_title) ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php unset($attr_action) ?><?php unset($attr_subaction) ?><?php unset($attr_id) ?><?php unset($attr_var1) ?><?php unset($attr_value1) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'GLOBAL_TYPE','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='GLOBAL_TYPE' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
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
		$tmp_text = lang($attr_text);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>'_/_','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw='_/_' ?><?php $attr_maxlength='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
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
		$tmp_text = lang($attr_text);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array('title'=>'FOLDER_ORDERBYNAME','target'=>'','url'=>'orderbyname_url','class'=>'','action'=>'','subaction'=>'','id'=>'','var1'=>'','value1'=>'') ?><?php $attr_title='FOLDER_ORDERBYNAME' ?><?php $attr_target='' ?><?php $attr_url='orderbyname_url' ?><?php $attr_class='' ?><?php $attr_action='' ?><?php $attr_subaction='' ?><?php $attr_id='' ?><?php $attr_var1='' ?><?php $attr_value1='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $$attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo hasLang($attr_title)?lang($attr_title):lang($$attr_title) ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php unset($attr_action) ?><?php unset($attr_subaction) ?><?php unset($attr_id) ?><?php unset($attr_var1) ?><?php unset($attr_value1) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'GLOBAL_NAME','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='GLOBAL_NAME' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
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
		$tmp_text = lang($attr_text);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'help','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='help' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'FOLDER_ORDERBYLASTCHANGE','target'=>'','url'=>'orderbylastchange_url','class'=>'','action'=>'','subaction'=>'','id'=>'','var1'=>'','value1'=>'') ?><?php $attr_title='FOLDER_ORDERBYLASTCHANGE' ?><?php $attr_target='' ?><?php $attr_url='orderbylastchange_url' ?><?php $attr_class='' ?><?php $attr_action='' ?><?php $attr_subaction='' ?><?php $attr_id='' ?><?php $attr_var1='' ?><?php $attr_value1='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $$attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo hasLang($attr_title)?lang($attr_title):lang($$attr_title) ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php unset($attr_action) ?><?php unset($attr_subaction) ?><?php unset($attr_id) ?><?php unset($attr_var1) ?><?php unset($attr_value1) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'GLOBAL_LASTCHANGE','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='GLOBAL_LASTCHANGE' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
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
		$tmp_text = lang($attr_text);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'help','colspan'=>'4') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='help' ?><?php $attr_colspan='4' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'FOLDER_FLIP','target'=>'','url'=>'flip_url','class'=>'','action'=>'','subaction'=>'','id'=>'','var1'=>'','value1'=>'') ?><?php $attr_title='FOLDER_FLIP' ?><?php $attr_target='' ?><?php $attr_url='flip_url' ?><?php $attr_class='' ?><?php $attr_action='' ?><?php $attr_subaction='' ?><?php $attr_id='' ?><?php $attr_var1='' ?><?php $attr_value1='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $$attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo hasLang($attr_title)?lang($attr_title):lang($$attr_title) ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php unset($attr_action) ?><?php unset($attr_subaction) ?><?php unset($attr_id) ?><?php unset($attr_var1) ?><?php unset($attr_value1) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'FOLDER_ORDER','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='FOLDER_ORDER' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
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
		$tmp_text = lang($attr_text);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array('list'=>'object','extract'=>'true','key'=>'list_key','value'=>'list_value') ?><?php $attr_list='object' ?><?php $attr_extract='true' ?><?php $attr_key='list_key' ?><?php $attr_value='list_value' ?><?php
	$list_tmp_key   = $attr_key;
	$list_tmp_value = $attr_value;
	$list_extract   = ($attr_extract=='true');

	
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
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'40%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='40%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('file'=>'','url'=>'','align'=>'left','type'=>'icon','elementtype'=>'') ?><?php $attr_file='' ?><?php $attr_url='' ?><?php $attr_align='left' ?><?php $attr_type='icon' ?><?php $attr_elementtype='' ?><?php
if (!empty($attr_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$$attr_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$$attr_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($$attr_url)) {
?><img src="<?php echo $$attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_file)) {
?><img src="<?php echo $image_dir.$$attr_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?><?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_url) ?><?php unset($attr_align) ?><?php unset($attr_type) ?><?php unset($attr_elementtype) ?><?php $attr = array('title'=>'','class'=>'','var'=>'name','text'=>'','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='name' ?><?php $attr_text='' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
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
		$tmp_text = lang($attr_text);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'18%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='18%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'date','text'=>'','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='date' ?><?php $attr_text='' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
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
		$tmp_text = lang($attr_text);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'3%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='3%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'upurl','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='upurl' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

	// Wahr-Vergleich
	if	( !empty($attr_true) )
		$exec = $$attr_true == true;

	// Falsch-Vergleich
	elseif	( !empty($attr_false) )
		$exec = $$attr_false != true;

	// Inhalt-Vergleich mit Wertliste
	elseif( !empty($attr_contains) )
		$exec = in_array($$attr_var,explode(',',$attr_contains));
				
	// Inhalt-Vergleich
	elseif( !empty($attr_var) )
		$exec = $$attr_var == $attr_value;

	// Vergleich auf leer
	elseif	( !empty($attr_empty) )
	{
		if	( !isset($$attr_empty) )
			$exec = true;
		elseif	( is_array($$attr_empty) )
			$exec = (count($$attr_empty)==0);
		elseif	( is_bool($$attr_empty) )
			$exec = true;
		else
			$exec = empty( $$attr_empty );
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_present) )
	{
		if	( !isset($$attr_present) )
			$exec = false;
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = !empty( $$attr_present );
	}
	else
	{
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array('title'=>'GLOBAL_UP','target'=>'','url'=>'upurl','class'=>'','action'=>'','subaction'=>'','id'=>'','var1'=>'','value1'=>'') ?><?php $attr_title='GLOBAL_UP' ?><?php $attr_target='' ?><?php $attr_url='upurl' ?><?php $attr_class='' ?><?php $attr_action='' ?><?php $attr_subaction='' ?><?php $attr_id='' ?><?php $attr_var1='' ?><?php $attr_value1='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $$attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo hasLang($attr_title)?lang($attr_title):lang($$attr_title) ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php unset($attr_action) ?><?php unset($attr_subaction) ?><?php unset($attr_id) ?><?php unset($attr_var1) ?><?php unset($attr_value1) ?><?php $attr = array('var'=>'bild','value'=>'arrow_up') ?><?php $attr_var='bild' ?><?php $attr_value='arrow_up' ?><?php $$attr_var = $attr_value ?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php $attr = array('file'=>'bild','url'=>'','align'=>'left','type'=>'','elementtype'=>'') ?><?php $attr_file='bild' ?><?php $attr_url='' ?><?php $attr_align='left' ?><?php $attr_type='' ?><?php $attr_elementtype='' ?><?php
if (!empty($attr_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$$attr_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$$attr_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($$attr_url)) {
?><img src="<?php echo $$attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_file)) {
?><img src="<?php echo $image_dir.$$attr_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?><?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_url) ?><?php unset($attr_align) ?><?php unset($attr_type) ?><?php unset($attr_elementtype) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'upurl','present'=>'','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='upurl' ?><?php $attr_present='' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

	// Wahr-Vergleich
	if	( !empty($attr_true) )
		$exec = $$attr_true == true;

	// Falsch-Vergleich
	elseif	( !empty($attr_false) )
		$exec = $$attr_false != true;

	// Inhalt-Vergleich mit Wertliste
	elseif( !empty($attr_contains) )
		$exec = in_array($$attr_var,explode(',',$attr_contains));
				
	// Inhalt-Vergleich
	elseif( !empty($attr_var) )
		$exec = $$attr_var == $attr_value;

	// Vergleich auf leer
	elseif	( !empty($attr_empty) )
	{
		if	( !isset($$attr_empty) )
			$exec = true;
		elseif	( is_array($$attr_empty) )
			$exec = (count($$attr_empty)==0);
		elseif	( is_bool($$attr_empty) )
			$exec = true;
		else
			$exec = empty( $$attr_empty );
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_present) )
	{
		if	( !isset($$attr_present) )
			$exec = false;
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = !empty( $$attr_present );
	}
	else
	{
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>'_','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw='_' ?><?php $attr_maxlength='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
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
		$tmp_text = lang($attr_text);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'3%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='3%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'topurl','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='topurl' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

	// Wahr-Vergleich
	if	( !empty($attr_true) )
		$exec = $$attr_true == true;

	// Falsch-Vergleich
	elseif	( !empty($attr_false) )
		$exec = $$attr_false != true;

	// Inhalt-Vergleich mit Wertliste
	elseif( !empty($attr_contains) )
		$exec = in_array($$attr_var,explode(',',$attr_contains));
				
	// Inhalt-Vergleich
	elseif( !empty($attr_var) )
		$exec = $$attr_var == $attr_value;

	// Vergleich auf leer
	elseif	( !empty($attr_empty) )
	{
		if	( !isset($$attr_empty) )
			$exec = true;
		elseif	( is_array($$attr_empty) )
			$exec = (count($$attr_empty)==0);
		elseif	( is_bool($$attr_empty) )
			$exec = true;
		else
			$exec = empty( $$attr_empty );
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_present) )
	{
		if	( !isset($$attr_present) )
			$exec = false;
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = !empty( $$attr_present );
	}
	else
	{
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array('title'=>'GLOBAL_TOP','target'=>'','url'=>'topurl','class'=>'','action'=>'','subaction'=>'','id'=>'','var1'=>'','value1'=>'') ?><?php $attr_title='GLOBAL_TOP' ?><?php $attr_target='' ?><?php $attr_url='topurl' ?><?php $attr_class='' ?><?php $attr_action='' ?><?php $attr_subaction='' ?><?php $attr_id='' ?><?php $attr_var1='' ?><?php $attr_value1='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $$attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo hasLang($attr_title)?lang($attr_title):lang($$attr_title) ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php unset($attr_action) ?><?php unset($attr_subaction) ?><?php unset($attr_id) ?><?php unset($attr_var1) ?><?php unset($attr_value1) ?><?php $attr = array('var'=>'bild','value'=>'arrow_top') ?><?php $attr_var='bild' ?><?php $attr_value='arrow_top' ?><?php $$attr_var = $attr_value ?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php $attr = array('file'=>'bild','url'=>'','align'=>'left','type'=>'','elementtype'=>'') ?><?php $attr_file='bild' ?><?php $attr_url='' ?><?php $attr_align='left' ?><?php $attr_type='' ?><?php $attr_elementtype='' ?><?php
if (!empty($attr_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$$attr_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$$attr_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($$attr_url)) {
?><img src="<?php echo $$attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_file)) {
?><img src="<?php echo $image_dir.$$attr_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?><?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_url) ?><?php unset($attr_align) ?><?php unset($attr_type) ?><?php unset($attr_elementtype) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'topurl','present'=>'','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='topurl' ?><?php $attr_present='' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

	// Wahr-Vergleich
	if	( !empty($attr_true) )
		$exec = $$attr_true == true;

	// Falsch-Vergleich
	elseif	( !empty($attr_false) )
		$exec = $$attr_false != true;

	// Inhalt-Vergleich mit Wertliste
	elseif( !empty($attr_contains) )
		$exec = in_array($$attr_var,explode(',',$attr_contains));
				
	// Inhalt-Vergleich
	elseif( !empty($attr_var) )
		$exec = $$attr_var == $attr_value;

	// Vergleich auf leer
	elseif	( !empty($attr_empty) )
	{
		if	( !isset($$attr_empty) )
			$exec = true;
		elseif	( is_array($$attr_empty) )
			$exec = (count($$attr_empty)==0);
		elseif	( is_bool($$attr_empty) )
			$exec = true;
		else
			$exec = empty( $$attr_empty );
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_present) )
	{
		if	( !isset($$attr_present) )
			$exec = false;
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = !empty( $$attr_present );
	}
	else
	{
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>'_','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw='_' ?><?php $attr_maxlength='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
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
		$tmp_text = lang($attr_text);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'3%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='3%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'bottomurl','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='bottomurl' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

	// Wahr-Vergleich
	if	( !empty($attr_true) )
		$exec = $$attr_true == true;

	// Falsch-Vergleich
	elseif	( !empty($attr_false) )
		$exec = $$attr_false != true;

	// Inhalt-Vergleich mit Wertliste
	elseif( !empty($attr_contains) )
		$exec = in_array($$attr_var,explode(',',$attr_contains));
				
	// Inhalt-Vergleich
	elseif( !empty($attr_var) )
		$exec = $$attr_var == $attr_value;

	// Vergleich auf leer
	elseif	( !empty($attr_empty) )
	{
		if	( !isset($$attr_empty) )
			$exec = true;
		elseif	( is_array($$attr_empty) )
			$exec = (count($$attr_empty)==0);
		elseif	( is_bool($$attr_empty) )
			$exec = true;
		else
			$exec = empty( $$attr_empty );
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_present) )
	{
		if	( !isset($$attr_present) )
			$exec = false;
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = !empty( $$attr_present );
	}
	else
	{
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array('title'=>'GLOBAL_BOTTOM','target'=>'','url'=>'bottomurl','class'=>'','action'=>'','subaction'=>'','id'=>'','var1'=>'','value1'=>'') ?><?php $attr_title='GLOBAL_BOTTOM' ?><?php $attr_target='' ?><?php $attr_url='bottomurl' ?><?php $attr_class='' ?><?php $attr_action='' ?><?php $attr_subaction='' ?><?php $attr_id='' ?><?php $attr_var1='' ?><?php $attr_value1='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $$attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo hasLang($attr_title)?lang($attr_title):lang($$attr_title) ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php unset($attr_action) ?><?php unset($attr_subaction) ?><?php unset($attr_id) ?><?php unset($attr_var1) ?><?php unset($attr_value1) ?><?php $attr = array('var'=>'bild','value'=>'arrow_bottom') ?><?php $attr_var='bild' ?><?php $attr_value='arrow_bottom' ?><?php $$attr_var = $attr_value ?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php $attr = array('file'=>'bild','url'=>'','align'=>'left','type'=>'','elementtype'=>'') ?><?php $attr_file='bild' ?><?php $attr_url='' ?><?php $attr_align='left' ?><?php $attr_type='' ?><?php $attr_elementtype='' ?><?php
if (!empty($attr_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$$attr_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$$attr_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($$attr_url)) {
?><img src="<?php echo $$attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_file)) {
?><img src="<?php echo $image_dir.$$attr_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?><?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_url) ?><?php unset($attr_align) ?><?php unset($attr_type) ?><?php unset($attr_elementtype) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'bottomurl','present'=>'','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='bottomurl' ?><?php $attr_present='' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

	// Wahr-Vergleich
	if	( !empty($attr_true) )
		$exec = $$attr_true == true;

	// Falsch-Vergleich
	elseif	( !empty($attr_false) )
		$exec = $$attr_false != true;

	// Inhalt-Vergleich mit Wertliste
	elseif( !empty($attr_contains) )
		$exec = in_array($$attr_var,explode(',',$attr_contains));
				
	// Inhalt-Vergleich
	elseif( !empty($attr_var) )
		$exec = $$attr_var == $attr_value;

	// Vergleich auf leer
	elseif	( !empty($attr_empty) )
	{
		if	( !isset($$attr_empty) )
			$exec = true;
		elseif	( is_array($$attr_empty) )
			$exec = (count($$attr_empty)==0);
		elseif	( is_bool($$attr_empty) )
			$exec = true;
		else
			$exec = empty( $$attr_empty );
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_present) )
	{
		if	( !isset($$attr_present) )
			$exec = false;
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = !empty( $$attr_present );
	}
	else
	{
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>'_','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw='_' ?><?php $attr_maxlength='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
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
		$tmp_text = lang($attr_text);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'3%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='3%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'downurl','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='downurl' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

	// Wahr-Vergleich
	if	( !empty($attr_true) )
		$exec = $$attr_true == true;

	// Falsch-Vergleich
	elseif	( !empty($attr_false) )
		$exec = $$attr_false != true;

	// Inhalt-Vergleich mit Wertliste
	elseif( !empty($attr_contains) )
		$exec = in_array($$attr_var,explode(',',$attr_contains));
				
	// Inhalt-Vergleich
	elseif( !empty($attr_var) )
		$exec = $$attr_var == $attr_value;

	// Vergleich auf leer
	elseif	( !empty($attr_empty) )
	{
		if	( !isset($$attr_empty) )
			$exec = true;
		elseif	( is_array($$attr_empty) )
			$exec = (count($$attr_empty)==0);
		elseif	( is_bool($$attr_empty) )
			$exec = true;
		else
			$exec = empty( $$attr_empty );
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_present) )
	{
		if	( !isset($$attr_present) )
			$exec = false;
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = !empty( $$attr_present );
	}
	else
	{
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array('title'=>'GLOBAL_DOWN','target'=>'','url'=>'downurl','class'=>'','action'=>'','subaction'=>'','id'=>'','var1'=>'','value1'=>'') ?><?php $attr_title='GLOBAL_DOWN' ?><?php $attr_target='' ?><?php $attr_url='downurl' ?><?php $attr_class='' ?><?php $attr_action='' ?><?php $attr_subaction='' ?><?php $attr_id='' ?><?php $attr_var1='' ?><?php $attr_value1='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $$attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo hasLang($attr_title)?lang($attr_title):lang($$attr_title) ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php unset($attr_action) ?><?php unset($attr_subaction) ?><?php unset($attr_id) ?><?php unset($attr_var1) ?><?php unset($attr_value1) ?><?php $attr = array('var'=>'bild','value'=>'arrow_down') ?><?php $attr_var='bild' ?><?php $attr_value='arrow_down' ?><?php $$attr_var = $attr_value ?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php $attr = array('file'=>'bild','url'=>'','align'=>'left','type'=>'','elementtype'=>'') ?><?php $attr_file='bild' ?><?php $attr_url='' ?><?php $attr_align='left' ?><?php $attr_type='' ?><?php $attr_elementtype='' ?><?php
if (!empty($attr_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$$attr_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$$attr_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($$attr_url)) {
?><img src="<?php echo $$attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_file)) {
?><img src="<?php echo $image_dir.$$attr_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?><?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_url) ?><?php unset($attr_align) ?><?php unset($attr_type) ?><?php unset($attr_elementtype) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'downurl','present'=>'','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='downurl' ?><?php $attr_present='' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

	// Wahr-Vergleich
	if	( !empty($attr_true) )
		$exec = $$attr_true == true;

	// Falsch-Vergleich
	elseif	( !empty($attr_false) )
		$exec = $$attr_false != true;

	// Inhalt-Vergleich mit Wertliste
	elseif( !empty($attr_contains) )
		$exec = in_array($$attr_var,explode(',',$attr_contains));
				
	// Inhalt-Vergleich
	elseif( !empty($attr_var) )
		$exec = $$attr_var == $attr_value;

	// Vergleich auf leer
	elseif	( !empty($attr_empty) )
	{
		if	( !isset($$attr_empty) )
			$exec = true;
		elseif	( is_array($$attr_empty) )
			$exec = (count($$attr_empty)==0);
		elseif	( is_bool($$attr_empty) )
			$exec = true;
		else
			$exec = empty( $$attr_empty );
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_present) )
	{
		if	( !isset($$attr_present) )
			$exec = false;
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = !empty( $$attr_present );
	}
	else
	{
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>'_','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw='_' ?><?php $attr_maxlength='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
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
		$tmp_text = lang($attr_text);
	elseif (!empty($attr_var))
		$tmp_text = isset($$attr_var)?htmlentities($$attr_var):'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?><?php
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