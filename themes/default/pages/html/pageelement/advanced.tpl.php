<?php $attr1 = array('class'=>'main','title'=>$cms_title) ?><?php $attr1_class='main' ?><?php $attr1_title=$cms_title ?><?php header('Content-Type: text/html; charset='.lang('CHARSET'))
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo $attr1_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo lang('CHARSET') ?>" />
  <meta name="MSSmartTagsPreventParsing" content="true" />
  <meta name="robots" content="noindex,nofollow" />
<?php if (is_array($windowMenu)) foreach( $windowMenu as $menu )
      {
       	?>
  <link rel="section" href="<?php echo Html::url($actionName,$menu['subaction'],$this->getRequestId() ) ?>" title="<?php echo lang($menu['text']) ?>" />
<?php
      }
?>
  <link rel="stylesheet" type="text/css" href="./themes/default/css/default.css" />
<?php if($stylesheet!='default') { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $stylesheet ?>" />
<?php } ?>
</head>

<body class="<?php echo $attr1_class ?>">

<?php unset($attr1) ?><?php unset($attr1_class) ?><?php unset($attr1_title) ?><?php $attr2 = array('target'=>'_self','method'=>'post','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr2_target='_self' ?><?php $attr2_method='post' ?><?php $attr2_enctype='application/x-www-form-urlencoded' ?><?php
	if	(empty($attr2_action))
		$attr2_action = $actionName;
	if	(empty($attr2_subaction))
		$attr2_subaction = $targetSubActionName;
	if	(empty($attr2_id))
		$attr2_id = $this->getRequestId();
		
?><form name="<?php echo $attr2_name ?>"
      target="<?php echo $attr2_target ?>"
      action="<?php echo Html::url( $attr2_action,$attr2_subaction,$attr2_id ) ?>"
      method="<?php echo $attr2_method ?>"
      enctype="<?php echo $attr2_enctype ?>">
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr2_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr2_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr2_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr2) ?><?php unset($attr2_target) ?><?php unset($attr2_method) ?><?php unset($attr2_enctype) ?><?php $attr3 = array('name'=>'element','width'=>'93%','rowclasses'=>'odd,even','columnclasses'=>'1,2,3') ?><?php $attr3_name='element' ?><?php $attr3_width='93%' ?><?php $attr3_rowclasses='odd,even' ?><?php $attr3_columnclasses='1,2,3' ?><?php
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
		echo '<br/><br/><br/><center>';
		echo '<table class="main" cellspacing="0" cellpadding="4" width="'.$attr3_width.'">';
		echo '<tr><td class="menu">';
		if	( !empty($attr3_icon) )
			echo '<img src="'.$image_dir.'icon_'.$attr3_icon.IMG_ICON_EXT.'" align="left" border="0">';
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
      <table class="n" cellspacing="0" width="100%" cellpadding="4"><?php unset($attr3) ?><?php unset($attr3_name) ?><?php unset($attr3_width) ?><?php unset($attr3_rowclasses) ?><?php unset($attr3_columnclasses) ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr4_class))
		$attr4_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5 = array('class'=>'help','colspan'=>'2') ?><?php $attr5_class='help' ?><?php $attr5_colspan='2' ?><?php
//	if (empty($attr5_class))
//		$attr5['class']=$row_class;
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
		
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_colspan) ?><?php $attr6 = array('class'=>'text','var'=>'desc') ?><?php $attr6_class='text' ?><?php $attr6_var='desc' ?><?php
	if	( isset($attr6_prefix)&& isset($attr6_key))
		$attr6_key = $attr6_prefix.$attr6_key;
	if	( isset($attr6_suffix)&& isset($attr6_key))
		$attr6_key = $attr6_key.$attr6_suffix;
		
	if(empty($attr6_title))
		if (!empty($attr6_key))
			$attr6_title = lang($attr6_key.'_HELP');
		else
			$attr6_title = '';

?><span class="<?php echo $attr6_class ?>" title="<?php echo $attr6_title ?>"><?php
	$attr6_title = '';

	if (!empty($attr6_array))
	{
		//geht nicht:
		//echo $$attr6_array[$attr6_var].'%';
		$tmpArray = $$attr6_array;
		if (!empty($attr6_var))
			$tmp_text = $tmpArray[$attr6_var];
		else
			$tmp_text = lang($tmpArray[$attr6_text]);
	}
	elseif (!empty($attr6_text))
		if	( isset($$attr6_text))
			$tmp_text = lang($$attr6_text);
		else
			$tmp_text = lang($attr6_text);
	elseif (!empty($attr6_textvar))
		$tmp_text = lang($$attr6_textvar);
	elseif (!empty($attr6_key))
		$tmp_text = lang($attr6_key);
	elseif (!empty($attr6_var))
		$tmp_text = isset($$attr6_var)?htmlentities($$attr6_var):'error: variable '.$attr6_var.' not present';	
	elseif (!empty($attr6_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr6_raw);
	elseif (!empty($attr6_value))
		$tmp_text = $attr6_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr6);echo 'text error';
	}
	
	if	( !empty($attr6_maxlength) && intval($attr6_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr6_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_var) ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr4 = array('equals'=>'date','value'=>$type) ?><?php $attr4_equals='date' ?><?php $attr4_value=$type ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr4);
	
	if	( isset($attr4_true) )
	{
		if	(gettype($attr4_true) === '' && gettype($attr4_true) === '1')
			$exec = $$attr4_true == true;
		else
			$exec = $attr4_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr4_false) )
	{
		if	(gettype($attr4_false) === '' && gettype($attr4_false) === '1')
			$exec = $$attr4_false == false;
		else
			$exec = $attr4_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr4_contains) )
		$exec = in_array($attr4_value,explode(',',$attr4_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr4_equals)&& isset($attr4_value) )
		$exec = $attr4_equals == $attr4_value;

	// Vergleich auf leer
	elseif	( isset($attr4_empty) )
	{
		if	( !isset($$attr4_empty) )
			$exec = empty($attr4_empty);
		elseif	( is_array($$attr4_empty) )
			$exec = (count($$attr4_empty)==0);
		elseif	( is_bool($$attr4_empty) )
			$exec = true;
		else
			$exec = empty( $$attr4_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr4_present) )
	{
		$exec = isset($$attr4_present);
//		if	( !isset($$attr4_present) )
//			$exec = false;
//		elseif	( is_array($$attr4_present) )
//			$exec = (count($$attr4_present)>0);
//		elseif	( is_bool($$attr4_present) )
//			$exec = $$attr4_present;
//		elseif	( is_numeric($$attr4_present) )
//			$exec = $$attr4_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr4 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr4_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr4_not) )
		$exec = !$exec;

	unset($attr4_true);
	unset($attr4_false);
	unset($attr4_notempty);
	unset($attr4_empty);
	unset($attr4_contains);
	unset($attr4_present);
	unset($attr4_invert);
	unset($attr4_not);
	unset($attr4_value);
	unset($attr4_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr4) ?><?php unset($attr4_equals) ?><?php unset($attr4_value) ?><?php $attr5 = array('width'=>'85%','space'=>'0px','padding'=>'0px','rowclasses'=>'odd,even') ?><?php $attr5_width='85%' ?><?php $attr5_space='0px' ?><?php $attr5_padding='0px' ?><?php $attr5_rowclasses='odd,even' ?><?php
	$coloumn_widths=array();
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
	
?><table class="<?php echo $attr5_class ?>" cellspacing="<?php echo $attr5_space ?>" width="<?php echo $attr5_width ?>" cellpadding="<?php echo $attr5_padding ?>"><?php unset($attr5) ?><?php unset($attr5_width) ?><?php unset($attr5_space) ?><?php unset($attr5_padding) ?><?php unset($attr5_rowclasses) ?><?php $attr6 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr6_class))
		$attr6_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr6_class ?>"><?php unset($attr6) ?><?php $attr7 = array('class'=>'help','colspan'=>'7') ?><?php $attr7_class='help' ?><?php $attr7_colspan='7' ?><?php
