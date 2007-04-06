<?php $attr1 = array('class'=>'main','title'=>$cms_title) ?><?php $attr1_class='main' ?><?php $attr1_title=$cms_title ?><?php header('Content-Type: text/html; charset='.lang('CHARSET'))
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title><?php echo $attr1_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=<?php echo lang('CHARSET') ?>" />
  <meta name="MSSmartTagsPreventParsing" content="true" />
  <meta name="robots" content="noindex,nofollow" />
<?php if (isset($windowMenu) && is_array($windowMenu)) foreach( $windowMenu as $menu )
      {
       	?>
  <link rel="section" href="<?php echo Html::url($actionName,@$menu['subaction'],$this->getRequestId() ) ?>" title="<?php echo lang($menu['text']) ?>" />
<?php
      }
?>
  <link rel="stylesheet" type="text/css" href="./themes/default/css/default.css" />
<?php if($stylesheet!='default') { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $stylesheet ?>" />
<?php } ?>
</head>

<body class="<?php echo $attr1_class ?>">

<?php unset($attr1) ?><?php unset($attr1_class) ?><?php unset($attr1_title) ?><?php $attr2 = array('action'=>'index','subaction'=>'login','target'=>'_top','method'=>'post','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr2_action='index' ?><?php $attr2_subaction='login' ?><?php $attr2_target='_top' ?><?php $attr2_method='post' ?><?php $attr2_enctype='application/x-www-form-urlencoded' ?><?php
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
?><?php unset($attr2) ?><?php unset($attr2_action) ?><?php unset($attr2_subaction) ?><?php unset($attr2_target) ?><?php unset($attr2_method) ?><?php unset($attr2_enctype) ?><?php $attr3 = array('title'=>'GLOBAL_LOGIN','name'=>'login','icon'=>'user','width'=>'400','rowclasses'=>'odd,even','columnclasses'=>'1,2,3') ?><?php $attr3_title='GLOBAL_LOGIN' ?><?php $attr3_name='login' ?><?php $attr3_icon='user' ?><?php $attr3_width='400' ?><?php $attr3_rowclasses='odd,even' ?><?php $attr3_columnclasses='1,2,3' ?><?php
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
		if	( !isset($path) || is_array($path) )
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
  
    <?php if	( !isset($windowMenu) || !is_array($windowMenu) )
			$windowMenu = array();
    foreach( $windowMenu as $menu )
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
      <table class="n" cellspacing="0" width="100%" cellpadding="4"><?php unset($attr3) ?><?php unset($attr3_title) ?><?php unset($attr3_name) ?><?php unset($attr3_icon) ?><?php unset($attr3_width) ?><?php unset($attr3_rowclasses) ?><?php unset($attr3_columnclasses) ?><?php $attr4 = array('present'=>$conf['login']['logo']['file']) ?><?php $attr4_present=$conf['login']['logo']['file'] ?><?php 

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
?><?php unset($attr4) ?><?php unset($attr4_present) ?><?php $attr5 = array('false'=>$this->mustChangePassword) ?><?php $attr5_false=$this->mustChangePassword ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr5);
	
	if	( isset($attr5_true) )
	{
		if	(gettype($attr5_true) === '' && gettype($attr5_true) === '1')
			$exec = $$attr5_true == true;
		else
			$exec = $attr5_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr5_false) )
	{
		if	(gettype($attr5_false) === '' && gettype($attr5_false) === '1')
			$exec = $$attr5_false == false;
		else
			$exec = $attr5_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr5_contains) )
		$exec = in_array($attr5_value,explode(',',$attr5_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr5_equals)&& isset($attr5_value) )
		$exec = $attr5_equals == $attr5_value;

	// Vergleich auf leer
	elseif	( isset($attr5_empty) )
	{
		if	( !isset($$attr5_empty) )
			$exec = empty($attr5_empty);
		elseif	( is_array($$attr5_empty) )
			$exec = (count($$attr5_empty)==0);
		elseif	( is_bool($$attr5_empty) )
			$exec = true;
		else
			$exec = empty( $$attr5_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr5_present) )
	{
		$exec = isset($$attr5_present);
//		if	( !isset($$attr5_present) )
//			$exec = false;
//		elseif	( is_array($$attr5_present) )
//			$exec = (count($$attr5_present)>0);
//		elseif	( is_bool($$attr5_present) )
//			$exec = $$attr5_present;
//		elseif	( is_numeric($$attr5_present) )
//			$exec = $$attr5_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr5 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr5_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr5_not) )
		$exec = !$exec;

	unset($attr5_true);
	unset($attr5_false);
	unset($attr5_notempty);
	unset($attr5_empty);
	unset($attr5_contains);
	unset($attr5_present);
	unset($attr5_invert);
	unset($attr5_not);
	unset($attr5_value);
	unset($attr5_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr5) ?><?php unset($attr5_false) ?><?php $attr6 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr6_class))
		$attr6_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr6_class ?>"><?php unset($attr6) ?><?php $attr7 = array('colspan'=>'2') ?><?php $attr7_colspan='2' ?><?php
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
		
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_colspan) ?><?php $attr8 = array('present'=>$conf['login']['logo']['url']) ?><?php $attr8_present=$conf['login']['logo']['url'] ?><?php 

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
?><?php unset($attr8) ?><?php unset($attr8_present) ?><?php $attr9 = array('target'=>'_top','url'=>$conf['login']['logo']['url']) ?><?php $attr9_target='_top' ?><?php $attr9_url=$conf['login']['logo']['url'] ?><?php
	if(empty($attr9_class))
		$attr9_class='';
	if(empty($attr9_title))
		$attr9_title = '';
		
	if(!empty($attr9_url))
		$tmp_url = $attr9_url;
	else
		$tmp_url = Html::url($attr9_action,$attr9_subaction,!empty($$attr9_id)?$$attr9_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr9_class ?>" target="<?php echo $attr9_target ?>" title="<?php echo $attr9_title ?>"><?php unset($attr9) ?><?php unset($attr9_target) ?><?php unset($attr9_url) ?><?php $attr10 = array('url'=>$conf['login']['logo']['file'],'align'=>'left') ?><?php $attr10_url=$conf['login']['logo']['file'] ?><?php $attr10_align='left' ?><?php
if (isset($attr10_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr10_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr10_align ?>"><?php
} elseif (isset($attr10_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr10_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr10_align ?>"><?php
} elseif (isset($attr10_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr10_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr10_align ?>"><?php
} elseif (isset($attr10_url)) {
?><img src="<?php echo $attr10_url ?>" border="0" align="<?php echo $attr10_align ?>"><?php
} elseif (isset($attr10_fileext)) {
?><img src="<?php echo $image_dir.$attr10_fileext ?>" border="0" align="<?php echo $attr10_align ?>"><?php
} elseif (isset($attr10_file)) {
?><img src="<?php echo $image_dir.$attr10_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr10_align ?>"><?php } ?><?php unset($attr10) ?><?php unset($attr10_url) ?><?php unset($attr10_align) ?><?php $attr8 = array() ?></a><?php unset($attr8) ?><?php $attr7 = array() ?><?php
	}
	
?><?php unset($attr7) ?><?php $attr8 = array('empty'=>$conf['login']['logo']['url']) ?><?php $attr8_empty=$conf['login']['logo']['url'] ?><?php 

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
?><?php unset($attr8) ?><?php unset($attr8_empty) ?><?php $attr9 = array('url'=>$conf['login']['logo']['file'],'align'=>'left') ?><?php $attr9_url=$conf['login']['logo']['file'] ?><?php $attr9_align='left' ?><?php
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
?><img src="<?php echo $image_dir.$attr9_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr9_align ?>"><?php } ?><?php unset($attr9) ?><?php unset($attr9_url) ?><?php unset($attr9_align) ?><?php $attr7 = array() ?><?php
	}
	
?><?php unset($attr7) ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr4 = array() ?><?php
	}
	
