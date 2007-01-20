<?php $attr = array('class'=>'main') ?><?php $attr_class='main' ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
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

<body class="<?php echo $attr_class ?>">


<?php unset($attr) ?><?php unset($attr_class) ?><?php $attr = array('action'=>'index','subaction'=>'login','name'=>'','target'=>'_top','method'=>'post','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr_action='index' ?><?php $attr_subaction='login' ?><?php $attr_name='' ?><?php $attr_target='_top' ?><?php $attr_method='post' ?><?php $attr_enctype='application/x-www-form-urlencoded' ?><?php
	if	(empty($attr_action))
		$attr_action = $actionName;
	if	(empty($attr_subaction))
		$attr_subaction = $targetSubActionName;
	if	(empty($attr_id))
		$attr_id = $this->getRequestId();
		
?><form name="<?php echo $attr_name ?>"
      target="<?php echo $attr_target ?>"
      action="<?php echo Html::url( $attr_action,$attr_subaction,$attr_id ) ?>"
      method="<?php echo $attr_method ?>"
      enctype="<?php echo $attr_enctype ?>">
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr) ?><?php unset($attr_action) ?><?php unset($attr_subaction) ?><?php unset($attr_name) ?><?php unset($attr_target) ?><?php unset($attr_method) ?><?php unset($attr_enctype) ?><?php $attr = array('title'=>'GLOBAL_LOGIN','name'=>'login','icon'=>'user','width'=>'400','rowclasses'=>'odd,even','columnclasses'=>'1,2,3') ?><?php $attr_title='GLOBAL_LOGIN' ?><?php $attr_name='login' ?><?php $attr_icon='user' ?><?php $attr_width='400' ?><?php $attr_rowclasses='odd,even' ?><?php $attr_columnclasses='1,2,3' ?><?php
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
      <table class="n" cellspacing="0" width="100%" cellpadding="4"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_name) ?><?php unset($attr_icon) ?><?php unset($attr_width) ?><?php unset($attr_rowclasses) ?><?php unset($attr_columnclasses) ?><?php $attr = array('present'=>$conf['login']['logo']['file']) ?><?php $attr_present=$conf['login']['logo']['file'] ?><?php 

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
			$exec = !empty($attr_present);
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( isset($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = !empty($attr_notempty);
		elseif	( is_array($$attr_notempty) )
			$exec = (count($$attr_notempty)>0);
		elseif	( is_bool($$attr_notempty) )
			$exec = true;
		elseif	( is_numeric($$attr_notempty) )
			$exec = $$attr_notempty>=0;
		else
			$exec = !empty( $$attr_notempty );
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

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_present) ?><?php $attr = array('false'=>$this->mustChangePassword) ?><?php $attr_false=$this->mustChangePassword ?><?php 

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
			$exec = !empty($attr_present);
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( isset($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = !empty($attr_notempty);
		elseif	( is_array($$attr_notempty) )
			$exec = (count($$attr_notempty)>0);
		elseif	( is_bool($$attr_notempty) )
			$exec = true;
		elseif	( is_numeric($$attr_notempty) )
			$exec = $$attr_notempty>=0;
		else
			$exec = !empty( $$attr_notempty );
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

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr_class))
		$attr_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr_class ?>"><?php unset($attr) ?><?php $attr = array('colspan'=>'2') ?><?php $attr_colspan='2' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_colspan) ?><?php $attr = array('present'=>$conf['login']['logo']['url']) ?><?php $attr_present=$conf['login']['logo']['url'] ?><?php 

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
			$exec = !empty($attr_present);
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( isset($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = !empty($attr_notempty);
		elseif	( is_array($$attr_notempty) )
			$exec = (count($$attr_notempty)>0);
		elseif	( is_bool($$attr_notempty) )
			$exec = true;
		elseif	( is_numeric($$attr_notempty) )
			$exec = $$attr_notempty>=0;
		else
			$exec = !empty( $$attr_notempty );
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

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_present) ?><?php $attr = array('title'=>'','target'=>'_top','url'=>$conf['login']['logo']['url'],'class'=>'') ?><?php $attr_title='' ?><?php $attr_target='_top' ?><?php $attr_url=$conf['login']['logo']['url'] ?><?php $attr_class='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo $attr_title ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php $attr = array('url'=>$conf['login']['logo']['file'],'align'=>'left') ?><?php $attr_url=$conf['login']['logo']['file'] ?><?php $attr_align='left' ?><?php
if (isset($attr_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$$attr_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif(!empty($attr_config)) {
		global $conf;
		$c = $conf;
		$path = explode('/',$attr_config);
		foreach($path as $part)
			$c = $c[$part]; 
		$tmp_url = $c;
?><img src="<?php echo $tmp_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
	}   
elseif (isset($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$$attr_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_url)) {
?><img src="<?php echo $attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_file)) {
?><img src="<?php echo $image_dir.$$attr_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?><?php unset($attr) ?><?php unset($attr_url) ?><?php unset($attr_align) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array() ?><?php
	}
	
	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_value);
	unset($attr_var);
?><?php unset($attr) ?><?php $attr = array('empty'=>$conf['login']['logo']['url']) ?><?php $attr_empty=$conf['login']['logo']['url'] ?><?php 

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
			$exec = !empty($attr_present);
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( isset($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = !empty($attr_notempty);
		elseif	( is_array($$attr_notempty) )
			$exec = (count($$attr_notempty)>0);
		elseif	( is_bool($$attr_notempty) )
			$exec = true;
		elseif	( is_numeric($$attr_notempty) )
			$exec = $$attr_notempty>=0;
		else
			$exec = !empty( $$attr_notempty );
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

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_empty) ?><?php $attr = array('url'=>$conf['login']['logo']['file'],'align'=>'left') ?><?php $attr_url=$conf['login']['logo']['file'] ?><?php $attr_align='left' ?><?php
if (isset($attr_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$$attr_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif(!empty($attr_config)) {
		global $conf;
		$c = $conf;
		$path = explode('/',$attr_config);
		foreach($path as $part)
			$c = $c[$part]; 
		$tmp_url = $c;
?><img src="<?php echo $tmp_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
	}   
elseif (isset($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$$attr_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_url)) {
?><img src="<?php echo $attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (isset($attr_file)) {
?><img src="<?php echo $image_dir.$$attr_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?><?php unset($attr) ?><?php unset($attr_url) ?><?php unset($attr_align) ?><?php $attr = array() ?><?php
	}
	
	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_value);
	unset($attr_var);
?><?php unset($attr) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
	
	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_value);
	unset($attr_var);
?><?php unset($attr) ?><?php $attr = array() ?><?php
	}
	
	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_value);
	unset($attr_var);
?><?php unset($attr) ?><?php $attr = array('present'=>$conf['login']['motd']) ?><?php $attr_present=$conf['login']['motd'] ?><?php 

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
			$exec = !empty($attr_present);
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( isset($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = !empty($attr_notempty);
		elseif	( is_array($$attr_notempty) )
			$exec = (count($$attr_notempty)>0);
		elseif	( is_bool($$attr_notempty) )
			$exec = true;
		elseif	( is_numeric($$attr_notempty) )
			$exec = $$attr_notempty>=0;
		else
			$exec = !empty( $$attr_notempty );
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

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_present) ?><?php $attr = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr_class))
		$attr_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr_class ?>"><?php unset($attr) ?><?php $attr = array('class'=>'motd','colspan'=>'2') ?><?php $attr_class='motd' ?><?php $attr_colspan='2' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('class'=>'text','raw'=>$conf['login']['motd']) ?><?php $attr_class='text' ?><?php $attr_raw=$conf['login']['motd'] ?><?php
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
		$tmp_text = lang($$attr_text);
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
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_raw) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
	
	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_value);
	unset($attr_var);