//	if (empty($attr7_class))
//		$attr7['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_colspan) ?><?php $attr8 = array('target'=>'_self','url'=>$lastmonthurl) ?><?php $attr8_target='_self' ?><?php $attr8_url=$lastmonthurl ?><?php
	if(!empty($attr8_url))
		$tmp_url = $attr8_url;
	else
		$tmp_url = Html::url($attr8_action,$attr8_subaction,!empty($$attr8_id)?$$attr8_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr8_class ?>" target="<?php echo $attr8_target ?>" title="<?php echo $attr8_title ?>"><?php unset($attr8) ?><?php unset($attr8_target) ?><?php unset($attr8_url) ?><?php $attr9 = array('file'=>'left','align'=>'middle') ?><?php $attr9_file='left' ?><?php $attr9_align='middle' ?><?php
if (isset($attr9_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr9_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_url)) {
?><img src="<?php echo $attr9_url ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_fileext)) {
?><img src="<?php echo $image_dir.$attr9_fileext ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_file)) {
?><img src="<?php echo $image_dir.$attr9_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php } ?><?php unset($attr9) ?><?php unset($attr9_file) ?><?php unset($attr9_align) ?><?php $attr7 = array() ?></a><?php unset($attr7) ?><?php $attr8 = array('class'=>'text','raw'=>'_') ?><?php $attr8_class='text' ?><?php $attr8_raw='_' ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
		
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';

?><span class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';

	if (!empty($attr8_array))
	{
		//geht nicht:
		//echo $$attr8_array[$attr8_var].'%';
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = lang($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		if	( isset($$attr8_text))
			$tmp_text = lang($$attr8_text);
		else
			$tmp_text = lang($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = lang($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = lang($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?htmlentities($$attr8_var):'error: variable '.$attr8_var.' not present';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr8);echo 'text error';
	}
	
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php $attr8 = array('class'=>'text','text'=>$monthname) ?><?php $attr8_class='text' ?><?php $attr8_text=$monthname ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
		
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';

?><span class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';

	if (!empty($attr8_array))
	{
		//geht nicht:
		//echo $$attr8_array[$attr8_var].'%';
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = lang($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		if	( isset($$attr8_text))
			$tmp_text = lang($$attr8_text);
		else
			$tmp_text = lang($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = lang($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = lang($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?htmlentities($$attr8_var):'error: variable '.$attr8_var.' not present';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr8);echo 'text error';
	}
	
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_text) ?><?php $attr8 = array('class'=>'text','raw'=>'_') ?><?php $attr8_class='text' ?><?php $attr8_raw='_' ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
		
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';

?><span class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';

	if (!empty($attr8_array))
	{
		//geht nicht:
		//echo $$attr8_array[$attr8_var].'%';
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = lang($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		if	( isset($$attr8_text))
			$tmp_text = lang($$attr8_text);
		else
			$tmp_text = lang($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = lang($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = lang($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?htmlentities($$attr8_var):'error: variable '.$attr8_var.' not present';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr8);echo 'text error';
	}
	
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php $attr8 = array('target'=>'_self','url'=>$nextmonthurl) ?><?php $attr8_target='_self' ?><?php $attr8_url=$nextmonthurl ?><?php
	if(!empty($attr8_url))
		$tmp_url = $attr8_url;
	else
		$tmp_url = Html::url($attr8_action,$attr8_subaction,!empty($$attr8_id)?$$attr8_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr8_class ?>" target="<?php echo $attr8_target ?>" title="<?php echo $attr8_title ?>"><?php unset($attr8) ?><?php unset($attr8_target) ?><?php unset($attr8_url) ?><?php $attr9 = array('file'=>'right','align'=>'middle') ?><?php $attr9_file='right' ?><?php $attr9_align='middle' ?><?php
if (isset($attr9_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr9_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_url)) {
?><img src="<?php echo $attr9_url ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_fileext)) {
?><img src="<?php echo $image_dir.$attr9_fileext ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_file)) {
?><img src="<?php echo $image_dir.$attr9_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php } ?><?php unset($attr9) ?><?php unset($attr9_file) ?><?php unset($attr9_align) ?><?php $attr7 = array() ?></a><?php unset($attr7) ?><?php $attr8 = array('class'=>'text','raw'=>'_____') ?><?php $attr8_class='text' ?><?php $attr8_raw='_____' ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
		
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';

?><span class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';

	if (!empty($attr8_array))
	{
		//geht nicht:
		//echo $$attr8_array[$attr8_var].'%';
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = lang($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		if	( isset($$attr8_text))
			$tmp_text = lang($$attr8_text);
		else
			$tmp_text = lang($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = lang($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = lang($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?htmlentities($$attr8_var):'error: variable '.$attr8_var.' not present';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr8);echo 'text error';
	}
	
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php $attr8 = array('target'=>'_self','url'=>$lastyearurl) ?><?php $attr8_target='_self' ?><?php $attr8_url=$lastyearurl ?><?php
	if(!empty($attr8_url))
		$tmp_url = $attr8_url;
	else
		$tmp_url = Html::url($attr8_action,$attr8_subaction,!empty($$attr8_id)?$$attr8_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr8_class ?>" target="<?php echo $attr8_target ?>" title="<?php echo $attr8_title ?>"><?php unset($attr8) ?><?php unset($attr8_target) ?><?php unset($attr8_url) ?><?php $attr9 = array('file'=>'left','align'=>'middle') ?><?php $attr9_file='left' ?><?php $attr9_align='middle' ?><?php
if (isset($attr9_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr9_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_url)) {
?><img src="<?php echo $attr9_url ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_fileext)) {
?><img src="<?php echo $image_dir.$attr9_fileext ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_file)) {
?><img src="<?php echo $image_dir.$attr9_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php } ?><?php unset($attr9) ?><?php unset($attr9_file) ?><?php unset($attr9_align) ?><?php $attr7 = array() ?></a><?php unset($attr7) ?><?php $attr8 = array('class'=>'text','raw'=>'_') ?><?php $attr8_class='text' ?><?php $attr8_raw='_' ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
		
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';

?><span class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';

	if (!empty($attr8_array))
	{
		//geht nicht:
		//echo $$attr8_array[$attr8_var].'%';
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = lang($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		if	( isset($$attr8_text))
			$tmp_text = lang($$attr8_text);
		else
			$tmp_text = lang($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = lang($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = lang($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?htmlentities($$attr8_var):'error: variable '.$attr8_var.' not present';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr8);echo 'text error';
	}
	
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php $attr8 = array('class'=>'text','text'=>$yearname) ?><?php $attr8_class='text' ?><?php $attr8_text=$yearname ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
		
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';

?><span class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';

	if (!empty($attr8_array))
	{
		//geht nicht:
		//echo $$attr8_array[$attr8_var].'%';
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = lang($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		if	( isset($$attr8_text))
			$tmp_text = lang($$attr8_text);
		else
			$tmp_text = lang($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = lang($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = lang($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?htmlentities($$attr8_var):'error: variable '.$attr8_var.' not present';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr8);echo 'text error';
	}
	
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_text) ?><?php $attr8 = array('class'=>'text','raw'=>'_') ?><?php $attr8_class='text' ?><?php $attr8_raw='_' ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
		
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';

?><span class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';

	if (!empty($attr8_array))
	{
		//geht nicht:
		//echo $$attr8_array[$attr8_var].'%';
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = lang($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		if	( isset($$attr8_text))
			$tmp_text = lang($$attr8_text);
		else
			$tmp_text = lang($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = lang($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = lang($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?htmlentities($$attr8_var):'error: variable '.$attr8_var.' not present';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr8);echo 'text error';
	}
	
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php $attr8 = array('target'=>'_self','url'=>$nextyearurl) ?><?php $attr8_target='_self' ?><?php $attr8_url=$nextyearurl ?><?php
	if(!empty($attr8_url))
		$tmp_url = $attr8_url;
	else
		$tmp_url = Html::url($attr8_action,$attr8_subaction,!empty($$attr8_id)?$$attr8_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr8_class ?>" target="<?php echo $attr8_target ?>" title="<?php echo $attr8_title ?>"><?php unset($attr8) ?><?php unset($attr8_target) ?><?php unset($attr8_url) ?><?php $attr9 = array('file'=>'right','align'=>'middle') ?><?php $attr9_file='right' ?><?php $attr9_align='middle' ?><?php
if (isset($attr9_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr9_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr9_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_url)) {
?><img src="<?php echo $attr9_url ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_fileext)) {
?><img src="<?php echo $image_dir.$attr9_fileext ?>" border="0" align="<?php echo $attr9_align ?>"><?php
} elseif (isset($attr9_file)) {
?><img src="<?php echo $image_dir.$attr9_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php } ?><?php unset($attr9) ?><?php unset($attr9_file) ?><?php unset($attr9_align) ?><?php $attr7 = array() ?></a><?php unset($attr7) ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr6 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr6_class))
		$attr6_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr6_class ?>"><?php unset($attr6) ?><?php $attr7 = array() ?><?php
//	if (empty($attr7_class))
//		$attr7['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php $attr8 = array('class'=>'text','text'=>lang('global_nr')) ?><?php $attr8_class='text' ?><?php $attr8_text=lang('global_nr') ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
		
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';

?><span class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';

	if (!empty($attr8_array))
	{
		//geht nicht:
		//echo $$attr8_array[$attr8_var].'%';
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = lang($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		if	( isset($$attr8_text))
			$tmp_text = lang($$attr8_text);
		else
			$tmp_text = lang($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = lang($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = lang($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?htmlentities($$attr8_var):'error: variable '.$attr8_var.' not present';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr8);echo 'text error';
	}
	
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_text) ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr7 = array('list'=>'weekdays','extract'=>'','key'=>'list_key','value'=>'weekday') ?><?php $attr7_list='weekdays' ?><?php $attr7_extract='' ?><?php $attr7_key='list_key' ?><?php $attr7_value='weekday' ?><?php
	$attr7_list_tmp_key   = $attr7_key;
	$attr7_list_tmp_value = $attr7_value;
	$attr7_list_extract   = ($attr7_extract==true);

	if	( !is_array($$attr7_list) )
		$$attr7_list = array();
//		die('not an array in list,var='.$attr7_list);
//		Html::debug($$attr7_list);
	
	foreach( $$attr7_list as $$attr7_list_tmp_key => $$attr7_list_tmp_value )
	{
		if	( $attr7_list_extract )
		{
			if	( !is_array($$attr7_list_tmp_value) )
			{
				print_r($$attr7_list_tmp_value);
				die( 'not an array at key: '.$$attr7_list_tmp_key );
			}
			extract($$attr7_list_tmp_value);
		}
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_extract) ?><?php unset($attr7_key) ?><?php unset($attr7_value) ?><?php $attr8 = array() ?><?php
//	if (empty($attr8_class))
//		$attr8['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr8_class))
		$attr8['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr8_rowspan) )
		$attr8['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr8 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr8) ?><?php $attr9 = array('class'=>'text','text'=>$weekday) ?><?php $attr9_class='text' ?><?php $attr9_text=$weekday ?><?php
	if	( isset($attr9_prefix)&& isset($attr9_key))
		$attr9_key = $attr9_prefix.$attr9_key;
	if	( isset($attr9_suffix)&& isset($attr9_key))
		$attr9_key = $attr9_key.$attr9_suffix;
		
	if(empty($attr9_title))
		if (!empty($attr9_key))
			$attr9_title = lang($attr9_key.'_HELP');
		else
			$attr9_title = '';

?><span class="<?php echo $attr9_class ?>" title="<?php echo $attr9_title ?>"><?php
	$attr9_title = '';

	if (!empty($attr9_array))
	{
		//geht nicht:
		//echo $$attr9_array[$attr9_var].'%';
		$tmpArray = $$attr9_array;
		if (!empty($attr9_var))
			$tmp_text = $tmpArray[$attr9_var];
		else
			$tmp_text = lang($tmpArray[$attr9_text]);
	}
	elseif (!empty($attr9_text))
		if	( isset($$attr9_text))
			$tmp_text = lang($$attr9_text);
		else
			$tmp_text = lang($attr9_text);
	elseif (!empty($attr9_textvar))
		$tmp_text = lang($$attr9_textvar);
	elseif (!empty($attr9_key))
		$tmp_text = lang($attr9_key);
	elseif (!empty($attr9_var))
		$tmp_text = isset($$attr9_var)?htmlentities($$attr9_var):'error: variable '.$attr9_var.' not present';	
	elseif (!empty($attr9_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr9_raw);
	elseif (!empty($attr9_value))
		$tmp_text = $attr9_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr9);echo 'text error';
	}
	
	if	( !empty($attr9_maxlength) && intval($attr9_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr9_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_text) ?><?php $attr7 = array() ?></td><?php unset($attr7) ?><?php $attr6 = array() ?><?php } ?><?php unset($attr6) ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr6 = array('list'=>'weeklist','extract'=>'','key'=>'weeknr','value'=>'week') ?><?php $attr6_list='weeklist' ?><?php $attr6_extract='' ?><?php $attr6_key='weeknr' ?><?php $attr6_value='week' ?><?php
	$attr6_list_tmp_key   = $attr6_key;
	$attr6_list_tmp_value = $attr6_value;
	$attr6_list_extract   = ($attr6_extract==true);

	if	( !is_array($$attr6_list) )
		$$attr6_list = array();
//		die('not an array in list,var='.$attr6_list);
//		Html::debug($$attr6_list);
	
	foreach( $$attr6_list as $$attr6_list_tmp_key => $$attr6_list_tmp_value )
	{
		if	( $attr6_list_extract )
		{
			if	( !is_array($$attr6_list_tmp_value) )
			{
				print_r($$attr6_list_tmp_value);
				die( 'not an array at key: '.$$attr6_list_tmp_key );
			}
			extract($$attr6_list_tmp_value);
		}
?><?php unset($attr6) ?><?php unset($attr6_list) ?><?php unset($attr6_extract) ?><?php unset($attr6_key) ?><?php unset($attr6_value) ?><?php $attr7 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr7_class))
		$attr7_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr7_class ?>"><?php unset($attr7) ?><?php $attr8 = array('width'=>'12%') ?><?php $attr8_width='12%' ?><?php
//	if (empty($attr8_class))
//		$attr8['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr8_class))
		$attr8['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr8_rowspan) )
		$attr8['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr8 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr8) ?><?php unset($attr8_width) ?><?php $attr9 = array('class'=>'text','text'=>$weeknr) ?><?php $attr9_class='text' ?><?php $attr9_text=$weeknr ?><?php
	if	( isset($attr9_prefix)&& isset($attr9_key))
		$attr9_key = $attr9_prefix.$attr9_key;
	if	( isset($attr9_suffix)&& isset($attr9_key))
		$attr9_key = $attr9_key.$attr9_suffix;
		
	if(empty($attr9_title))
		if (!empty($attr9_key))
			$attr9_title = lang($attr9_key.'_HELP');
		else
			$attr9_title = '';

?><span class="<?php echo $attr9_class ?>" title="<?php echo $attr9_title ?>"><?php
	$attr9_title = '';

	if (!empty($attr9_array))
	{
		//geht nicht:
		//echo $$attr9_array[$attr9_var].'%';
		$tmpArray = $$attr9_array;
		if (!empty($attr9_var))
			$tmp_text = $tmpArray[$attr9_var];
		else
			$tmp_text = lang($tmpArray[$attr9_text]);
	}
	elseif (!empty($attr9_text))
		if	( isset($$attr9_text))
			$tmp_text = lang($$attr9_text);
		else
			$tmp_text = lang($attr9_text);
	elseif (!empty($attr9_textvar))
		$tmp_text = lang($$attr9_textvar);
	elseif (!empty($attr9_key))
		$tmp_text = lang($attr9_key);
	elseif (!empty($attr9_var))
		$tmp_text = isset($$attr9_var)?htmlentities($$attr9_var):'error: variable '.$attr9_var.' not present';	
	elseif (!empty($attr9_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr9_raw);
	elseif (!empty($attr9_value))
		$tmp_text = $attr9_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr9);echo 'text error';
	}
	
	if	( !empty($attr9_maxlength) && intval($attr9_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr9_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_text) ?><?php $attr7 = array() ?></td><?php unset($attr7) ?><?php $attr8 = array('list'=>'week','extract'=>'1','key'=>'list_key','value'=>'list_value') ?><?php $attr8_list='week' ?><?php $attr8_extract='1' ?><?php $attr8_key='list_key' ?><?php $attr8_value='list_value' ?><?php
	$attr8_list_tmp_key   = $attr8_key;
	$attr8_list_tmp_value = $attr8_value;
	$attr8_list_extract   = ($attr8_extract==true);

	if	( !is_array($$attr8_list) )
		$$attr8_list = array();
//		die('not an array in list,var='.$attr8_list);
//		Html::debug($$attr8_list);
	
	foreach( $$attr8_list as $$attr8_list_tmp_key => $$attr8_list_tmp_value )
	{
		if	( $attr8_list_extract )
		{
			if	( !is_array($$attr8_list_tmp_value) )
			{
				print_r($$attr8_list_tmp_value);
				die( 'not an array at key: '.$$attr8_list_tmp_key );
			}
			extract($$attr8_list_tmp_value);
		}
?><?php unset($attr8) ?><?php unset($attr8_list) ?><?php unset($attr8_extract) ?><?php unset($attr8_key) ?><?php unset($attr8_value) ?><?php $attr9 = array('width'=>'12%') ?><?php $attr9_width='12%' ?><?php
//	if (empty($attr9_class))
//		$attr9['class']=$row_class;
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
		
?><td <?php foreach( $attr9 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr9) ?><?php unset($attr9_width) ?><?php $attr10 = array('empty'=>'url') ?><?php $attr10_empty='url' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr10);
	
	if	( isset($attr10_true) )
	{
		if	(gettype($attr10_true) === '' && gettype($attr10_true) === '1')
			$exec = $$attr10_true == true;
		else
			$exec = $attr10_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr10_false) )
	{
		if	(gettype($attr10_false) === '' && gettype($attr10_false) === '1')
			$exec = $$attr10_false == false;
		else
			$exec = $attr10_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr10_contains) )
		$exec = in_array($attr10_value,explode(',',$attr10_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr10_equals)&& isset($attr10_value) )
		$exec = $attr10_equals == $attr10_value;

	// Vergleich auf leer
	elseif	( isset($attr10_empty) )
	{
		if	( !isset($$attr10_empty) )
			$exec = empty($attr10_empty);
		elseif	( is_array($$attr10_empty) )
			$exec = (count($$attr10_empty)==0);
		elseif	( is_bool($$attr10_empty) )
			$exec = true;
		else
			$exec = empty( $$attr10_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr10_present) )
	{
		$exec = isset($$attr10_present);
//		if	( !isset($$attr10_present) )
//			$exec = false;
//		elseif	( is_array($$attr10_present) )
//			$exec = (count($$attr10_present)>0);
//		elseif	( is_bool($$attr10_present) )
//			$exec = $$attr10_present;
//		elseif	( is_numeric($$attr10_present) )
//			$exec = $$attr10_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr10 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr10_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr10_not) )
		$exec = !$exec;

	unset($attr10_true);
	unset($attr10_false);
	unset($attr10_notempty);
	unset($attr10_empty);
	unset($attr10_contains);
	unset($attr10_present);
	unset($attr10_invert);
	unset($attr10_not);
	unset($attr10_value);
	unset($attr10_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr10) ?><?php unset($attr10_empty) ?><?php $attr11 = array('class'=>'text','raw'=>'__') ?><?php $attr11_class='text' ?><?php $attr11_raw='__' ?><?php
	if	( isset($attr11_prefix)&& isset($attr11_key))
		$attr11_key = $attr11_prefix.$attr11_key;
	if	( isset($attr11_suffix)&& isset($attr11_key))
		$attr11_key = $attr11_key.$attr11_suffix;
		
	if(empty($attr11_title))
		if (!empty($attr11_key))
			$attr11_title = lang($attr11_key.'_HELP');
		else
			$attr11_title = '';

?><span class="<?php echo $attr11_class ?>" title="<?php echo $attr11_title ?>"><?php
	$attr11_title = '';

	if (!empty($attr11_array))
	{
		//geht nicht:
		//echo $$attr11_array[$attr11_var].'%';
		$tmpArray = $$attr11_array;
		if (!empty($attr11_var))
			$tmp_text = $tmpArray[$attr11_var];
		else
			$tmp_text = lang($tmpArray[$attr11_text]);
	}
	elseif (!empty($attr11_text))
		if	( isset($$attr11_text))
			$tmp_text = lang($$attr11_text);
		else
			$tmp_text = lang($attr11_text);
	elseif (!empty($attr11_textvar))
		$tmp_text = lang($$attr11_textvar);
	elseif (!empty($attr11_key))
		$tmp_text = lang($attr11_key);
	elseif (!empty($attr11_var))
		$tmp_text = isset($$attr11_var)?htmlentities($$attr11_var):'error: variable '.$attr11_var.' not present';	
	elseif (!empty($attr11_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr11_raw);
	elseif (!empty($attr11_value))
		$tmp_text = $attr11_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr11);echo 'text error';
	}
	
	if	( !empty($attr11_maxlength) && intval($attr11_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr11_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr11) ?><?php unset($attr11_class) ?><?php unset($attr11_raw) ?><?php $attr11 = array('class'=>'text','text'=>$nr) ?><?php $attr11_class='text' ?><?php $attr11_text=$nr ?><?php
	if	( isset($attr11_prefix)&& isset($attr11_key))
		$attr11_key = $attr11_prefix.$attr11_key;
	if	( isset($attr11_suffix)&& isset($attr11_key))
		$attr11_key = $attr11_key.$attr11_suffix;
		
	if(empty($attr11_title))
		if (!empty($attr11_key))
			$attr11_title = lang($attr11_key.'_HELP');
		else
			$attr11_title = '';

?><span class="<?php echo $attr11_class ?>" title="<?php echo $attr11_title ?>"><?php
	$attr11_title = '';

	if (!empty($attr11_array))
	{
		//geht nicht:
		//echo $$attr11_array[$attr11_var].'%';
		$tmpArray = $$attr11_array;
		if (!empty($attr11_var))
			$tmp_text = $tmpArray[$attr11_var];
		else
			$tmp_text = lang($tmpArray[$attr11_text]);
	}
	elseif (!empty($attr11_text))
		if	( isset($$attr11_text))
			$tmp_text = lang($$attr11_text);
		else
			$tmp_text = lang($attr11_text);
	elseif (!empty($attr11_textvar))
		$tmp_text = lang($$attr11_textvar);
	elseif (!empty($attr11_key))
		$tmp_text = lang($attr11_key);
	elseif (!empty($attr11_var))
		$tmp_text = isset($$attr11_var)?htmlentities($$attr11_var):'error: variable '.$attr11_var.' not present';	
	elseif (!empty($attr11_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr11_raw);
	elseif (!empty($attr11_value))
		$tmp_text = $attr11_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr11);echo 'text error';
	}
	
	if	( !empty($attr11_maxlength) && intval($attr11_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr11_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr11) ?><?php unset($attr11_class) ?><?php unset($attr11_text) ?><?php $attr11 = array('class'=>'text','raw'=>'__') ?><?php $attr11_class='text' ?><?php $attr11_raw='__' ?><?php
	if	( isset($attr11_prefix)&& isset($attr11_key))
		$attr11_key = $attr11_prefix.$attr11_key;
	if	( isset($attr11_suffix)&& isset($attr11_key))
		$attr11_key = $attr11_key.$attr11_suffix;
		
	if(empty($attr11_title))
		if (!empty($attr11_key))
			$attr11_title = lang($attr11_key.'_HELP');
		else
			$attr11_title = '';

?><span class="<?php echo $attr11_class ?>" title="<?php echo $attr11_title ?>"><?php
	$attr11_title = '';

	if (!empty($attr11_array))
	{
		//geht nicht:
		//echo $$attr11_array[$attr11_var].'%';
		$tmpArray = $$attr11_array;
		if (!empty($attr11_var))
			$tmp_text = $tmpArray[$attr11_var];
		else
			$tmp_text = lang($tmpArray[$attr11_text]);
	}
	elseif (!empty($attr11_text))
		if	( isset($$attr11_text))
			$tmp_text = lang($$attr11_text);
		else
			$tmp_text = lang($attr11_text);
	elseif (!empty($attr11_textvar))
		$tmp_text = lang($$attr11_textvar);
	elseif (!empty($attr11_key))
		$tmp_text = lang($attr11_key);
	elseif (!empty($attr11_var))
		$tmp_text = isset($$attr11_var)?htmlentities($$attr11_var):'error: variable '.$attr11_var.' not present';	
	elseif (!empty($attr11_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr11_raw);
	elseif (!empty($attr11_value))
		$tmp_text = $attr11_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr11);echo 'text error';
	}
	
	if	( !empty($attr11_maxlength) && intval($attr11_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr11_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr11) ?><?php unset($attr11_class) ?><?php unset($attr11_raw) ?><?php $attr9 = array() ?><?php
	}
	
?><?php unset($attr9) ?><?php $attr10 = array('not'=>'1','empty'=>'url') ?><?php $attr10_not='1' ?><?php $attr10_empty='url' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr10);
	
	if	( isset($attr10_true) )
	{
		if	(gettype($attr10_true) === '' && gettype($attr10_true) === '1')
			$exec = $$attr10_true == true;
		else
			$exec = $attr10_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr10_false) )
	{
		if	(gettype($attr10_false) === '' && gettype($attr10_false) === '1')
			$exec = $$attr10_false == false;
		else
			$exec = $attr10_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr10_contains) )
		$exec = in_array($attr10_value,explode(',',$attr10_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr10_equals)&& isset($attr10_value) )
		$exec = $attr10_equals == $attr10_value;

	// Vergleich auf leer
	elseif	( isset($attr10_empty) )
	{
		if	( !isset($$attr10_empty) )
			$exec = empty($attr10_empty);
		elseif	( is_array($$attr10_empty) )
			$exec = (count($$attr10_empty)==0);
		elseif	( is_bool($$attr10_empty) )
			$exec = true;
		else
			$exec = empty( $$attr10_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr10_present) )
	{
		$exec = isset($$attr10_present);
//		if	( !isset($$attr10_present) )
//			$exec = false;
//		elseif	( is_array($$attr10_present) )
//			$exec = (count($$attr10_present)>0);
//		elseif	( is_bool($$attr10_present) )
//			$exec = $$attr10_present;
//		elseif	( is_numeric($$attr10_present) )
//			$exec = $$attr10_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr10 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr10_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr10_not) )
		$exec = !$exec;

	unset($attr10_true);
	unset($attr10_false);
	unset($attr10_notempty);
	unset($attr10_empty);
	unset($attr10_contains);
	unset($attr10_present);
	unset($attr10_invert);
	unset($attr10_not);
	unset($attr10_value);
	unset($attr10_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr10) ?><?php unset($attr10_not) ?><?php unset($attr10_empty) ?><?php $attr11 = array('target'=>'_self','url'=>$url) ?><?php $attr11_target='_self' ?><?php $attr11_url=$url ?><?php
	if(!empty($attr11_url))
		$tmp_url = $attr11_url;
	else
		$tmp_url = Html::url($attr11_action,$attr11_subaction,!empty($$attr11_id)?$$attr11_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr11_class ?>" target="<?php echo $attr11_target ?>" title="<?php echo $attr11_title ?>"><?php unset($attr11) ?><?php unset($attr11_target) ?><?php unset($attr11_url) ?><?php $attr12 = array('class'=>'text','raw'=>'__') ?><?php $attr12_class='text' ?><?php $attr12_raw='__' ?><?php
	if	( isset($attr12_prefix)&& isset($attr12_key))
		$attr12_key = $attr12_prefix.$attr12_key;
	if	( isset($attr12_suffix)&& isset($attr12_key))
		$attr12_key = $attr12_key.$attr12_suffix;
		
	if(empty($attr12_title))
		if (!empty($attr12_key))
			$attr12_title = lang($attr12_key.'_HELP');
		else
			$attr12_title = '';

?><span class="<?php echo $attr12_class ?>" title="<?php echo $attr12_title ?>"><?php
	$attr12_title = '';

	if (!empty($attr12_array))
	{
		//geht nicht:
		//echo $$attr12_array[$attr12_var].'%';
		$tmpArray = $$attr12_array;
		if (!empty($attr12_var))
			$tmp_text = $tmpArray[$attr12_var];
		else
			$tmp_text = lang($tmpArray[$attr12_text]);
	}
	elseif (!empty($attr12_text))
		if	( isset($$attr12_text))
			$tmp_text = lang($$attr12_text);
		else
			$tmp_text = lang($attr12_text);
	elseif (!empty($attr12_textvar))
		$tmp_text = lang($$attr12_textvar);
	elseif (!empty($attr12_key))
		$tmp_text = lang($attr12_key);
	elseif (!empty($attr12_var))
		$tmp_text = isset($$attr12_var)?htmlentities($$attr12_var):'error: variable '.$attr12_var.' not present';	
	elseif (!empty($attr12_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr12_raw);
	elseif (!empty($attr12_value))
		$tmp_text = $attr12_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr12);echo 'text error';
	}
	
	if	( !empty($attr12_maxlength) && intval($attr12_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr12_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr12) ?><?php unset($attr12_class) ?><?php unset($attr12_raw) ?><?php $attr12 = array('class'=>'text','text'=>$nr) ?><?php $attr12_class='text' ?><?php $attr12_text=$nr ?><?php
	if	( isset($attr12_prefix)&& isset($attr12_key))
		$attr12_key = $attr12_prefix.$attr12_key;
	if	( isset($attr12_suffix)&& isset($attr12_key))
		$attr12_key = $attr12_key.$attr12_suffix;
		
	if(empty($attr12_title))
		if (!empty($attr12_key))
			$attr12_title = lang($attr12_key.'_HELP');
		else
			$attr12_title = '';

?><span class="<?php echo $attr12_class ?>" title="<?php echo $attr12_title ?>"><?php
	$attr12_title = '';

	if (!empty($attr12_array))
	{
		//geht nicht:
		//echo $$attr12_array[$attr12_var].'%';
		$tmpArray = $$attr12_array;
		if (!empty($attr12_var))
			$tmp_text = $tmpArray[$attr12_var];
		else
			$tmp_text = lang($tmpArray[$attr12_text]);
	}
	elseif (!empty($attr12_text))
		if	( isset($$attr12_text))
			$tmp_text = lang($$attr12_text);
		else
			$tmp_text = lang($attr12_text);
	elseif (!empty($attr12_textvar))
		$tmp_text = lang($$attr12_textvar);
	elseif (!empty($attr12_key))
		$tmp_text = lang($attr12_key);
	elseif (!empty($attr12_var))
		$tmp_text = isset($$attr12_var)?htmlentities($$attr12_var):'error: variable '.$attr12_var.' not present';	
	elseif (!empty($attr12_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr12_raw);
	elseif (!empty($attr12_value))
		$tmp_text = $attr12_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr12);echo 'text error';
	}
	
	if	( !empty($attr12_maxlength) && intval($attr12_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr12_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr12) ?><?php unset($attr12_class) ?><?php unset($attr12_text) ?><?php $attr12 = array('class'=>'text','raw'=>'__') ?><?php $attr12_class='text' ?><?php $attr12_raw='__' ?><?php
	if	( isset($attr12_prefix)&& isset($attr12_key))
		$attr12_key = $attr12_prefix.$attr12_key;
	if	( isset($attr12_suffix)&& isset($attr12_key))
		$attr12_key = $attr12_key.$attr12_suffix;
		
	if(empty($attr12_title))
		if (!empty($attr12_key))
			$attr12_title = lang($attr12_key.'_HELP');
		else
			$attr12_title = '';

?><span class="<?php echo $attr12_class ?>" title="<?php echo $attr12_title ?>"><?php
	$attr12_title = '';

	if (!empty($attr12_array))
	{
		//geht nicht:
		//echo $$attr12_array[$attr12_var].'%';
		$tmpArray = $$attr12_array;
		if (!empty($attr12_var))
			$tmp_text = $tmpArray[$attr12_var];
		else
			$tmp_text = lang($tmpArray[$attr12_text]);
	}
	elseif (!empty($attr12_text))
		if	( isset($$attr12_text))
			$tmp_text = lang($$attr12_text);
		else
			$tmp_text = lang($attr12_text);
	elseif (!empty($attr12_textvar))
		$tmp_text = lang($$attr12_textvar);
	elseif (!empty($attr12_key))
		$tmp_text = lang($attr12_key);
	elseif (!empty($attr12_var))
		$tmp_text = isset($$attr12_var)?htmlentities($$attr12_var):'error: variable '.$attr12_var.' not present';	
	elseif (!empty($attr12_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr12_raw);
	elseif (!empty($attr12_value))
		$tmp_text = $attr12_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr12);echo 'text error';
	}
	
	if	( !empty($attr12_maxlength) && intval($attr12_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr12_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr12) ?><?php unset($attr12_class) ?><?php unset($attr12_raw) ?><?php $attr10 = array() ?></a><?php unset($attr10) ?><?php $attr9 = array() ?><?php
	}
	
?><?php unset($attr9) ?><?php $attr10 = array('true'=>$today) ?><?php $attr10_true=$today ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr10);
	
	if	( isset($attr10_true) )
	{
		if	(gettype($attr10_true) === '' && gettype($attr10_true) === '1')
			$exec = $$attr10_true == true;
		else
			$exec = $attr10_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr10_false) )
	{
		if	(gettype($attr10_false) === '' && gettype($attr10_false) === '1')
			$exec = $$attr10_false == false;
		else
			$exec = $attr10_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr10_contains) )
		$exec = in_array($attr10_value,explode(',',$attr10_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr10_equals)&& isset($attr10_value) )
		$exec = $attr10_equals == $attr10_value;

	// Vergleich auf leer
	elseif	( isset($attr10_empty) )
	{
		if	( !isset($$attr10_empty) )
			$exec = empty($attr10_empty);
		elseif	( is_array($$attr10_empty) )
			$exec = (count($$attr10_empty)==0);
		elseif	( is_bool($$attr10_empty) )
			$exec = true;
		else
			$exec = empty( $$attr10_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr10_present) )
	{
		$exec = isset($$attr10_present);
//		if	( !isset($$attr10_present) )
//			$exec = false;
//		elseif	( is_array($$attr10_present) )
//			$exec = (count($$attr10_present)>0);
//		elseif	( is_bool($$attr10_present) )
//			$exec = $$attr10_present;
//		elseif	( is_numeric($$attr10_present) )
//			$exec = $$attr10_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr10 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr10_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr10_not) )
		$exec = !$exec;

	unset($attr10_true);
	unset($attr10_false);
	unset($attr10_notempty);
	unset($attr10_empty);
	unset($attr10_contains);
	unset($attr10_present);
	unset($attr10_invert);
	unset($attr10_not);
	unset($attr10_value);
	unset($attr10_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr10) ?><?php unset($attr10_true) ?><?php $attr11 = array('class'=>'text','raw'=>'*') ?><?php $attr11_class='text' ?><?php $attr11_raw='*' ?><?php
	if	( isset($attr11_prefix)&& isset($attr11_key))
		$attr11_key = $attr11_prefix.$attr11_key;
	if	( isset($attr11_suffix)&& isset($attr11_key))
		$attr11_key = $attr11_key.$attr11_suffix;
		
	if(empty($attr11_title))
		if (!empty($attr11_key))
			$attr11_title = lang($attr11_key.'_HELP');
		else
			$attr11_title = '';

?><span class="<?php echo $attr11_class ?>" title="<?php echo $attr11_title ?>"><?php
	$attr11_title = '';

	if (!empty($attr11_array))
	{
		//geht nicht:
		//echo $$attr11_array[$attr11_var].'%';
		$tmpArray = $$attr11_array;
		if (!empty($attr11_var))
			$tmp_text = $tmpArray[$attr11_var];
		else
			$tmp_text = lang($tmpArray[$attr11_text]);
	}
	elseif (!empty($attr11_text))
		if	( isset($$attr11_text))
			$tmp_text = lang($$attr11_text);
		else
			$tmp_text = lang($attr11_text);
	elseif (!empty($attr11_textvar))
		$tmp_text = lang($$attr11_textvar);
	elseif (!empty($attr11_key))
		$tmp_text = lang($attr11_key);
	elseif (!empty($attr11_var))
		$tmp_text = isset($$attr11_var)?htmlentities($$attr11_var):'error: variable '.$attr11_var.' not present';	
	elseif (!empty($attr11_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr11_raw);
	elseif (!empty($attr11_value))
		$tmp_text = $attr11_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr11);echo 'text error';
	}
	
	if	( !empty($attr11_maxlength) && intval($attr11_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr11_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr11) ?><?php unset($attr11_class) ?><?php unset($attr11_raw) ?><?php $attr9 = array() ?><?php
	}
	
?><?php unset($attr9) ?><?php $attr8 = array() ?></td><?php unset($attr8) ?><?php $attr7 = array() ?><?php } ?><?php unset($attr7) ?><?php $attr6 = array() ?></tr><?php unset($attr6) ?><?php $attr5 = array() ?><?php } ?><?php unset($attr5) ?><?php $attr6 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr6_class))
		$attr6_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr6_class ?>"><?php unset($attr6) ?><?php $attr7 = array('class'=>'fx','colspan'=>'2') ?><?php $attr7_class='fx' ?><?php $attr7_colspan='2' ?><?php
//	if (empty($attr7_class))
//		$attr7['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_colspan) ?><?php $attr8 = array('class'=>'text','text'=>lang('date')) ?><?php $attr8_class='text' ?><?php $attr8_text=lang('date') ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
		
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';

?><span class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';

	if (!empty($attr8_array))
	{
		//geht nicht:
		//echo $$attr8_array[$attr8_var].'%';
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = lang($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		if	( isset($$attr8_text))
			$tmp_text = lang($$attr8_text);
		else
			$tmp_text = lang($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = lang($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = lang($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?htmlentities($$attr8_var):'error: variable '.$attr8_var.' not present';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr8);echo 'text error';
	}
	
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_text) ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr7 = array('class'=>'fx','colspan'=>'5') ?><?php $attr7_class='fx' ?><?php $attr7_colspan='5' ?><?php
//	if (empty($attr7_class))
//		$attr7['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_colspan) ?><?php $attr8 = array('list'=>'all_years','name'=>'year') ?><?php $attr8_list='all_years' ?><?php $attr8_name='year' ?><select size="1" id="id_<?php echo $attr8_name ?>"  name="<?php echo $attr8_name ?>" onchange="<?php echo $attr8_onchange ?>" title="<?php echo $attr8_title ?>" class="<?php echo $attr8_class ?>"<?php
if (count($$attr8_list)==1) echo ' disabled="disabled"'
?>><?php
		foreach( $$attr8_list as $box_key=>$box_value )
		{
			echo '<option class="'.$attr8_class.'" value="'.$box_key.'"';
			if (isset($$attr8_name)&&$box_key==$$attr8_name || isset($attr8_default)&&$box_key == $attr8_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr8_list)==1) echo '<input type="hidden" name="'.$attr8_name.'" value="'.$box_key.'" />'
?><?php unset($attr8) ?><?php unset($attr8_list) ?><?php unset($attr8_name) ?><?php $attr8 = array('class'=>'text','raw'=>'_-_') ?><?php $attr8_class='text' ?><?php $attr8_raw='_-_' ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
		
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';

?><span class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';

	if (!empty($attr8_array))
	{
		//geht nicht:
		//echo $$attr8_array[$attr8_var].'%';
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = lang($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		if	( isset($$attr8_text))
			$tmp_text = lang($$attr8_text);
		else
			$tmp_text = lang($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = lang($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = lang($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?htmlentities($$attr8_var):'error: variable '.$attr8_var.' not present';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr8);echo 'text error';
	}
	
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php $attr8 = array('list'=>'all_months','name'=>'month') ?><?php $attr8_list='all_months' ?><?php $attr8_name='month' ?><select size="1" id="id_<?php echo $attr8_name ?>"  name="<?php echo $attr8_name ?>" onchange="<?php echo $attr8_onchange ?>" title="<?php echo $attr8_title ?>" class="<?php echo $attr8_class ?>"<?php
if (count($$attr8_list)==1) echo ' disabled="disabled"'
?>><?php
		foreach( $$attr8_list as $box_key=>$box_value )
		{
			echo '<option class="'.$attr8_class.'" value="'.$box_key.'"';
			if (isset($$attr8_name)&&$box_key==$$attr8_name || isset($attr8_default)&&$box_key == $attr8_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr8_list)==1) echo '<input type="hidden" name="'.$attr8_name.'" value="'.$box_key.'" />'
?><?php unset($attr8) ?><?php unset($attr8_list) ?><?php unset($attr8_name) ?><?php $attr8 = array('class'=>'text','raw'=>'_-_') ?><?php $attr8_class='text' ?><?php $attr8_raw='_-_' ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
		
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';

?><span class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';

	if (!empty($attr8_array))
	{
		//geht nicht:
		//echo $$attr8_array[$attr8_var].'%';
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = lang($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		if	( isset($$attr8_text))
			$tmp_text = lang($$attr8_text);
		else
			$tmp_text = lang($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = lang($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = lang($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?htmlentities($$attr8_var):'error: variable '.$attr8_var.' not present';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr8);echo 'text error';
	}
	
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php $attr8 = array('list'=>'all_days','name'=>'day') ?><?php $attr8_list='all_days' ?><?php $attr8_name='day' ?><select size="1" id="id_<?php echo $attr8_name ?>"  name="<?php echo $attr8_name ?>" onchange="<?php echo $attr8_onchange ?>" title="<?php echo $attr8_title ?>" class="<?php echo $attr8_class ?>"<?php
if (count($$attr8_list)==1) echo ' disabled="disabled"'
?>><?php
		foreach( $$attr8_list as $box_key=>$box_value )
		{
			echo '<option class="'.$attr8_class.'" value="'.$box_key.'"';
			if (isset($$attr8_name)&&$box_key==$$attr8_name || isset($attr8_default)&&$box_key == $attr8_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr8_list)==1) echo '<input type="hidden" name="'.$attr8_name.'" value="'.$box_key.'" />'
?><?php unset($attr8) ?><?php unset($attr8_list) ?><?php unset($attr8_name) ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr6 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr6_class))
		$attr6_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr6_class ?>"><?php unset($attr6) ?><?php $attr7 = array('class'=>'fx','colspan'=>'2') ?><?php $attr7_class='fx' ?><?php $attr7_colspan='2' ?><?php
//	if (empty($attr7_class))
//		$attr7['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_colspan) ?><?php $attr8 = array('class'=>'text','text'=>lang('date_time')) ?><?php $attr8_class='text' ?><?php $attr8_text=lang('date_time') ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
		
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';

?><span class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';

	if (!empty($attr8_array))
	{
		//geht nicht:
		//echo $$attr8_array[$attr8_var].'%';
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = lang($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		if	( isset($$attr8_text))
			$tmp_text = lang($$attr8_text);
		else
			$tmp_text = lang($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = lang($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = lang($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?htmlentities($$attr8_var):'error: variable '.$attr8_var.' not present';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr8);echo 'text error';
	}
	
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_text) ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr7 = array('class'=>'fx','colspan'=>'5') ?><?php $attr7_class='fx' ?><?php $attr7_colspan='5' ?><?php
//	if (empty($attr7_class))
//		$attr7['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr7_class))
		$attr7['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr7_rowspan) )
		$attr7['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_colspan) ?><?php $attr8 = array('list'=>'all_hours','name'=>'hour') ?><?php $attr8_list='all_hours' ?><?php $attr8_name='hour' ?><select size="1" id="id_<?php echo $attr8_name ?>"  name="<?php echo $attr8_name ?>" onchange="<?php echo $attr8_onchange ?>" title="<?php echo $attr8_title ?>" class="<?php echo $attr8_class ?>"<?php
if (count($$attr8_list)==1) echo ' disabled="disabled"'
?>><?php
		foreach( $$attr8_list as $box_key=>$box_value )
		{
			echo '<option class="'.$attr8_class.'" value="'.$box_key.'"';
			if (isset($$attr8_name)&&$box_key==$$attr8_name || isset($attr8_default)&&$box_key == $attr8_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr8_list)==1) echo '<input type="hidden" name="'.$attr8_name.'" value="'.$box_key.'" />'
?><?php unset($attr8) ?><?php unset($attr8_list) ?><?php unset($attr8_name) ?><?php $attr8 = array('class'=>'text','raw'=>'_-_') ?><?php $attr8_class='text' ?><?php $attr8_raw='_-_' ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
		
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';

?><span class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';

	if (!empty($attr8_array))
	{
		//geht nicht:
		//echo $$attr8_array[$attr8_var].'%';
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = lang($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		if	( isset($$attr8_text))
			$tmp_text = lang($$attr8_text);
		else
			$tmp_text = lang($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = lang($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = lang($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?htmlentities($$attr8_var):'error: variable '.$attr8_var.' not present';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr8);echo 'text error';
	}
	
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php $attr8 = array('list'=>'all_minutes','name'=>'minute') ?><?php $attr8_list='all_minutes' ?><?php $attr8_name='minute' ?><select size="1" id="id_<?php echo $attr8_name ?>"  name="<?php echo $attr8_name ?>" onchange="<?php echo $attr8_onchange ?>" title="<?php echo $attr8_title ?>" class="<?php echo $attr8_class ?>"<?php
if (count($$attr8_list)==1) echo ' disabled="disabled"'
?>><?php
		foreach( $$attr8_list as $box_key=>$box_value )
		{
			echo '<option class="'.$attr8_class.'" value="'.$box_key.'"';
			if (isset($$attr8_name)&&$box_key==$$attr8_name || isset($attr8_default)&&$box_key == $attr8_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr8_list)==1) echo '<input type="hidden" name="'.$attr8_name.'" value="'.$box_key.'" />'
?><?php unset($attr8) ?><?php unset($attr8_list) ?><?php unset($attr8_name) ?><?php $attr8 = array('class'=>'text','raw'=>'_-_') ?><?php $attr8_class='text' ?><?php $attr8_raw='_-_' ?><?php
	if	( isset($attr8_prefix)&& isset($attr8_key))
		$attr8_key = $attr8_prefix.$attr8_key;
	if	( isset($attr8_suffix)&& isset($attr8_key))
		$attr8_key = $attr8_key.$attr8_suffix;
		
	if(empty($attr8_title))
		if (!empty($attr8_key))
			$attr8_title = lang($attr8_key.'_HELP');
		else
			$attr8_title = '';

?><span class="<?php echo $attr8_class ?>" title="<?php echo $attr8_title ?>"><?php
	$attr8_title = '';

	if (!empty($attr8_array))
	{
		//geht nicht:
		//echo $$attr8_array[$attr8_var].'%';
		$tmpArray = $$attr8_array;
		if (!empty($attr8_var))
			$tmp_text = $tmpArray[$attr8_var];
		else
			$tmp_text = lang($tmpArray[$attr8_text]);
	}
	elseif (!empty($attr8_text))
		if	( isset($$attr8_text))
			$tmp_text = lang($$attr8_text);
		else
			$tmp_text = lang($attr8_text);
	elseif (!empty($attr8_textvar))
		$tmp_text = lang($$attr8_textvar);
	elseif (!empty($attr8_key))
		$tmp_text = lang($attr8_key);
	elseif (!empty($attr8_var))
		$tmp_text = isset($$attr8_var)?htmlentities($$attr8_var):'error: variable '.$attr8_var.' not present';	
	elseif (!empty($attr8_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr8_raw);
	elseif (!empty($attr8_value))
		$tmp_text = $attr8_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr8);echo 'text error';
	}
	
	if	( !empty($attr8_maxlength) && intval($attr8_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr8_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php $attr8 = array('list'=>'all_seconds','name'=>'second') ?><?php $attr8_list='all_seconds' ?><?php $attr8_name='second' ?><select size="1" id="id_<?php echo $attr8_name ?>"  name="<?php echo $attr8_name ?>" onchange="<?php echo $attr8_onchange ?>" title="<?php echo $attr8_title ?>" class="<?php echo $attr8_class ?>"<?php
if (count($$attr8_list)==1) echo ' disabled="disabled"'
?>><?php
		foreach( $$attr8_list as $box_key=>$box_value )
		{
			echo '<option class="'.$attr8_class.'" value="'.$box_key.'"';
			if (isset($$attr8_name)&&$box_key==$$attr8_name || isset($attr8_default)&&$box_key == $attr8_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr8_list)==1) echo '<input type="hidden" name="'.$attr8_name.'" value="'.$box_key.'" />'
?><?php unset($attr8) ?><?php unset($attr8_list) ?><?php unset($attr8_name) ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr4 = array() ?></table><?php unset($attr4) ?><?php $attr3 = array() ?><?php
	}
	
?><?php unset($attr3) ?><?php $attr4 = array('equals'=>'text','value'=>$type) ?><?php $attr4_equals='text' ?><?php $attr4_value=$type ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr4);
	
	if	( isset($attr4_true) )
	{
		if	(gettype($attr4_true) === '' && gettype($attr4_true) === '1')
			$exec = $$attr4_true == true;
		else
			$exec = $attr4_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr4_false) )
	{
		if	(gettype($attr4_false) === '' && gettype($attr4_false) === '1')
			$exec = $$attr4_false == false;
		else
			$exec = $attr4_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr4_contains) )
		$exec = in_array($attr4_value,explode(',',$attr4_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr4_equals)&& isset($attr4_value) )
		$exec = $attr4_equals == $attr4_value;

	// Vergleich auf leer
	elseif	( isset($attr4_empty) )
	{
		if	( !isset($$attr4_empty) )
			$exec = empty($attr4_empty);
		elseif	( is_array($$attr4_empty) )
			$exec = (count($$attr4_empty)==0);
		elseif	( is_bool($$attr4_empty) )
			$exec = true;
		else
			$exec = empty( $$attr4_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr4_present) )
	{
		$exec = isset($$attr4_present);
//		if	( !isset($$attr4_present) )
//			$exec = false;
//		elseif	( is_array($$attr4_present) )
//			$exec = (count($$attr4_present)>0);
//		elseif	( is_bool($$attr4_present) )
//			$exec = $$attr4_present;
//		elseif	( is_numeric($$attr4_present) )
//			$exec = $$attr4_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr4 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr4_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr4_not) )
		$exec = !$exec;

	unset($attr4_true);
	unset($attr4_false);
	unset($attr4_notempty);
	unset($attr4_empty);
	unset($attr4_contains);
	unset($attr4_present);
	unset($attr4_invert);
	unset($attr4_not);
	unset($attr4_value);
	unset($attr4_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr4) ?><?php unset($attr4_equals) ?><?php unset($attr4_value) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('class'=>'fx','colspan'=>'2') ?><?php $attr6_class='fx' ?><?php $attr6_colspan='2' ?><?php
//	if (empty($attr6_class))
//		$attr6['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('class'=>'text','type'=>'text','name'=>'text','size'=>'50','maxlength'=>'255') ?><?php $attr7_class='text' ?><?php $attr7_type='text' ?><?php $attr7_name='text' ?><?php $attr7_size='50' ?><?php $attr7_maxlength='255' ?><input id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" onxxxMouseOver="this.focus();"  /><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php $attr7 = array('field'=>'text') ?><?php $attr7_field='text' ?>
<script name="JavaScript" type="text/javascript">
<!--
document.forms[0].<?php echo $attr7_field ?>.focus();
document.forms[0].<?php echo $attr7_field ?>.select();
// -->
</script>
<?php unset($attr7) ?><?php unset($attr7_field) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3 = array() ?><?php
	}
	
?><?php unset($attr3) ?><?php $attr4 = array('equals'=>'longtext','value'=>$type) ?><?php $attr4_equals='longtext' ?><?php $attr4_value=$type ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr4);
	
	if	( isset($attr4_true) )
	{
		if	(gettype($attr4_true) === '' && gettype($attr4_true) === '1')
			$exec = $$attr4_true == true;
		else
			$exec = $attr4_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr4_false) )
	{
		if	(gettype($attr4_false) === '' && gettype($attr4_false) === '1')
			$exec = $$attr4_false == false;
		else
			$exec = $attr4_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr4_contains) )
		$exec = in_array($attr4_value,explode(',',$attr4_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr4_equals)&& isset($attr4_value) )
		$exec = $attr4_equals == $attr4_value;

	// Vergleich auf leer
	elseif	( isset($attr4_empty) )
	{
		if	( !isset($$attr4_empty) )
			$exec = empty($attr4_empty);
		elseif	( is_array($$attr4_empty) )
			$exec = (count($$attr4_empty)==0);
		elseif	( is_bool($$attr4_empty) )
			$exec = true;
		else
			$exec = empty( $$attr4_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr4_present) )
	{
		$exec = isset($$attr4_present);
//		if	( !isset($$attr4_present) )
//			$exec = false;
//		elseif	( is_array($$attr4_present) )
//			$exec = (count($$attr4_present)>0);
//		elseif	( is_bool($$attr4_present) )
//			$exec = $$attr4_present;
//		elseif	( is_numeric($$attr4_present) )
//			$exec = $$attr4_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr4 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr4_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr4_not) )
		$exec = !$exec;

	unset($attr4_true);
	unset($attr4_false);
	unset($attr4_notempty);
	unset($attr4_empty);
	unset($attr4_contains);
	unset($attr4_present);
	unset($attr4_invert);
	unset($attr4_not);
	unset($attr4_value);
	unset($attr4_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr4) ?><?php unset($attr4_equals) ?><?php unset($attr4_value) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('class'=>'fx','colspan'=>'2') ?><?php $attr6_class='fx' ?><?php $attr6_colspan='2' ?><?php
//	if (empty($attr6_class))
//		$attr6['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('equals'=>'html','value'=>$editor) ?><?php $attr7_equals='html' ?><?php $attr7_value=$editor ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr7);
	
	if	( isset($attr7_true) )
	{
		if	(gettype($attr7_true) === '' && gettype($attr7_true) === '1')
			$exec = $$attr7_true == true;
		else
			$exec = $attr7_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr7_false) )
	{
		if	(gettype($attr7_false) === '' && gettype($attr7_false) === '1')
			$exec = $$attr7_false == false;
		else
			$exec = $attr7_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr7_contains) )
		$exec = in_array($attr7_value,explode(',',$attr7_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr7_equals)&& isset($attr7_value) )
		$exec = $attr7_equals == $attr7_value;

	// Vergleich auf leer
	elseif	( isset($attr7_empty) )
	{
		if	( !isset($$attr7_empty) )
			$exec = empty($attr7_empty);
		elseif	( is_array($$attr7_empty) )
			$exec = (count($$attr7_empty)==0);
		elseif	( is_bool($$attr7_empty) )
			$exec = true;
		else
			$exec = empty( $$attr7_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr7_present) )
	{
		$exec = isset($$attr7_present);
//		if	( !isset($$attr7_present) )
//			$exec = false;
//		elseif	( is_array($$attr7_present) )
//			$exec = (count($$attr7_present)>0);
//		elseif	( is_bool($$attr7_present) )
//			$exec = $$attr7_present;
//		elseif	( is_numeric($$attr7_present) )
//			$exec = $$attr7_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr7 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr7_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr7_not) )
		$exec = !$exec;

	unset($attr7_true);
	unset($attr7_false);
	unset($attr7_notempty);
	unset($attr7_empty);
	unset($attr7_contains);
	unset($attr7_present);
	unset($attr7_invert);
	unset($attr7_not);
	unset($attr7_value);
	unset($attr7_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr7) ?><?php unset($attr7_equals) ?><?php unset($attr7_value) ?><?php $attr8 = array('name'=>'text','type'=>'html') ?><?php $attr8_name='text' ?><?php $attr8_type='html' ?><?php

if	($attr8_type=='fckeditor' || $attr8_type=='html')
{
	include('./editor/fckeditor.php');
	$editor = new FCKeditor( $attr8_name ) ;
	$editor->BasePath	= './editor/';
	$editor->Value = $$attr8_name;
	$editor->Height = '290';
	$editor->Config['CustomConfigurationsPath'] = '../openrat-fckconfig.js';
	$editor->Create();
}
elseif	($attr8_type=='wiki')
{
	?>
<script name="Javascript" type="text/javascript" src="<?php echo $tpl_dir ?>../js/editor.js"></script>
<script name="JavaScript" type="text/javascript">
<!--

function strong()
{
	insert('text','*','*');
}


function emphatic()
{
	insert('text','_','_');
}


function link()
{
	insert('text','"','"->"'+document.forms[0].objectid.value+'"');
}


function image()
{
	insert('text','','{"'+document.forms[0].objectid.value+'"}');
}


function list()
{
	insert('text',"\n\n- ","\n- \n- \n");
}


function numlist()
{
	insert('text',"\n\n# ","\n# \n# \n");
}


function table()
{
	insert('text',"\n|","| |\n| | |\n");
}


//-->
-->
</script>
	<?php
		global $image_dir,$objects;
		?>
<tr>
  <td colspan="2" class="f1">
    <table>
      <tr>
        <noscript><input type="text" name="addtext" size="10" /></noscript>
        <td><noscript><?php echo Html::Checkbox('strong') ?></noscript><a href="javascript:strong();" title="<?php echo lang('PAGE_EDITOR_ADD_STRONG') ?>"><img src="<?php echo $image_dir ?>/editor/bold.png" border"0"   /></a></td>
        <td><noscript><?php echo Html::Checkbox('emphatic') ?></noscript><a href="javascript:emphatic();" title="<?php echo lang('PAGE_EDITOR_ADD_EMPHATIC') ?>"><img src="<?php echo $image_dir ?>/editor/italic.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><noscript><?php echo Html::Checkbox('table') ?></noscript><a href="javascript:table();" title="<?php echo lang('PAGE_EDITOR_ADD_TABLE') ?>"><img src="<?php echo $image_dir ?>/editor/table.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><noscript><?php echo Html::Checkbox('list') ?></noscript><a href="javascript:list();" title="<?php echo lang('PAGE_EDITOR_ADD_LIST') ?>"><img src="<?php echo $image_dir ?>/editor/list.png" border"0" /></a></td>
        <td><noscript><?php echo Html::Checkbox('numlist') ?></noscript><a href="javascript:numlist();" title="<?php echo lang('PAGE_EDITOR_ADD_NUMLIST') ?>"><img src="<?php echo $image_dir ?>/editor/numlist.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><noscript><?php echo Html::Checkbox('image') ?></noscript><a href="javascript:image();" title="<?php echo lang('PAGE_EDITOR_ADD_IMAGE') ?>"><img src="<?php echo $image_dir ?>/editor/image.png" border"0" /></a></td>
        <td><noscript><?php echo Html::Checkbox('link') ?></noscript><a href="javascript:link();" title="<?php echo lang('PAGE_EDITOR_ADD_LINK') ?>"><img src="<?php echo $image_dir ?>/editor/link.png" border"0" /></a></td>
        <td><?php echo Html::selectBox('objectid',$objects) ?><noscript>&nbsp;&nbsp;&nbsp;<input type="submit" class="submit" name="addmarkup" value="<?php echo lang('GLOBAL_ADD') ?>"/></noscript></td>
      </tr>
    </table>
  </td>
</tr>
<?php
	echo '<textarea name="'.$attr8_name.'" class="editor">'.$$attr8_name.'</textarea>';
}
elseif	($attr8_type=='text' || $attr8_type=='raw')
{
	echo '<textarea name="'.$attr8_name.'" class="editor">'.$$attr8_name.'</textarea>';
}
else
{
	echo "Unknown editor type: ".$attr8_type;
}
?>
<?php unset($attr8) ?><?php unset($attr8_name) ?><?php unset($attr8_type) ?><?php $attr6 = array() ?><?php
	}
	
?><?php unset($attr6) ?><?php $attr7 = array('equals'=>'wiki','value'=>$editor) ?><?php $attr7_equals='wiki' ?><?php $attr7_value=$editor ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr7);
	
	if	( isset($attr7_true) )
	{
		if	(gettype($attr7_true) === '' && gettype($attr7_true) === '1')
			$exec = $$attr7_true == true;
		else
			$exec = $attr7_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr7_false) )
	{
		if	(gettype($attr7_false) === '' && gettype($attr7_false) === '1')
			$exec = $$attr7_false == false;
		else
			$exec = $attr7_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr7_contains) )
		$exec = in_array($attr7_value,explode(',',$attr7_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr7_equals)&& isset($attr7_value) )
		$exec = $attr7_equals == $attr7_value;

	// Vergleich auf leer
	elseif	( isset($attr7_empty) )
	{
		if	( !isset($$attr7_empty) )
			$exec = empty($attr7_empty);
		elseif	( is_array($$attr7_empty) )
			$exec = (count($$attr7_empty)==0);
		elseif	( is_bool($$attr7_empty) )
			$exec = true;
		else
			$exec = empty( $$attr7_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr7_present) )
	{
		$exec = isset($$attr7_present);
//		if	( !isset($$attr7_present) )
//			$exec = false;
//		elseif	( is_array($$attr7_present) )
//			$exec = (count($$attr7_present)>0);
//		elseif	( is_bool($$attr7_present) )
//			$exec = $$attr7_present;
//		elseif	( is_numeric($$attr7_present) )
//			$exec = $$attr7_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr7 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr7_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr7_not) )
		$exec = !$exec;

	unset($attr7_true);
	unset($attr7_false);
	unset($attr7_notempty);
	unset($attr7_empty);
	unset($attr7_contains);
	unset($attr7_present);
	unset($attr7_invert);
	unset($attr7_not);
	unset($attr7_value);
	unset($attr7_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr7) ?><?php unset($attr7_equals) ?><?php unset($attr7_value) ?><?php $attr8 = array('present'=>'preview_text') ?><?php $attr8_present='preview_text' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr8);
	
	if	( isset($attr8_true) )
	{
		if	(gettype($attr8_true) === '' && gettype($attr8_true) === '1')
			$exec = $$attr8_true == true;
		else
			$exec = $attr8_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr8_false) )
	{
		if	(gettype($attr8_false) === '' && gettype($attr8_false) === '1')
			$exec = $$attr8_false == false;
		else
			$exec = $attr8_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr8_contains) )
		$exec = in_array($attr8_value,explode(',',$attr8_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr8_equals)&& isset($attr8_value) )
		$exec = $attr8_equals == $attr8_value;

	// Vergleich auf leer
	elseif	( isset($attr8_empty) )
	{
		if	( !isset($$attr8_empty) )
			$exec = empty($attr8_empty);
		elseif	( is_array($$attr8_empty) )
			$exec = (count($$attr8_empty)==0);
		elseif	( is_bool($$attr8_empty) )
			$exec = true;
		else
			$exec = empty( $$attr8_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr8_present) )
	{
		$exec = isset($$attr8_present);
//		if	( !isset($$attr8_present) )
//			$exec = false;
//		elseif	( is_array($$attr8_present) )
//			$exec = (count($$attr8_present)>0);
//		elseif	( is_bool($$attr8_present) )
//			$exec = $$attr8_present;
//		elseif	( is_numeric($$attr8_present) )
//			$exec = $$attr8_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr8 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr8_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr8_not) )
		$exec = !$exec;

	unset($attr8_true);
	unset($attr8_false);
	unset($attr8_notempty);
	unset($attr8_empty);
	unset($attr8_contains);
	unset($attr8_present);
	unset($attr8_invert);
	unset($attr8_not);
	unset($attr8_value);
	unset($attr8_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr8) ?><?php unset($attr8_present) ?><?php $attr9 = array('class'=>'text','var'=>'preview_text') ?><?php $attr9_class='text' ?><?php $attr9_var='preview_text' ?><?php
	if	( isset($attr9_prefix)&& isset($attr9_key))
		$attr9_key = $attr9_prefix.$attr9_key;
	if	( isset($attr9_suffix)&& isset($attr9_key))
		$attr9_key = $attr9_key.$attr9_suffix;
		
	if(empty($attr9_title))
		if (!empty($attr9_key))
			$attr9_title = lang($attr9_key.'_HELP');
		else
			$attr9_title = '';

?><span class="<?php echo $attr9_class ?>" title="<?php echo $attr9_title ?>"><?php
	$attr9_title = '';

	if (!empty($attr9_array))
	{
		//geht nicht:
		//echo $$attr9_array[$attr9_var].'%';
		$tmpArray = $$attr9_array;
		if (!empty($attr9_var))
			$tmp_text = $tmpArray[$attr9_var];
		else
			$tmp_text = lang($tmpArray[$attr9_text]);
	}
	elseif (!empty($attr9_text))
		if	( isset($$attr9_text))
			$tmp_text = lang($$attr9_text);
		else
			$tmp_text = lang($attr9_text);
	elseif (!empty($attr9_textvar))
		$tmp_text = lang($$attr9_textvar);
	elseif (!empty($attr9_key))
		$tmp_text = lang($attr9_key);
	elseif (!empty($attr9_var))
		$tmp_text = isset($$attr9_var)?htmlentities($$attr9_var):'error: variable '.$attr9_var.' not present';	
	elseif (!empty($attr9_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr9_raw);
	elseif (!empty($attr9_value))
		$tmp_text = $attr9_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr9);echo 'text error';
	}
	
	if	( !empty($attr9_maxlength) && intval($attr9_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr9_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_var) ?><?php $attr9 = array() ?><br/><?php unset($attr9) ?><?php $attr7 = array() ?><?php
	}
	
?><?php unset($attr7) ?><?php $attr8 = array('name'=>'text','type'=>'wiki') ?><?php $attr8_name='text' ?><?php $attr8_type='wiki' ?><?php

if	($attr8_type=='fckeditor' || $attr8_type=='html')
{
	include('./editor/fckeditor.php');
	$editor = new FCKeditor( $attr8_name ) ;
	$editor->BasePath	= './editor/';
	$editor->Value = $$attr8_name;
	$editor->Height = '290';
	$editor->Config['CustomConfigurationsPath'] = '../openrat-fckconfig.js';
	$editor->Create();
}
elseif	($attr8_type=='wiki')
{
	?>
<script name="Javascript" type="text/javascript" src="<?php echo $tpl_dir ?>../js/editor.js"></script>
<script name="JavaScript" type="text/javascript">
<!--

function strong()
{
	insert('text','*','*');
}


function emphatic()
{
	insert('text','_','_');
}


function link()
{
	insert('text','"','"->"'+document.forms[0].objectid.value+'"');
}


function image()
{
	insert('text','','{"'+document.forms[0].objectid.value+'"}');
}


function list()
{
	insert('text',"\n\n- ","\n- \n- \n");
}


function numlist()
{
	insert('text',"\n\n# ","\n# \n# \n");
}


function table()
{
	insert('text',"\n|","| |\n| | |\n");
}


//-->
-->
</script>
	<?php
		global $image_dir,$objects;
		?>
<tr>
  <td colspan="2" class="f1">
    <table>
      <tr>
        <noscript><input type="text" name="addtext" size="10" /></noscript>
        <td><noscript><?php echo Html::Checkbox('strong') ?></noscript><a href="javascript:strong();" title="<?php echo lang('PAGE_EDITOR_ADD_STRONG') ?>"><img src="<?php echo $image_dir ?>/editor/bold.png" border"0"   /></a></td>
        <td><noscript><?php echo Html::Checkbox('emphatic') ?></noscript><a href="javascript:emphatic();" title="<?php echo lang('PAGE_EDITOR_ADD_EMPHATIC') ?>"><img src="<?php echo $image_dir ?>/editor/italic.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><noscript><?php echo Html::Checkbox('table') ?></noscript><a href="javascript:table();" title="<?php echo lang('PAGE_EDITOR_ADD_TABLE') ?>"><img src="<?php echo $image_dir ?>/editor/table.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><noscript><?php echo Html::Checkbox('list') ?></noscript><a href="javascript:list();" title="<?php echo lang('PAGE_EDITOR_ADD_LIST') ?>"><img src="<?php echo $image_dir ?>/editor/list.png" border"0" /></a></td>
        <td><noscript><?php echo Html::Checkbox('numlist') ?></noscript><a href="javascript:numlist();" title="<?php echo lang('PAGE_EDITOR_ADD_NUMLIST') ?>"><img src="<?php echo $image_dir ?>/editor/numlist.png" border"0" /></a></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><noscript><?php echo Html::Checkbox('image') ?></noscript><a href="javascript:image();" title="<?php echo lang('PAGE_EDITOR_ADD_IMAGE') ?>"><img src="<?php echo $image_dir ?>/editor/image.png" border"0" /></a></td>
        <td><noscript><?php echo Html::Checkbox('link') ?></noscript><a href="javascript:link();" title="<?php echo lang('PAGE_EDITOR_ADD_LINK') ?>"><img src="<?php echo $image_dir ?>/editor/link.png" border"0" /></a></td>
        <td><?php echo Html::selectBox('objectid',$objects) ?><noscript>&nbsp;&nbsp;&nbsp;<input type="submit" class="submit" name="addmarkup" value="<?php echo lang('GLOBAL_ADD') ?>"/></noscript></td>
      </tr>
    </table>
  </td>
</tr>
<?php
	echo '<textarea name="'.$attr8_name.'" class="editor">'.$$attr8_name.'</textarea>';
}
elseif	($attr8_type=='text' || $attr8_type=='raw')
{
	echo '<textarea name="'.$attr8_name.'" class="editor">'.$$attr8_name.'</textarea>';
}
else
{
	echo "Unknown editor type: ".$attr8_type;
}
?>
<?php unset($attr8) ?><?php unset($attr8_name) ?><?php unset($attr8_type) ?><?php $attr6 = array() ?><?php
	}
	
?><?php unset($attr6) ?><?php $attr7 = array('equals'=>'text','value'=>$editor) ?><?php $attr7_equals='text' ?><?php $attr7_value=$editor ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr7);
	
	if	( isset($attr7_true) )
	{
		if	(gettype($attr7_true) === '' && gettype($attr7_true) === '1')
			$exec = $$attr7_true == true;
		else
			$exec = $attr7_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr7_false) )
	{
		if	(gettype($attr7_false) === '' && gettype($attr7_false) === '1')
			$exec = $$attr7_false == false;
		else
			$exec = $attr7_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr7_contains) )
		$exec = in_array($attr7_value,explode(',',$attr7_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr7_equals)&& isset($attr7_value) )
		$exec = $attr7_equals == $attr7_value;

	// Vergleich auf leer
	elseif	( isset($attr7_empty) )
	{
		if	( !isset($$attr7_empty) )
			$exec = empty($attr7_empty);
		elseif	( is_array($$attr7_empty) )
			$exec = (count($$attr7_empty)==0);
		elseif	( is_bool($$attr7_empty) )
			$exec = true;
		else
			$exec = empty( $$attr7_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr7_present) )
	{
		$exec = isset($$attr7_present);
//		if	( !isset($$attr7_present) )
//			$exec = false;
//		elseif	( is_array($$attr7_present) )
//			$exec = (count($$attr7_present)>0);
//		elseif	( is_bool($$attr7_present) )
//			$exec = $$attr7_present;
//		elseif	( is_numeric($$attr7_present) )
//			$exec = $$attr7_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr7 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr7_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr7_not) )
		$exec = !$exec;

	unset($attr7_true);
	unset($attr7_false);
	unset($attr7_notempty);
	unset($attr7_empty);
	unset($attr7_contains);
	unset($attr7_present);
	unset($attr7_invert);
	unset($attr7_not);
	unset($attr7_value);
	unset($attr7_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr7) ?><?php unset($attr7_equals) ?><?php unset($attr7_value) ?><?php $attr8 = array('name'=>'text','rows'=>'25','cols'=>'70','class'=>'longtext') ?><?php $attr8_name='text' ?><?php $attr8_rows='25' ?><?php $attr8_cols='70' ?><?php $attr8_class='longtext' ?><textarea class="<?php echo $attr8_class ?>" name="<?php echo $attr8_name ?>" rows="<?php echo $attr8_rows ?>" cols="<?php echo $attr8_cols ?>"><?php echo htmlentities(isset($$attr8_name)?$$attr8_name:$attr8_default) ?></textarea><?php unset($attr8) ?><?php unset($attr8_name) ?><?php unset($attr8_rows) ?><?php unset($attr8_cols) ?><?php unset($attr8_class) ?><?php $attr8 = array('field'=>'text') ?><?php $attr8_field='text' ?>
<script name="JavaScript" type="text/javascript">
<!--
document.forms[0].<?php echo $attr8_field ?>.focus();
document.forms[0].<?php echo $attr8_field ?>.select();
// -->
</script>
<?php unset($attr8) ?><?php unset($attr8_field) ?><?php $attr6 = array() ?><?php
	}
	
?><?php unset($attr6) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3 = array() ?><?php
	}
	
?><?php unset($attr3) ?><?php $attr4 = array('equals'=>'link','value'=>$type) ?><?php $attr4_equals='link' ?><?php $attr4_value=$type ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr4);
	
	if	( isset($attr4_true) )
	{
		if	(gettype($attr4_true) === '' && gettype($attr4_true) === '1')
			$exec = $$attr4_true == true;
		else
			$exec = $attr4_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr4_false) )
	{
		if	(gettype($attr4_false) === '' && gettype($attr4_false) === '1')
			$exec = $$attr4_false == false;
		else
			$exec = $attr4_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr4_contains) )
		$exec = in_array($attr4_value,explode(',',$attr4_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr4_equals)&& isset($attr4_value) )
		$exec = $attr4_equals == $attr4_value;

	// Vergleich auf leer
	elseif	( isset($attr4_empty) )
	{
		if	( !isset($$attr4_empty) )
			$exec = empty($attr4_empty);
		elseif	( is_array($$attr4_empty) )
			$exec = (count($$attr4_empty)==0);
		elseif	( is_bool($$attr4_empty) )
			$exec = true;
		else
			$exec = empty( $$attr4_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr4_present) )
	{
		$exec = isset($$attr4_present);
//		if	( !isset($$attr4_present) )
//			$exec = false;
//		elseif	( is_array($$attr4_present) )
//			$exec = (count($$attr4_present)>0);
//		elseif	( is_bool($$attr4_present) )
//			$exec = $$attr4_present;
//		elseif	( is_numeric($$attr4_present) )
//			$exec = $$attr4_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr4 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr4_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr4_not) )
		$exec = !$exec;

	unset($attr4_true);
	unset($attr4_false);
	unset($attr4_notempty);
	unset($attr4_empty);
	unset($attr4_contains);
	unset($attr4_present);
	unset($attr4_invert);
	unset($attr4_not);
	unset($attr4_value);
	unset($attr4_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr4) ?><?php unset($attr4_equals) ?><?php unset($attr4_value) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('class'=>'fx','colspan'=>'2') ?><?php $attr6_class='fx' ?><?php $attr6_colspan='2' ?><?php
//	if (empty($attr6_class))
//		$attr6['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('list'=>'objects','name'=>'linkobjectid') ?><?php $attr7_list='objects' ?><?php $attr7_name='linkobjectid' ?><select size="1" id="id_<?php echo $attr7_name ?>"  name="<?php echo $attr7_name ?>" onchange="<?php echo $attr7_onchange ?>" title="<?php echo $attr7_title ?>" class="<?php echo $attr7_class ?>"<?php
if (count($$attr7_list)==1) echo ' disabled="disabled"'
?>><?php
		foreach( $$attr7_list as $box_key=>$box_value )
		{
			echo '<option class="'.$attr7_class.'" value="'.$box_key.'"';
			if (isset($$attr7_name)&&$box_key==$$attr7_name || isset($attr7_default)&&$box_key == $attr7_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />'
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php $attr7 = array('field'=>'linkobjectid') ?><?php $attr7_field='linkobjectid' ?>
<script name="JavaScript" type="text/javascript">
<!--
document.forms[0].<?php echo $attr7_field ?>.focus();
document.forms[0].<?php echo $attr7_field ?>.select();
// -->
</script>
<?php unset($attr7) ?><?php unset($attr7_field) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3 = array() ?><?php
	}
	
?><?php unset($attr3) ?><?php $attr4 = array('equals'=>'list','value'=>$type) ?><?php $attr4_equals='list' ?><?php $attr4_value=$type ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr4);
	
	if	( isset($attr4_true) )
	{
		if	(gettype($attr4_true) === '' && gettype($attr4_true) === '1')
			$exec = $$attr4_true == true;
		else
			$exec = $attr4_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr4_false) )
	{
		if	(gettype($attr4_false) === '' && gettype($attr4_false) === '1')
			$exec = $$attr4_false == false;
		else
			$exec = $attr4_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr4_contains) )
		$exec = in_array($attr4_value,explode(',',$attr4_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr4_equals)&& isset($attr4_value) )
		$exec = $attr4_equals == $attr4_value;

	// Vergleich auf leer
	elseif	( isset($attr4_empty) )
	{
		if	( !isset($$attr4_empty) )
			$exec = empty($attr4_empty);
		elseif	( is_array($$attr4_empty) )
			$exec = (count($$attr4_empty)==0);
		elseif	( is_bool($$attr4_empty) )
			$exec = true;
		else
			$exec = empty( $$attr4_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr4_present) )
	{
		$exec = isset($$attr4_present);
//		if	( !isset($$attr4_present) )
//			$exec = false;
//		elseif	( is_array($$attr4_present) )
//			$exec = (count($$attr4_present)>0);
//		elseif	( is_bool($$attr4_present) )
//			$exec = $$attr4_present;
//		elseif	( is_numeric($$attr4_present) )
//			$exec = $$attr4_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr4 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr4_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr4_not) )
		$exec = !$exec;

	unset($attr4_true);
	unset($attr4_false);
	unset($attr4_notempty);
	unset($attr4_empty);
	unset($attr4_contains);
	unset($attr4_present);
	unset($attr4_invert);
	unset($attr4_not);
	unset($attr4_value);
	unset($attr4_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr4) ?><?php unset($attr4_equals) ?><?php unset($attr4_value) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('class'=>'fx','colspan'=>'2') ?><?php $attr6_class='fx' ?><?php $attr6_colspan='2' ?><?php
//	if (empty($attr6_class))
//		$attr6['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('list'=>'objects','name'=>'linkobjectid') ?><?php $attr7_list='objects' ?><?php $attr7_name='linkobjectid' ?><select size="1" id="id_<?php echo $attr7_name ?>"  name="<?php echo $attr7_name ?>" onchange="<?php echo $attr7_onchange ?>" title="<?php echo $attr7_title ?>" class="<?php echo $attr7_class ?>"<?php
if (count($$attr7_list)==1) echo ' disabled="disabled"'
?>><?php
		foreach( $$attr7_list as $box_key=>$box_value )
		{
			echo '<option class="'.$attr7_class.'" value="'.$box_key.'"';
			if (isset($$attr7_name)&&$box_key==$$attr7_name || isset($attr7_default)&&$box_key == $attr7_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />'
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php $attr7 = array('field'=>'linkobjectid') ?><?php $attr7_field='linkobjectid' ?>
<script name="JavaScript" type="text/javascript">
<!--
document.forms[0].<?php echo $attr7_field ?>.focus();
document.forms[0].<?php echo $attr7_field ?>.select();
// -->
</script>
<?php unset($attr7) ?><?php unset($attr7_field) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3 = array() ?><?php
	}
	
?><?php unset($attr3) ?><?php $attr4 = array('equals'=>'number','value'=>$type) ?><?php $attr4_equals='number' ?><?php $attr4_value=$type ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr4);
	
	if	( isset($attr4_true) )
	{
		if	(gettype($attr4_true) === '' && gettype($attr4_true) === '1')
			$exec = $$attr4_true == true;
		else
			$exec = $attr4_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr4_false) )
	{
		if	(gettype($attr4_false) === '' && gettype($attr4_false) === '1')
			$exec = $$attr4_false == false;
		else
			$exec = $attr4_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr4_contains) )
		$exec = in_array($attr4_value,explode(',',$attr4_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr4_equals)&& isset($attr4_value) )
		$exec = $attr4_equals == $attr4_value;

	// Vergleich auf leer
	elseif	( isset($attr4_empty) )
	{
		if	( !isset($$attr4_empty) )
			$exec = empty($attr4_empty);
		elseif	( is_array($$attr4_empty) )
			$exec = (count($$attr4_empty)==0);
		elseif	( is_bool($$attr4_empty) )
			$exec = true;
		else
			$exec = empty( $$attr4_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr4_present) )
	{
		$exec = isset($$attr4_present);
//		if	( !isset($$attr4_present) )
//			$exec = false;
//		elseif	( is_array($$attr4_present) )
//			$exec = (count($$attr4_present)>0);
//		elseif	( is_bool($$attr4_present) )
//			$exec = $$attr4_present;
//		elseif	( is_numeric($$attr4_present) )
//			$exec = $$attr4_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr4 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr4_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr4_not) )
		$exec = !$exec;

	unset($attr4_true);
	unset($attr4_false);
	unset($attr4_notempty);
	unset($attr4_empty);
	unset($attr4_contains);
	unset($attr4_present);
	unset($attr4_invert);
	unset($attr4_not);
	unset($attr4_value);
	unset($attr4_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr4) ?><?php unset($attr4_equals) ?><?php unset($attr4_value) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('class'=>'fx','colspan'=>'2') ?><?php $attr6_class='fx' ?><?php $attr6_colspan='2' ?><?php
//	if (empty($attr6_class))
//		$attr6['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('name'=>'decimals','default'=>'decimals') ?><?php $attr7_name='decimals' ?><?php $attr7_default='decimals' ?><input type="hidden" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php unset($attr7) ?><?php unset($attr7_name) ?><?php unset($attr7_default) ?><?php $attr7 = array('type'=>'text','name'=>'number','size'=>'15','maxlength'=>'20') ?><?php $attr7_type='text' ?><?php $attr7_name='number' ?><?php $attr7_size='15' ?><?php $attr7_maxlength='20' ?><input id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" onxxxMouseOver="this.focus();"  /><?php unset($attr7) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php $attr7 = array('field'=>'number') ?><?php $attr7_field='number' ?>
<script name="JavaScript" type="text/javascript">
<!--
document.forms[0].<?php echo $attr7_field ?>.focus();
document.forms[0].<?php echo $attr7_field ?>.select();
// -->
</script>
<?php unset($attr7) ?><?php unset($attr7_field) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3 = array() ?><?php
	}
	
?><?php unset($attr3) ?><?php $attr4 = array('equals'=>'select','value'=>$type) ?><?php $attr4_equals='select' ?><?php $attr4_value=$type ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr4);
	
	if	( isset($attr4_true) )
	{
		if	(gettype($attr4_true) === '' && gettype($attr4_true) === '1')
			$exec = $$attr4_true == true;
		else
			$exec = $attr4_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr4_false) )
	{
		if	(gettype($attr4_false) === '' && gettype($attr4_false) === '1')
			$exec = $$attr4_false == false;
		else
			$exec = $attr4_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr4_contains) )
		$exec = in_array($attr4_value,explode(',',$attr4_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr4_equals)&& isset($attr4_value) )
		$exec = $attr4_equals == $attr4_value;

	// Vergleich auf leer
	elseif	( isset($attr4_empty) )
	{
		if	( !isset($$attr4_empty) )
			$exec = empty($attr4_empty);
		elseif	( is_array($$attr4_empty) )
			$exec = (count($$attr4_empty)==0);
		elseif	( is_bool($$attr4_empty) )
			$exec = true;
		else
			$exec = empty( $$attr4_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr4_present) )
	{
		$exec = isset($$attr4_present);
//		if	( !isset($$attr4_present) )
//			$exec = false;
//		elseif	( is_array($$attr4_present) )
//			$exec = (count($$attr4_present)>0);
//		elseif	( is_bool($$attr4_present) )
//			$exec = $$attr4_present;
//		elseif	( is_numeric($$attr4_present) )
//			$exec = $$attr4_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr4 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr4_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr4_not) )
		$exec = !$exec;

	unset($attr4_true);
	unset($attr4_false);
	unset($attr4_notempty);
	unset($attr4_empty);
	unset($attr4_contains);
	unset($attr4_present);
	unset($attr4_invert);
	unset($attr4_not);
	unset($attr4_value);
	unset($attr4_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr4) ?><?php unset($attr4_equals) ?><?php unset($attr4_value) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('class'=>'fx','colspan'=>'2') ?><?php $attr6_class='fx' ?><?php $attr6_colspan='2' ?><?php
//	if (empty($attr6_class))
//		$attr6['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('list'=>'items','name'=>'text') ?><?php $attr7_list='items' ?><?php $attr7_name='text' ?><select size="1" id="id_<?php echo $attr7_name ?>"  name="<?php echo $attr7_name ?>" onchange="<?php echo $attr7_onchange ?>" title="<?php echo $attr7_title ?>" class="<?php echo $attr7_class ?>"<?php
if (count($$attr7_list)==1) echo ' disabled="disabled"'
?>><?php
		foreach( $$attr7_list as $box_key=>$box_value )
		{
			echo '<option class="'.$attr7_class.'" value="'.$box_key.'"';
			if (isset($$attr7_name)&&$box_key==$$attr7_name || isset($attr7_default)&&$box_key == $attr7_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr7_list)==1) echo '<input type="hidden" name="'.$attr7_name.'" value="'.$box_key.'" />'
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php $attr7 = array('field'=>'text') ?><?php $attr7_field='text' ?>
<script name="JavaScript" type="text/javascript">
<!--
document.forms[0].<?php echo $attr7_field ?>.focus();
document.forms[0].<?php echo $attr7_field ?>.select();
// -->
</script>
<?php unset($attr7) ?><?php unset($attr7_field) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3 = array() ?><?php
	}
	
?><?php unset($attr3) ?><?php $attr4 = array('present'=>'release') ?><?php $attr4_present='release' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr4);
	
	if	( isset($attr4_true) )
	{
		if	(gettype($attr4_true) === '' && gettype($attr4_true) === '1')
			$exec = $$attr4_true == true;
		else
			$exec = $attr4_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr4_false) )
	{
		if	(gettype($attr4_false) === '' && gettype($attr4_false) === '1')
			$exec = $$attr4_false == false;
		else
			$exec = $attr4_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr4_contains) )
		$exec = in_array($attr4_value,explode(',',$attr4_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr4_equals)&& isset($attr4_value) )
		$exec = $attr4_equals == $attr4_value;

	// Vergleich auf leer
	elseif	( isset($attr4_empty) )
	{
		if	( !isset($$attr4_empty) )
			$exec = empty($attr4_empty);
		elseif	( is_array($$attr4_empty) )
			$exec = (count($$attr4_empty)==0);
		elseif	( is_bool($$attr4_empty) )
			$exec = true;
		else
			$exec = empty( $$attr4_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr4_present) )
	{
		$exec = isset($$attr4_present);
//		if	( !isset($$attr4_present) )
//			$exec = false;
//		elseif	( is_array($$attr4_present) )
//			$exec = (count($$attr4_present)>0);
//		elseif	( is_bool($$attr4_present) )
//			$exec = $$attr4_present;
//		elseif	( is_numeric($$attr4_present) )
//			$exec = $$attr4_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr4 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr4_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr4_not) )
		$exec = !$exec;

	unset($attr4_true);
	unset($attr4_false);
	unset($attr4_notempty);
	unset($attr4_empty);
	unset($attr4_contains);
	unset($attr4_present);
	unset($attr4_invert);
	unset($attr4_not);
	unset($attr4_value);
	unset($attr4_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr4) ?><?php unset($attr4_present) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('class'=>'fx','colspan'=>'2') ?><?php $attr6_class='fx' ?><?php $attr6_colspan='2' ?><?php
//	if (empty($attr6_class))
//		$attr6['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('default'=>'','readonly'=>'','name'=>'release') ?><?php $attr7_default='' ?><?php $attr7_readonly='' ?><?php $attr7_name='release' ?><?php
	$attr7_default  = ( $attr7_default  == true );
	
	if	( isset($$attr7_name) )
		$checked = $$attr7_name == true;
//		$checked = isset($$$attr7_name)&& $$$attr7_name==true;
	else
		$checked = $attr7_default == true;
?><input type="checkbox" id="id_<?php echo $attr7_name  ?>" name="<?php echo $attr7_name  ?>"  <?php if ($attr7_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php unset($attr7_name); unset($attr7_readonly); unset($attr7_default); ?><?php unset($attr7) ?><?php unset($attr7_default) ?><?php unset($attr7_readonly) ?><?php unset($attr7_name) ?><?php $attr7 = array('class'=>'text','raw'=>'_') ?><?php $attr7_class='text' ?><?php $attr7_raw='_' ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
		
	if(empty($attr7_title))
		if (!empty($attr7_key))
			$attr7_title = lang($attr7_key.'_HELP');
		else
			$attr7_title = '';

?><span class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
	$attr7_title = '';

	if (!empty($attr7_array))
	{
		//geht nicht:
		//echo $$attr7_array[$attr7_var].'%';
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = lang($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		if	( isset($$attr7_text))
			$tmp_text = lang($$attr7_text);
		else
			$tmp_text = lang($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = lang($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = lang($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?htmlentities($$attr7_var):'error: variable '.$attr7_var.' not present';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr7);echo 'text error';
	}
	
	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_raw) ?><?php $attr7 = array('class'=>'text','text'=>'GLOBAL_RELEASE') ?><?php $attr7_class='text' ?><?php $attr7_text='GLOBAL_RELEASE' ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
		
	if(empty($attr7_title))
		if (!empty($attr7_key))
			$attr7_title = lang($attr7_key.'_HELP');
		else
			$attr7_title = '';

?><span class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
	$attr7_title = '';

	if (!empty($attr7_array))
	{
		//geht nicht:
		//echo $$attr7_array[$attr7_var].'%';
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = lang($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		if	( isset($$attr7_text))
			$tmp_text = lang($$attr7_text);
		else
			$tmp_text = lang($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = lang($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = lang($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?htmlentities($$attr7_var):'error: variable '.$attr7_var.' not present';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr7);echo 'text error';
	}
	
	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3 = array() ?><?php
	}
	
?><?php unset($attr3) ?><?php $attr4 = array('present'=>'publish') ?><?php $attr4_present='publish' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr4);
	
	if	( isset($attr4_true) )
	{
		if	(gettype($attr4_true) === '' && gettype($attr4_true) === '1')
			$exec = $$attr4_true == true;
		else
			$exec = $attr4_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr4_false) )
	{
		if	(gettype($attr4_false) === '' && gettype($attr4_false) === '1')
			$exec = $$attr4_false == false;
		else
			$exec = $attr4_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr4_contains) )
		$exec = in_array($attr4_value,explode(',',$attr4_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr4_equals)&& isset($attr4_value) )
		$exec = $attr4_equals == $attr4_value;

	// Vergleich auf leer
	elseif	( isset($attr4_empty) )
	{
		if	( !isset($$attr4_empty) )
			$exec = empty($attr4_empty);
		elseif	( is_array($$attr4_empty) )
			$exec = (count($$attr4_empty)==0);
		elseif	( is_bool($$attr4_empty) )
			$exec = true;
		else
			$exec = empty( $$attr4_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr4_present) )
	{
		$exec = isset($$attr4_present);
//		if	( !isset($$attr4_present) )
//			$exec = false;
//		elseif	( is_array($$attr4_present) )
//			$exec = (count($$attr4_present)>0);
//		elseif	( is_bool($$attr4_present) )
//			$exec = $$attr4_present;
//		elseif	( is_numeric($$attr4_present) )
//			$exec = $$attr4_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr4 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr4_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr4_not) )
		$exec = !$exec;

	unset($attr4_true);
	unset($attr4_false);
	unset($attr4_notempty);
	unset($attr4_empty);
	unset($attr4_contains);
	unset($attr4_present);
	unset($attr4_invert);
	unset($attr4_not);
	unset($attr4_value);
	unset($attr4_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr4) ?><?php unset($attr4_present) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('class'=>'fx','colspan'=>'2') ?><?php $attr6_class='fx' ?><?php $attr6_colspan='2' ?><?php
//	if (empty($attr6_class))
//		$attr6['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr6_class))
		$attr6['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr6_rowspan) )
		$attr6['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('default'=>'','readonly'=>'','name'=>'publish') ?><?php $attr7_default='' ?><?php $attr7_readonly='' ?><?php $attr7_name='publish' ?><?php
	$attr7_default  = ( $attr7_default  == true );
	
	if	( isset($$attr7_name) )
		$checked = $$attr7_name == true;
//		$checked = isset($$$attr7_name)&& $$$attr7_name==true;
	else
		$checked = $attr7_default == true;
?><input type="checkbox" id="id_<?php echo $attr7_name  ?>" name="<?php echo $attr7_name  ?>"  <?php if ($attr7_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php unset($attr7_name); unset($attr7_readonly); unset($attr7_default); ?><?php unset($attr7) ?><?php unset($attr7_default) ?><?php unset($attr7_readonly) ?><?php unset($attr7_name) ?><?php $attr7 = array('class'=>'text','raw'=>'_') ?><?php $attr7_class='text' ?><?php $attr7_raw='_' ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
		
	if(empty($attr7_title))
		if (!empty($attr7_key))
			$attr7_title = lang($attr7_key.'_HELP');
		else
			$attr7_title = '';

?><span class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
	$attr7_title = '';

	if (!empty($attr7_array))
	{
		//geht nicht:
		//echo $$attr7_array[$attr7_var].'%';
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = lang($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		if	( isset($$attr7_text))
			$tmp_text = lang($$attr7_text);
		else
			$tmp_text = lang($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = lang($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = lang($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?htmlentities($$attr7_var):'error: variable '.$attr7_var.' not present';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr7);echo 'text error';
	}
	
	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_raw) ?><?php $attr7 = array('class'=>'text','text'=>'PAGE_PUBLISH_AFTER_SAVE') ?><?php $attr7_class='text' ?><?php $attr7_text='PAGE_PUBLISH_AFTER_SAVE' ?><?php
	if	( isset($attr7_prefix)&& isset($attr7_key))
		$attr7_key = $attr7_prefix.$attr7_key;
	if	( isset($attr7_suffix)&& isset($attr7_key))
		$attr7_key = $attr7_key.$attr7_suffix;
		
	if(empty($attr7_title))
		if (!empty($attr7_key))
			$attr7_title = lang($attr7_key.'_HELP');
		else
			$attr7_title = '';

?><span class="<?php echo $attr7_class ?>" title="<?php echo $attr7_title ?>"><?php
	$attr7_title = '';

	if (!empty($attr7_array))
	{
		//geht nicht:
		//echo $$attr7_array[$attr7_var].'%';
		$tmpArray = $$attr7_array;
		if (!empty($attr7_var))
			$tmp_text = $tmpArray[$attr7_var];
		else
			$tmp_text = lang($tmpArray[$attr7_text]);
	}
	elseif (!empty($attr7_text))
		if	( isset($$attr7_text))
			$tmp_text = lang($$attr7_text);
		else
			$tmp_text = lang($attr7_text);
	elseif (!empty($attr7_textvar))
		$tmp_text = lang($$attr7_textvar);
	elseif (!empty($attr7_key))
		$tmp_text = lang($attr7_key);
	elseif (!empty($attr7_var))
		$tmp_text = isset($$attr7_var)?htmlentities($$attr7_var):'error: variable '.$attr7_var.' not present';	
	elseif (!empty($attr7_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr7_raw);
	elseif (!empty($attr7_value))
		$tmp_text = $attr7_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr7);echo 'text error';
	}
	
	if	( !empty($attr7_maxlength) && intval($attr7_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr7_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3 = array() ?><?php
	}
	
?><?php unset($attr3) ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr4_class))
		$attr4_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5 = array('class'=>'act','colspan'=>'2') ?><?php $attr5_class='act' ?><?php $attr5_colspan='2' ?><?php
//	if (empty($attr5_class))
//		$attr5['class']=$row_class;
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
		
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php unset($attr5_colspan) ?><?php $attr6 = array('type'=>'ok','class'=>'ok','value'=>'ok','text'=>'button_ok') ?><?php $attr6_type='ok' ?><?php $attr6_class='ok' ?><?php $attr6_value='ok' ?><?php $attr6_text='button_ok' ?><?php
	if ($attr6_type=='ok')
	{
		$attr6_type  = 'submit';
//		$attr6_class = 'ok';
//		$attr6_text  = 'BUTTON_OK';
//		$attr6_value = 'ok';
	}
?><input type="<?php echo $attr6_type ?>" name="<?php echo $attr6_value ?>" class="<?php echo $attr6_class ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($attr6_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr6) ?><?php unset($attr6_type) ?><?php unset($attr6_class) ?><?php unset($attr6_value) ?><?php unset($attr6_text) ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr2 = array() ?>      </table>
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
<?php unset($attr2) ?><?php $attr1 = array() ?></form>

<?php unset($attr1) ?><?php $attr2 = array('field'=>'text') ?><?php $attr2_field='text' ?>
<script name="JavaScript" type="text/javascript">
<!--
document.forms[0].<?php echo $attr2_field ?>.focus();
document.forms[0].<?php echo $attr2_field ?>.select();
// -->
</script>
<?php unset($attr2) ?><?php unset($attr2_field) ?><?php $attr0 = array() ?>
<!-- $Id$ -->

<?php if ($showDuration) { ?>
<br/>
<small>&nbsp;
<?php $dur = time()-START_TIME;
//      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small>
<?php } ?>

</body>
</html><?php unset($attr0) ?>