?><?php unset($attr4) ?><?php $attr3 = array() ?><?php
	}
	
?><?php unset($attr3) ?><?php $attr4 = array('present'=>$conf['login']['motd']) ?><?php $attr4_present=$conf['login']['motd'] ?><?php 

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

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('class'=>'motd','colspan'=>'2') ?><?php $attr6_class='motd' ?><?php $attr6_colspan='2' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('class'=>'text','raw'=>$conf['login']['motd']) ?><?php $attr7_class='text' ?><?php $attr7_raw=$conf['login']['motd'] ?><?php
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
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_raw) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3 = array() ?><?php
	}
	
?><?php unset($attr3) ?><?php $attr4 = array('true'=>$conf['login']['nologin']) ?><?php $attr4_true=$conf['login']['nologin'] ?><?php 

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
?><?php unset($attr4) ?><?php unset($attr4_true) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('class'=>'help','colspan'=>'2') ?><?php $attr6_class='help' ?><?php $attr6_colspan='2' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('class'=>'text','key'=>'LOGIN_NOLOGIN_DESC') ?><?php $attr7_class='text' ?><?php $attr7_key='LOGIN_NOLOGIN_DESC' ?><?php
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
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_key) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3 = array() ?><?php
	}
	
?><?php unset($attr3) ?><?php $attr4 = array('true'=>$conf['security']['readonly']) ?><?php $attr4_true=$conf['security']['readonly'] ?><?php 

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
?><?php unset($attr4) ?><?php unset($attr4_true) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('class'=>'help','colspan'=>'2') ?><?php $attr6_class='help' ?><?php $attr6_colspan='2' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('class'=>'text','key'=>'GLOBAL_READONLY_DESC') ?><?php $attr7_class='text' ?><?php $attr7_key='GLOBAL_READONLY_DESC' ?><?php
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
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_key) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3 = array() ?><?php
	}
	