?><?php unset($attr) ?><?php $attr = array('true'=>$conf['login']['nologin']) ?><?php $attr_true=$conf['login']['nologin'] ?><?php 

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
			$exec = !empty($attr_present);
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( isset($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = !empty($attr_notempty);
		elseif	( is_array($$attr_notempty) )
			$exec = (count($$attr_notempty)>0);
		elseif	( is_bool($$attr_notempty) )
			$exec = true;
		elseif	( is_numeric($$attr_notempty) )
			$exec = $$attr_notempty>=0;
		else
			$exec = !empty( $$attr_notempty );
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

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_true) ?><?php $attr = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr_class))
		$attr_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr_class ?>"><?php unset($attr) ?><?php $attr = array('class'=>'help','colspan'=>'2') ?><?php $attr_class='help' ?><?php $attr_colspan='2' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('class'=>'text','key'=>'LOGIN_NOLOGIN_DESC') ?><?php $attr_class='text' ?><?php $attr_key='LOGIN_NOLOGIN_DESC' ?><?php
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
		$tmp_text = lang($$attr_text);
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
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_key) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
	
	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_value);
	unset($attr_var);
?><?php unset($attr) ?><?php $attr = array('true'=>$conf['security']['readonly']) ?><?php $attr_true=$conf['security']['readonly'] ?><?php 

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
			$exec = !empty($attr_present);
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( isset($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = !empty($attr_notempty);
		elseif	( is_array($$attr_notempty) )
			$exec = (count($$attr_notempty)>0);
		elseif	( is_bool($$attr_notempty) )
			$exec = true;
		elseif	( is_numeric($$attr_notempty) )
			$exec = $$attr_notempty>=0;
		else
			$exec = !empty( $$attr_notempty );
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

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_true) ?><?php $attr = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr_class))
		$attr_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr_class ?>"><?php unset($attr) ?><?php $attr = array('class'=>'help','colspan'=>'2') ?><?php $attr_class='help' ?><?php $attr_colspan='2' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('class'=>'text','key'=>'GLOBAL_READONLY_DESC') ?><?php $attr_class='text' ?><?php $attr_key='GLOBAL_READONLY_DESC' ?><?php
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
		$tmp_text = lang($$attr_text);
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
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_key) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
	
	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_value);
	unset($attr_var);