?><?php unset($attr3) ?><?php $attr4 = array('true'=>$conf['security']['nopublish']) ?><?php $attr4_true=$conf['security']['nopublish'] ?><?php 

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
?><?php unset($attr4) ?><?php unset($attr4_true) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('class'=>'help','colspan'=>'2') ?><?php $attr6_class='help' ?><?php $attr6_colspan='2' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('class'=>'text','key'=>'GLOBAL_NOPUBLISH_DESC') ?><?php $attr7_class='text' ?><?php $attr7_key='GLOBAL_NOPUBLISH_DESC' ?><?php
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
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_key) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3 = array() ?><?php
	}
	
?><?php unset($attr3) ?><?php $attr4 = array('false'=>$conf['login']['nologin']) ?><?php $attr4_false=$conf['login']['nologin'] ?><?php 

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
?><?php unset($attr4) ?><?php unset($attr4_false) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('class'=>'logo','colspan'=>'2') ?><?php $attr6_class='logo' ?><?php $attr6_colspan='2' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('name'=>'login') ?><?php $attr7_name='login' ?><img src="<?php echo $image_dir.'logo_'.$attr7_name.IMG_ICON_EXT ?>" border="0" align="left"><h2 class="logo"><?php echo lang('logo_'.$attr7_name) ?></h2><p class="logo"><?php echo lang('logo_'.$attr7_name.'_text') ?></p><?php unset($attr7) ?><?php unset($attr7_name) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('width'=>'50%','class'=>'fx') ?><?php $attr6_width='50%' ?><?php $attr6_class='fx' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_width) ?><?php unset($attr6_class) ?><?php $attr7 = array('class'=>'text','key'=>'USER_USERNAME') ?><?php $attr7_class='text' ?><?php $attr7_key='USER_USERNAME' ?><?php
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
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_key) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6 = array('width'=>'50%','class'=>'fx') ?><?php $attr6_width='50%' ?><?php $attr6_class='fx' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_width) ?><?php unset($attr6_class) ?><?php $attr7 = array('not'=>'1','present'=>'force_username') ?><?php $attr7_not='1' ?><?php $attr7_present='force_username' ?><?php 

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
?><?php unset($attr7) ?><?php unset($attr7_not) ?><?php unset($attr7_present) ?><?php $attr8 = array('type'=>'text','name'=>'login_name','value'=>'','size'=>'25','maxlength'=>'256') ?><?php $attr8_type='text' ?><?php $attr8_name='login_name' ?><?php $attr8_value='' ?><?php $attr8_size='25' ?><?php $attr8_maxlength='256' ?><?php if(!isset($attr8_default)) $attr8_default='';
?><input id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name ?>" type="<?php echo $attr8_type ?>" size="<?php echo $attr8_size ?>" maxlength="<?php echo $attr8_maxlength ?>" class="<?php echo $attr8_class ?>" value="<?php echo isset($$attr8_name)?$$attr8_name:$attr8_default ?>" onxxxMouseOver="this.focus();"  /><?php unset($attr8) ?><?php unset($attr8_type) ?><?php unset($attr8_name) ?><?php unset($attr8_value) ?><?php unset($attr8_size) ?><?php unset($attr8_maxlength) ?><?php $attr6 = array() ?><?php
	}
	
?><?php unset($attr6) ?><?php $attr7 = array() ?><?php
	if	( !$last_exec )
	{
?><?php unset($attr7) ?><?php $attr8 = array('type'=>'hidden','name'=>'login_name','value'=>$force_username,'size'=>'40','maxlength'=>'256') ?><?php $attr8_type='hidden' ?><?php $attr8_name='login_name' ?><?php $attr8_value=$force_username ?><?php $attr8_size='40' ?><?php $attr8_maxlength='256' ?><?php if(!isset($attr8_default)) $attr8_default='';
?><input id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name ?>" type="<?php echo $attr8_type ?>" size="<?php echo $attr8_size ?>" maxlength="<?php echo $attr8_maxlength ?>" class="<?php echo $attr8_class ?>" value="<?php echo isset($$attr8_name)?$$attr8_name:$attr8_default ?>" onxxxMouseOver="this.focus();"  /><?php unset($attr8) ?><?php unset($attr8_type) ?><?php unset($attr8_name) ?><?php unset($attr8_value) ?><?php unset($attr8_size) ?><?php unset($attr8_maxlength) ?><?php $attr8 = array('class'=>'text','value'=>$force_username) ?><?php $attr8_class='text' ?><?php $attr8_value=$force_username ?><?php
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
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_value) ?><?php $attr6 = array() ?><?php
	}