?><?php unset($attr) ?><?php $attr = array('true'=>$conf['security']['nopublish']) ?><?php $attr_true=$conf['security']['nopublish'] ?><?php 

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
			$exec = !empty($attr_present);
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( isset($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = !empty($attr_notempty);
		elseif	( is_array($$attr_notempty) )
			$exec = (count($$attr_notempty)>0);
		elseif	( is_bool($$attr_notempty) )
			$exec = true;
		elseif	( is_numeric($$attr_notempty) )
			$exec = $$attr_notempty>=0;
		else
			$exec = !empty( $$attr_notempty );
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

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_true) ?><?php $attr = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr_class))
		$attr_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr_class ?>"><?php unset($attr) ?><?php $attr = array('class'=>'help','colspan'=>'2') ?><?php $attr_class='help' ?><?php $attr_colspan='2' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('class'=>'text','key'=>'GLOBAL_NOPUBLISH_DESC') ?><?php $attr_class='text' ?><?php $attr_key='GLOBAL_NOPUBLISH_DESC' ?><?php
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
		$tmp_text = lang($$attr_text);
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
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_key) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
	
	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_value);
	unset($attr_var);
?><?php unset($attr) ?><?php $attr = array('false'=>$conf['login']['nologin']) ?><?php $attr_false=$conf['login']['nologin'] ?><?php 

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
			$exec = !empty($attr_present);
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( isset($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = !empty($attr_notempty);
		elseif	( is_array($$attr_notempty) )
			$exec = (count($$attr_notempty)>0);
		elseif	( is_bool($$attr_notempty) )
			$exec = true;
		elseif	( is_numeric($$attr_notempty) )
			$exec = $$attr_notempty>=0;
		else
			$exec = !empty( $$attr_notempty );
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

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr_class))
		$attr_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr_class ?>"><?php unset($attr) ?><?php $attr = array('class'=>'logo','colspan'=>'2') ?><?php $attr_class='logo' ?><?php $attr_colspan='2' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('name'=>'login') ?><?php $attr_name='login' ?><img src="<?php echo $image_dir.'logo_'.$attr_name.IMG_ICON_EXT ?>" border="0" align="left"><h2 class="logo"><?php echo lang('logo_'.$attr_name) ?></h2><p class="logo"><?php echo lang('logo_'.$attr_name.'_text') ?></p><?php unset($attr) ?><?php unset($attr_name) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr_class))
		$attr_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr_class ?>"><?php unset($attr) ?><?php $attr = array('width'=>'50%','class'=>'fx') ?><?php $attr_width='50%' ?><?php $attr_class='fx' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_class) ?><?php $attr = array('class'=>'text','key'=>'USER_USERNAME') ?><?php $attr_class='text' ?><?php $attr_key='USER_USERNAME' ?><?php
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
		$tmp_text = lang($$attr_text);
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
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_key) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'50%','class'=>'fx') ?><?php $attr_width='50%' ?><?php $attr_class='fx' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_class) ?><?php $attr = array('class'=>'','default'=>'','type'=>'text','name'=>'login_name','value'=>'','size'=>'25','maxlength'=>'256','onchange'=>'') ?><?php $attr_class='' ?><?php $attr_default='' ?><?php $attr_type='text' ?><?php $attr_name='login_name' ?><?php $attr_value='' ?><?php $attr_size='25' ?><?php $attr_maxlength='256' ?><?php $attr_onchange='' ?><input name="<?php echo $attr_name ?>" size="<?php echo $attr_size ?>" maxlength="<?php echo $attr_maxlength ?>" class="<?php echo $attr_class ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" onxxxMouseOver="this.focus();"  /><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_default) ?><?php unset($attr_type) ?><?php unset($attr_name) ?><?php unset($attr_value) ?><?php unset($attr_size) ?><?php unset($attr_maxlength) ?><?php unset($attr_onchange) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr_class))
		$attr_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr_class ?>"><?php unset($attr) ?><?php $attr = array('width'=>'50%','class'=>'fx') ?><?php $attr_width='50%' ?><?php $attr_class='fx' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_class) ?><?php $attr = array('class'=>'text','key'=>'USER_PASSWORD') ?><?php $attr_class='text' ?><?php $attr_key='USER_PASSWORD' ?><?php
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
		$tmp_text = lang($$attr_text);
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
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_key) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'50%','class'=>'fx') ?><?php $attr_width='50%' ?><?php $attr_class='fx' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_class) ?><?php $attr = array('name'=>'login_password','default'=>'','class'=>'','size'=>'25','maxlength'=>'256') ?><?php $attr_name='login_password' ?><?php $attr_default='' ?><?php $attr_class='' ?><?php $attr_size='25' ?><?php $attr_maxlength='256' ?><input type="password" name="<?php echo $attr_name ?>" size="<?php echo $attr_size ?>" maxlength="<?php echo $attr_maxlength ?>" class="<?php echo $attr_class ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" /><?php unset($attr) ?><?php unset($attr_name) ?><?php unset($attr_default) ?><?php unset($attr_class) ?><?php unset($attr_size) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array('true'=>$this->mustChangePassword) ?><?php $attr_true=$this->mustChangePassword ?><?php 

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
			$exec = !empty($attr_present);
		elseif	( is_array($$attr_present) )
			$exec = (count($$attr_present)>0);
		elseif	( is_bool($$attr_present) )
			$exec = true;
		elseif	( is_numeric($$attr_present) )
			$exec = $$attr_present>=0;
		else
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( isset($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = !empty($attr_notempty);
		elseif	( is_array($$attr_notempty) )
			$exec = (count($$attr_notempty)>0);
		elseif	( is_bool($$attr_notempty) )
			$exec = true;
		elseif	( is_numeric($$attr_notempty) )
			$exec = $$attr_notempty>=0;
		else
			$exec = !empty( $$attr_notempty );
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

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_true) ?><?php $attr = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr_class))
		$attr_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr_class ?>"><?php unset($attr) ?><?php $attr = array('width'=>'50%','class'=>'fx') ?><?php $attr_width='50%' ?><?php $attr_class='fx' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_class) ?><?php $attr = array('class'=>'text','key'=>'USER_NEW_PASSWORD') ?><?php $attr_class='text' ?><?php $attr_key='USER_NEW_PASSWORD' ?><?php
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
		$tmp_text = lang($$attr_text);
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
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_key) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'50%','class'=>'fx') ?><?php $attr_width='50%' ?><?php $attr_class='fx' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_class) ?><?php $attr = array('name'=>'password1','default'=>'','class'=>'','size'=>'25','maxlength'=>'256') ?><?php $attr_name='password1' ?><?php $attr_default='' ?><?php $attr_class='' ?><?php $attr_size='25' ?><?php $attr_maxlength='256' ?><input type="password" name="<?php echo $attr_name ?>" size="<?php echo $attr_size ?>" maxlength="<?php echo $attr_maxlength ?>" class="<?php echo $attr_class ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" /><?php unset($attr) ?><?php unset($attr_name) ?><?php unset($attr_default) ?><?php unset($attr_class) ?><?php unset($attr_size) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr_class))
		$attr_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr_class ?>"><?php unset($attr) ?><?php $attr = array('width'=>'50%','class'=>'fx') ?><?php $attr_width='50%' ?><?php $attr_class='fx' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_class) ?><?php $attr = array('class'=>'text','key'=>'USER_NEW_PASSWORD_REPEAT') ?><?php $attr_class='text' ?><?php $attr_key='USER_NEW_PASSWORD_REPEAT' ?><?php
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
		$tmp_text = lang($$attr_text);
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
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_key) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'50%','class'=>'fx') ?><?php $attr_width='50%' ?><?php $attr_class='fx' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_class) ?><?php $attr = array('name'=>'password2','default'=>'','class'=>'','size'=>'25','maxlength'=>'256') ?><?php $attr_name='password2' ?><?php $attr_default='' ?><?php $attr_class='' ?><?php $attr_size='25' ?><?php $attr_maxlength='256' ?><input type="password" name="<?php echo $attr_name ?>" size="<?php echo $attr_size ?>" maxlength="<?php echo $attr_maxlength ?>" class="<?php echo $attr_class ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" /><?php unset($attr) ?><?php unset($attr_name) ?><?php unset($attr_default) ?><?php unset($attr_class) ?><?php unset($attr_size) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
	
	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_value);
	unset($attr_var);