?><?php unset($attr6) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('width'=>'50%','class'=>'fx') ?><?php $attr6_width='50%' ?><?php $attr6_class='fx' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_width) ?><?php unset($attr6_class) ?><?php $attr7 = array('class'=>'text','key'=>'USER_PASSWORD') ?><?php $attr7_class='text' ?><?php $attr7_key='USER_PASSWORD' ?><?php
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
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_key) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6 = array('width'=>'50%','class'=>'fx') ?><?php $attr6_width='50%' ?><?php $attr6_class='fx' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_width) ?><?php unset($attr6_class) ?><?php $attr7 = array('name'=>'login_password','default'=>'','size'=>'25','maxlength'=>'256') ?><?php $attr7_name='login_password' ?><?php $attr7_default='' ?><?php $attr7_size='25' ?><?php $attr7_maxlength='256' ?><input type="password" name="<?php echo $attr7_name ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php unset($attr7) ?><?php unset($attr7_name) ?><?php unset($attr7_default) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr5 = array('true'=>$this->mustChangePassword) ?><?php $attr5_true=$this->mustChangePassword ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr5);
	
	if	( isset($attr5_true) )
	{
		if	(gettype($attr5_true) === '' && gettype($attr5_true) === '1')
			$exec = $$attr5_true == true;
		else
			$exec = $attr5_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr5_false) )
	{
		if	(gettype($attr5_false) === '' && gettype($attr5_false) === '1')
			$exec = $$attr5_false == false;
		else
			$exec = $attr5_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr5_contains) )
		$exec = in_array($attr5_value,explode(',',$attr5_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr5_equals)&& isset($attr5_value) )
		$exec = $attr5_equals == $attr5_value;

	// Vergleich auf leer
	elseif	( isset($attr5_empty) )
	{
		if	( !isset($$attr5_empty) )
			$exec = empty($attr5_empty);
		elseif	( is_array($$attr5_empty) )
			$exec = (count($$attr5_empty)==0);
		elseif	( is_bool($$attr5_empty) )
			$exec = true;
		else
			$exec = empty( $$attr5_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr5_present) )
	{
		$exec = isset($$attr5_present);
//		if	( !isset($$attr5_present) )
//			$exec = false;
//		elseif	( is_array($$attr5_present) )
//			$exec = (count($$attr5_present)>0);
//		elseif	( is_bool($$attr5_present) )
//			$exec = $$attr5_present;
//		elseif	( is_numeric($$attr5_present) )
//			$exec = $$attr5_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr5 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr5_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr5_not) )
		$exec = !$exec;

	unset($attr5_true);
	unset($attr5_false);
	unset($attr5_notempty);
	unset($attr5_empty);
	unset($attr5_contains);
	unset($attr5_present);
	unset($attr5_invert);
	unset($attr5_not);
	unset($attr5_value);
	unset($attr5_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr5) ?><?php unset($attr5_true) ?><?php $attr6 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr6_class))
		$attr6_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr6_class ?>"><?php unset($attr6) ?><?php $attr7 = array('width'=>'50%','class'=>'fx') ?><?php $attr7_width='50%' ?><?php $attr7_class='fx' ?><?php
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
		
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_width) ?><?php unset($attr7_class) ?><?php $attr8 = array('class'=>'text','key'=>'USER_NEW_PASSWORD') ?><?php $attr8_class='text' ?><?php $attr8_key='USER_NEW_PASSWORD' ?><?php
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
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_key) ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr7 = array('width'=>'50%','class'=>'fx') ?><?php $attr7_width='50%' ?><?php $attr7_class='fx' ?><?php
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
		
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_width) ?><?php unset($attr7_class) ?><?php $attr8 = array('name'=>'password1','default'=>'','size'=>'25','maxlength'=>'256') ?><?php $attr8_name='password1' ?><?php $attr8_default='' ?><?php $attr8_size='25' ?><?php $attr8_maxlength='256' ?><input type="password" name="<?php echo $attr8_name ?>" size="<?php echo $attr8_size ?>" maxlength="<?php echo $attr8_maxlength ?>" class="<?php echo $attr8_class ?>" value="<?php echo isset($$attr8_name)?$$attr8_name:$attr8_default ?>" /><?php unset($attr8) ?><?php unset($attr8_name) ?><?php unset($attr8_default) ?><?php unset($attr8_size) ?><?php unset($attr8_maxlength) ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr6 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr6_class))
		$attr6_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr6_class ?>"><?php unset($attr6) ?><?php $attr7 = array('width'=>'50%','class'=>'fx') ?><?php $attr7_width='50%' ?><?php $attr7_class='fx' ?><?php
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
		
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_width) ?><?php unset($attr7_class) ?><?php $attr8 = array('class'=>'text','key'=>'USER_NEW_PASSWORD_REPEAT') ?><?php $attr8_class='text' ?><?php $attr8_key='USER_NEW_PASSWORD_REPEAT' ?><?php
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
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_key) ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr7 = array('width'=>'50%','class'=>'fx') ?><?php $attr7_width='50%' ?><?php $attr7_class='fx' ?><?php
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
		
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_width) ?><?php unset($attr7_class) ?><?php $attr8 = array('name'=>'password2','default'=>'','size'=>'25','maxlength'=>'256') ?><?php $attr8_name='password2' ?><?php $attr8_default='' ?><?php $attr8_size='25' ?><?php $attr8_maxlength='256' ?><input type="password" name="<?php echo $attr8_name ?>" size="<?php echo $attr8_size ?>" maxlength="<?php echo $attr8_maxlength ?>" class="<?php echo $attr8_class ?>" value="<?php echo isset($$attr8_name)?$$attr8_name:$attr8_default ?>" /><?php unset($attr8) ?><?php unset($attr8_name) ?><?php unset($attr8_default) ?><?php unset($attr8_size) ?><?php unset($attr8_maxlength) ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr4 = array() ?><?php
	}
	