?><?php unset($attr) ?><?php $attr = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr_class))
		$attr_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr_class ?>"><?php unset($attr) ?><?php $attr = array('width'=>'50%','class'=>'fx') ?><?php $attr_width='50%' ?><?php $attr_class='fx' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_class) ?><?php $attr = array('class'=>'text','key'=>'GLOBAL_DATABASE') ?><?php $attr_class='text' ?><?php $attr_key='GLOBAL_DATABASE' ?><?php
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
		$tmp_text = lang($$attr_text);
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
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_key) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'50%','class'=>'fx') ?><?php $attr_width='50%' ?><?php $attr_class='fx' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_class) ?><?php $attr = array('list'=>'dbids','name'=>'dbid','default'=>'actdbid','onchange'=>'','class'=>'') ?><?php $attr_list='dbids' ?><?php $attr_name='dbid' ?><?php $attr_default='actdbid' ?><?php $attr_onchange='' ?><?php $attr_class='' ?><select size="1" name="<?php echo $attr_name ?>" onchange="<?php echo $attr_onchange ?>" title="<?php echo $attr_title ?>" class="<?php echo $attr_class ?>"<?php
if (count($$attr_list)==1) echo ' disabled="disabled"'
?>><?php
		foreach( $$attr_list as $box_key=>$box_value )
		{
			echo '<option class="'.$attr_class.'" value="'.$box_key.'"';
			if (isset($$attr_name)&&$box_key==$$attr_name || isset($$attr_default)&&$box_key == $$attr_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr_list)==1) echo '<input type="hidden" name="'.$attr_name.'" value="'.$box_key.'" />'