?><?php unset($attr4) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('width'=>'50%','class'=>'fx') ?><?php $attr6_width='50%' ?><?php $attr6_class='fx' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_width) ?><?php unset($attr6_class) ?><?php $attr7 = array('class'=>'text','key'=>'GLOBAL_DATABASE') ?><?php $attr7_class='text' ?><?php $attr7_key='GLOBAL_DATABASE' ?><?php
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
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_key) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6 = array('width'=>'50%','class'=>'fx') ?><?php $attr6_width='50%' ?><?php $attr6_class='fx' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_width) ?><?php unset($attr6_class) ?><?php $attr7 = array('list'=>'dbids','name'=>'dbid','default'=>'actdbid') ?><?php $attr7_list='dbids' ?><?php $attr7_name='dbid' ?><?php $attr7_default='actdbid' ?><select size="1" id="id_<?php echo $attr7_name ?>"  name="<?php echo $attr7_name ?>" onchange="<?php echo $attr7_onchange ?>" title="<?php echo $attr7_title ?>" class="<?php echo $attr7_class ?>"<?php
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
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_default) ?><?php $attr7 = array('name'=>'screenwidth','default'=>'9999') ?><?php $attr7_name='screenwidth' ?><?php $attr7_default='9999' ?><input type="hidden" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php unset($attr7) ?><?php unset($attr7_name) ?><?php unset($attr7_default) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('class'=>'act','colspan'=>'2') ?><?php $attr6_class='act' ?><?php $attr6_colspan='2' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('type'=>'ok','class'=>'ok','value'=>'ok','text'=>'button_ok') ?><?php $attr7_type='ok' ?><?php $attr7_class='ok' ?><?php $attr7_value='ok' ?><?php $attr7_text='button_ok' ?><?php
	if ($attr7_type=='ok')
	{
		$attr7_type  = 'submit';
//		$attr7_class = 'ok';
//		$attr7_text  = 'BUTTON_OK';
//		$attr7_value = 'ok';
	}
?><input type="<?php echo $attr7_type ?>" name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7) ?><?php unset($attr7_type) ?><?php unset($attr7_class) ?><?php unset($attr7_value) ?><?php unset($attr7_text) ?><script name="javascript1.2" type="text/javascript">
<!--
document.forms[0].screenwidth.value=window.innerWidth;
//	-->
</script>
<?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3 = array() ?><?php
	}
	
?><?php unset($attr3) ?><?php $attr2 = array() ?>      </table>
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

<?php unset($attr1) ?><?php $attr2 = array() ?><br/><?php unset($attr2) ?><?php $attr2 = array() ?><br/><?php unset($attr2) ?><?php $attr2 = array('target'=>'_top','url'=>$conf['login']['gpl']['url']) ?><?php $attr2_target='_top' ?><?php $attr2_url=$conf['login']['gpl']['url'] ?><?php
	if(empty($attr2_class))
		$attr2_class='';
	if(empty($attr2_title))
		$attr2_title = '';
		
	if(!empty($attr2_url))
		$tmp_url = $attr2_url;
	else
		$tmp_url = Html::url($attr2_action,$attr2_subaction,!empty($$attr2_id)?$$attr2_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr2_class ?>" target="<?php echo $attr2_target ?>" title="<?php echo $attr2_title ?>"><?php unset($attr2) ?><?php unset($attr2_target) ?><?php unset($attr2_url) ?><?php $attr3 = array('class'=>'text','value'=>lang('GLOBAL_GPL')) ?><?php $attr3_class='text' ?><?php $attr3_value=lang('GLOBAL_GPL') ?><?php
	if	( isset($attr3_prefix)&& isset($attr3_key))
		$attr3_key = $attr3_prefix.$attr3_key;
	if	( isset($attr3_suffix)&& isset($attr3_key))
		$attr3_key = $attr3_key.$attr3_suffix;
		
	if(empty($attr3_title))
		if (!empty($attr3_key))
			$attr3_title = lang($attr3_key.'_HELP');
		else
			$attr3_title = '';

?><span class="<?php echo $attr3_class ?>" title="<?php echo $attr3_title ?>"><?php
	$attr3_title = '';

	if (!empty($attr3_array))
	{
		//geht nicht:
		//echo $$attr3_array[$attr3_var].'%';
		$tmpArray = $$attr3_array;
		if (!empty($attr3_var))
			$tmp_text = $tmpArray[$attr3_var];
		else
			$tmp_text = lang($tmpArray[$attr3_text]);
	}
	elseif (!empty($attr3_text))
		if	( isset($$attr3_text))
			$tmp_text = lang($$attr3_text);
		else
			$tmp_text = lang($attr3_text);
	elseif (!empty($attr3_textvar))
		$tmp_text = lang($$attr3_textvar);
	elseif (!empty($attr3_key))
		$tmp_text = lang($attr3_key);
	elseif (!empty($attr3_var))
		$tmp_text = isset($$attr3_var)?htmlentities($$attr3_var):'error: variable '.$attr3_var.' not present';	
	elseif (!empty($attr3_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr3_raw);
	elseif (!empty($attr3_value))
		$tmp_text = $attr3_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr3);echo 'text error';
	}
	
	if	( !empty($attr3_maxlength) && intval($attr3_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr3_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr3) ?><?php unset($attr3_class) ?><?php unset($attr3_value) ?><?php $attr1 = array() ?></a><?php unset($attr1) ?><?php $attr2 = array('present'=>'force_username') ?><?php $attr2_present='force_username' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr2);
	
	if	( isset($attr2_true) )
	{
		if	(gettype($attr2_true) === '' && gettype($attr2_true) === '1')
			$exec = $$attr2_true == true;
		else
			$exec = $attr2_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr2_false) )
	{
		if	(gettype($attr2_false) === '' && gettype($attr2_false) === '1')
			$exec = $$attr2_false == false;
		else
			$exec = $attr2_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr2_contains) )
		$exec = in_array($attr2_value,explode(',',$attr2_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr2_equals)&& isset($attr2_value) )
		$exec = $attr2_equals == $attr2_value;

	// Vergleich auf leer
	elseif	( isset($attr2_empty) )
	{
		if	( !isset($$attr2_empty) )
			$exec = empty($attr2_empty);
		elseif	( is_array($$attr2_empty) )
			$exec = (count($$attr2_empty)==0);
		elseif	( is_bool($$attr2_empty) )
			$exec = true;
		else
			$exec = empty( $$attr2_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr2_present) )
	{
		$exec = isset($$attr2_present);
//		if	( !isset($$attr2_present) )
//			$exec = false;
//		elseif	( is_array($$attr2_present) )
//			$exec = (count($$attr2_present)>0);
//		elseif	( is_bool($$attr2_present) )
//			$exec = $$attr2_present;
//		elseif	( is_numeric($$attr2_present) )
//			$exec = $$attr2_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr2 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr2_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr2_not) )
		$exec = !$exec;

	unset($attr2_true);
	unset($attr2_false);
	unset($attr2_notempty);
	unset($attr2_empty);
	unset($attr2_contains);
	unset($attr2_present);
	unset($attr2_invert);
	unset($attr2_not);
	unset($attr2_value);
	unset($attr2_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr2) ?><?php unset($attr2_present) ?><?php $attr3 = array('field'=>'login_password') ?><?php $attr3_field='login_password' ?>
<script name="JavaScript" type="text/javascript">
<!--
document.forms[0].<?php echo $attr3_field ?>.focus();
document.forms[0].<?php echo $attr3_field ?>.select();
// -->
</script>
<?php unset($attr3) ?><?php unset($attr3_field) ?><?php $attr1 = array() ?><?php
	}
	
?><?php unset($attr1) ?><?php $attr2 = array() ?><?php
	if	( !$last_exec )
	{
?><?php unset($attr2) ?><?php $attr3 = array('field'=>'login_name') ?><?php $attr3_field='login_name' ?>
<script name="JavaScript" type="text/javascript">
<!--
document.forms[0].<?php echo $attr3_field ?>.focus();
document.forms[0].<?php echo $attr3_field ?>.select();
// -->
</script>
<?php unset($attr3) ?><?php unset($attr3_field) ?><?php $attr1 = array() ?><?php
	}
?><?php unset($attr1) ?><?php $attr0 = array() ?>
<!-- $Id$ -->

<?php if ($showDuration) { ?>
<br/>
<small>&nbsp;
<?php $dur = time()-START_TIME;
//      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small>
<?php } ?>

</body>
</html><?php unset($attr0) ?>