?><?php unset($attr) ?><?php unset($attr_list) ?><?php unset($attr_name) ?><?php unset($attr_default) ?><?php unset($attr_onchange) ?><?php unset($attr_class) ?><?php $attr = array('name'=>'screenwidth','default'=>'9999') ?><?php $attr_name='screenwidth' ?><?php $attr_default='9999' ?><input type="hidden" name="<?php echo $attr_name ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" /><?php unset($attr) ?><?php unset($attr_name) ?><?php unset($attr_default) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr_class))
		$attr_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr_class ?>"><?php unset($attr) ?><?php $attr = array('class'=>'act','colspan'=>'2') ?><?php $attr_class='act' ?><?php $attr_colspan='2' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('type'=>'ok','class'=>'ok','value'=>'ok','text'=>'button_ok') ?><?php $attr_type='ok' ?><?php $attr_class='ok' ?><?php $attr_value='ok' ?><?php $attr_text='button_ok' ?><?php
	if ($attr_type=='ok')
	{
		$attr_type  = 'submit';
//		$attr_class = 'ok';
//		$attr_text  = 'BUTTON_OK';
//		$attr_value = 'ok';
	}
?><input type="<?php echo $attr_type ?>" name="<?php echo $attr_value ?>" class="<?php echo $attr_class ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($attr_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr) ?><?php unset($attr_type) ?><?php unset($attr_class) ?><?php unset($attr_value) ?><?php unset($attr_text) ?><script name="javascript1.2" type="text/javascript">
<!--
document.forms[0].screenwidth.value=window.innerWidth;
//	-->
</script>
<?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
	
	unset($attr_true);
	unset($attr_false);
	unset($attr_notempty);
	unset($attr_empty);
	unset($attr_contains);
	unset($attr_present);
	unset($attr_invert);
	unset($attr_value);
	unset($attr_var);
?><?php unset($attr) ?><?php $attr = array() ?>      </table>
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
<?php unset($attr) ?><?php $attr = array() ?></form>

<?php unset($attr) ?><?php $attr = array() ?><br/><?php unset($attr) ?><?php $attr = array() ?><br/><?php unset($attr) ?><?php $attr = array('title'=>'','target'=>'_top','url'=>$conf['login']['gpl']['url'],'class'=>'') ?><?php $attr_title='' ?><?php $attr_target='_top' ?><?php $attr_url=$conf['login']['gpl']['url'] ?><?php $attr_class='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo $attr_title ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php $attr = array('class'=>'text','value'=>lang('GLOBAL_GPL')) ?><?php $attr_class='text' ?><?php $attr_value=lang('GLOBAL_GPL') ?><?php
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
		$tmp_text = lang($$attr_text);
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
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_value) ?><?php $attr = array() ?></a><?php unset($attr) ?><?php $attr = array('field'=>'login_name') ?><?php $attr_field='login_name' ?>
<script name="JavaScript" type="text/javascript">
<!--
document.forms[0].<?php echo $attr_field ?>.focus();
document.forms[0].<?php echo $attr_field ?>.select();
// -->
</script>
<?php unset($attr) ?><?php unset($attr_field) ?><?php $attr = array() ?>
<!-- $Id$ -->

<?php if ($showDuration) { ?>
<br/>
<small>&nbsp;
<?php $dur = time()-START_TIME;
//      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small>
<?php } ?>

</body>
</html><?php unset($attr) ?>