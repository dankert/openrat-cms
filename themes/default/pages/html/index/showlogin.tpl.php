<?php /* source: ./themes/default/include/html/page.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('class'=>'') ?><?php $attr_class='' ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
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


<?php unset($attr) ?><?php unset($attr_class) ?><?php /* source: ./themes/default/include/html/form.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('action'=>'index','subaction'=>'login','id'=>'','name'=>'','target'=>'_top','method'=>'post','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr_action='index' ?><?php $attr_subaction='login' ?><?php $attr_id='' ?><?php $attr_name='' ?><?php $attr_target='_top' ?><?php $attr_method='post' ?><?php $attr_enctype='application/x-www-form-urlencoded' ?><?php
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
?><?php unset($attr) ?><?php unset($attr_action) ?><?php unset($attr_subaction) ?><?php unset($attr_id) ?><?php unset($attr_name) ?><?php unset($attr_target) ?><?php unset($attr_method) ?><?php unset($attr_enctype) ?><?php /* source: ./themes/default/include/html/window.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('title'=>'GLOBAL_LOGIN','name'=>'login','icon'=>'','widths'=>'','width'=>'400') ?><?php $attr_title='GLOBAL_LOGIN' ?><?php $attr_name='login' ?><?php $attr_icon='' ?><?php $attr_widths='' ?><?php $attr_width='400' ?><?php
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
      <table class="n" cellspacing="0" width="100%" cellpadding="4"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_name) ?><?php unset($attr_icon) ?><?php unset($attr_widths) ?><?php unset($attr_width) ?><?php /* source: ./themes/default/include/html/if.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'logo','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='logo' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'','colspan'=>'2') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='' ?><?php $attr_colspan='2' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/if.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'logo_url','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='logo_url' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php /* source: ./themes/default/include/html/link.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('title'=>'','target'=>'_top','url'=>'logo_url','class'=>'','action'=>'','subaction'=>'','id'=>'','var1'=>'','value1'=>'') ?><?php $attr_title='' ?><?php $attr_target='_top' ?><?php $attr_url='logo_url' ?><?php $attr_class='' ?><?php $attr_action='' ?><?php $attr_subaction='' ?><?php $attr_id='' ?><?php $attr_var1='' ?><?php $attr_value1='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $$attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo hasLang($attr_title)?lang($attr_title):lang($$attr_title) ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php unset($attr_action) ?><?php unset($attr_subaction) ?><?php unset($attr_id) ?><?php unset($attr_var1) ?><?php unset($attr_value1) ?><?php /* source: ./themes/default/include/html/image.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('file'=>'','url'=>'logo','align'=>'left','type'=>'','elementtype'=>'') ?><?php $attr_file='' ?><?php $attr_url='logo' ?><?php $attr_align='left' ?><?php $attr_type='' ?><?php $attr_elementtype='' ?><?php
if (!empty($attr_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$$attr_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$$attr_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($$attr_url)) {
?><img src="<?php echo $$attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_file)) {
?><img src="<?php echo $image_dir.$$attr_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?><?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_url) ?><?php unset($attr_align) ?><?php unset($attr_type) ?><?php unset($attr_elementtype) ?><?php /* source: ./themes/default/include/html/link-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></a><?php unset($attr) ?><?php /* source: ./themes/default/include/html/if-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php /* source: ./themes/default/include/html/if.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'logo_url','present'=>'','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='logo_url' ?><?php $attr_present='' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php /* source: ./themes/default/include/html/image.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('file'=>'','url'=>'logo','align'=>'left','type'=>'','elementtype'=>'') ?><?php $attr_file='' ?><?php $attr_url='logo' ?><?php $attr_align='left' ?><?php $attr_type='' ?><?php $attr_elementtype='' ?><?php
if (!empty($attr_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$$attr_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$$attr_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($$attr_url)) {
?><img src="<?php echo $$attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_file)) {
?><img src="<?php echo $image_dir.$$attr_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?><?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_url) ?><?php unset($attr_align) ?><?php unset($attr_type) ?><?php unset($attr_elementtype) ?><?php /* source: ./themes/default/include/html/if-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></td><?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/if-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php /* source: ./themes/default/include/html/if.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'motd','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='motd' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'motd','colspan'=>'2') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='motd' ?><?php $attr_colspan='2' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'motd','text'=>'','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='motd' ?><?php $attr_text='' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
		$tmp_text = isset($$attr_var)?$$attr_var:'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></td><?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/if-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php /* source: ./themes/default/include/html/if.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'','contains'=>'','true'=>'nologin','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='' ?><?php $attr_contains='' ?><?php $attr_true='nologin' ?><?php $attr_false='' ?><?php 

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
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'help','colspan'=>'2') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='help' ?><?php $attr_colspan='2' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'LOGIN_NOLOGIN_DESC','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='LOGIN_NOLOGIN_DESC' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
		$tmp_text = isset($$attr_var)?$$attr_var:'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></td><?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/if-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php /* source: ./themes/default/include/html/if.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'','contains'=>'','true'=>'readonly','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='' ?><?php $attr_contains='' ?><?php $attr_true='readonly' ?><?php $attr_false='' ?><?php 

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
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'help','colspan'=>'2') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='help' ?><?php $attr_colspan='2' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'GLOBAL_READONLY_DESC','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='GLOBAL_READONLY_DESC' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
		$tmp_text = isset($$attr_var)?$$attr_var:'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></td><?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/if-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php /* source: ./themes/default/include/html/if.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'','contains'=>'','true'=>'nopublish','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='' ?><?php $attr_contains='' ?><?php $attr_true='nopublish' ?><?php $attr_false='' ?><?php 

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
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'help','colspan'=>'2') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='help' ?><?php $attr_colspan='2' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'GLOBAL_NOPUBLISH_DESC','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='GLOBAL_NOPUBLISH_DESC' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
		$tmp_text = isset($$attr_var)?$$attr_var:'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></td><?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/if-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php /* source: ./themes/default/include/html/if.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'','contains'=>'','true'=>'','false'=>'nologin') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='nologin' ?><?php 

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
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('width'=>'50%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='50%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'USER_USERNAME','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='USER_USERNAME' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
		$tmp_text = isset($$attr_var)?$$attr_var:'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></td><?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('width'=>'50%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='50%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/input.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('class'=>'','default'=>'','type'=>'text','index'=>'','name'=>'login_name','prefix'=>'','value'=>'','size'=>'25','maxlength'=>'256','onchange'=>'') ?><?php $attr_class='' ?><?php $attr_default='' ?><?php $attr_type='text' ?><?php $attr_index='' ?><?php $attr_name='login_name' ?><?php $attr_prefix='' ?><?php $attr_value='' ?><?php $attr_size='25' ?><?php $attr_maxlength='256' ?><?php $attr_onchange='' ?><input name="<?php echo $attr_name ?>" size="<?php echo $attr_size ?>" maxlength="<?php echo $attr_maxlength ?>" class="<?php echo $attr_class ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" /><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_default) ?><?php unset($attr_type) ?><?php unset($attr_index) ?><?php unset($attr_name) ?><?php unset($attr_prefix) ?><?php unset($attr_value) ?><?php unset($attr_size) ?><?php unset($attr_maxlength) ?><?php unset($attr_onchange) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></td><?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('width'=>'50%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='50%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'USER_PASSWORD','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='USER_PASSWORD' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
		$tmp_text = isset($$attr_var)?$$attr_var:'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></td><?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('width'=>'50%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='50%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/password.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('name'=>'login_password','default'=>'','class'=>'','size'=>'25','maxlength'=>'256') ?><?php $attr_name='login_password' ?><?php $attr_default='' ?><?php $attr_class='' ?><?php $attr_size='25' ?><?php $attr_maxlength='256' ?><input type="password" name="<?php echo $attr_name ?>" size="<?php echo $attr_size ?>" maxlength="<?php echo $attr_maxlength ?>" class="<?php echo $attr_class ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" /><?php unset($attr) ?><?php unset($attr_name) ?><?php unset($attr_default) ?><?php unset($attr_class) ?><?php unset($attr_size) ?><?php unset($attr_maxlength) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></td><?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('width'=>'50%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='50%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'GLOBAL_DATABASE','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='GLOBAL_DATABASE' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
		$tmp_text = isset($$attr_var)?$$attr_var:'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></td><?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('width'=>'50%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='50%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/selectbox.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('list'=>'dbids','name'=>'dbid','default'=>'actdbid','onchange'=>'','title'=>'','class'=>'') ?><?php $attr_list='dbids' ?><?php $attr_name='dbid' ?><?php $attr_default='actdbid' ?><?php $attr_onchange='' ?><?php $attr_title='' ?><?php $attr_class='' ?><select size="1" name="<?php echo $attr_name ?>" onchange="<?php echo $attr_onchange ?>" title="<?php echo $attr_title ?>" class="<?php echo $attr_class ?>"<?php
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
?><?php unset($attr) ?><?php unset($attr_list) ?><?php unset($attr_name) ?><?php unset($attr_default) ?><?php unset($attr_onchange) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php /* source: ./themes/default/include/html/hidden.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('name'=>'screenwidth','default'=>'9999') ?><?php $attr_name='screenwidth' ?><?php $attr_default='9999' ?><input type="hidden" name="<?php echo $attr_name ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" /><?php unset($attr) ?><?php unset($attr_name) ?><?php unset($attr_default) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></td><?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'act','colspan'=>'2') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='act' ?><?php $attr_colspan='2' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/button.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('type'=>'ok') ?><?php $attr_type='ok' ?><?php
	if ($attr_type=='ok')
	{
		$attr_type  = 'submit';
		$attr_class = 'ok';
		$attr_text  = 'BUTTON_OK';
		$attr_value = 'ok';
	}
?><input type="<?php echo $attr_type ?>" name="<?php echo $attr_value ?>" class="<?php echo $attr_class ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($attr_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr) ?><?php unset($attr_type) ?><script name="javascript1.2" type="text/javascript">
<!--
document.forms[0].screenwidth.value=window.innerWidth;
</script>
<?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></td><?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/if-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php /* source: ./themes/default/include/html/window-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?>      </table>
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
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/form-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></form><?php unset($attr) ?><?php /* source: ./themes/default/include/html/newline.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><br/><?php unset($attr) ?><?php /* source: ./themes/default/include/html/newline.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?><br/><?php unset($attr) ?><?php /* source: ./themes/default/include/html/link.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('title'=>'','target'=>'_top','url'=>'http://www.gnu.org/copyleft/gpl.html','class'=>'','action'=>'','subaction'=>'','id'=>'','var1'=>'','value1'=>'') ?><?php $attr_title='' ?><?php $attr_target='_top' ?><?php $attr_url='http://www.gnu.org/copyleft/gpl.html' ?><?php $attr_class='' ?><?php $attr_action='' ?><?php $attr_subaction='' ?><?php $attr_id='' ?><?php $attr_var1='' ?><?php $attr_value1='' ?><?php
	if(!empty($attr_url))
		$tmp_url = $$attr_url;
	else
		$tmp_url = Html::url($attr_action,$attr_subaction,!empty($$attr_id)?$$attr_id:$this->getRequestId(),array(!empty($var1)?$var1:'asdf'=>!empty($value1)?$$value1:''));
?><a href="<?php echo $tmp_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo hasLang($attr_title)?lang($attr_title):lang($$attr_title) ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php unset($attr_action) ?><?php unset($attr_subaction) ?><?php unset($attr_id) ?><?php unset($attr_var1) ?><?php unset($attr_value1) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'GLOBAL_GPL','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='GLOBAL_GPL' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
		$tmp_text = isset($$attr_var)?$$attr_var:'error: variable '.$attr_var.' not present';	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php /* source: ./themes/default/include/html/link-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?></a><?php unset($attr) ?><?php /* source: ./themes/default/include/html/focus.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array('field'=>'login_name') ?><?php $attr_field='login_name' ?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $attr_field ?>.focus();
document.forms[0].<?php echo $attr_field ?>.select();
//--></script>
<?php unset($attr) ?><?php unset($attr_field) ?><?php /* source: ./themes/default/include/html/page-end.inc.php - compile time: Mon, 30 Jan 2006 22:25:51 +0100 */ ?><?php $attr = array() ?>
<!-- $Id$ -->

<?php if ($showDuration) { ?>
<br/>
<small>&nbsp;
<?php $dur = time()-START_TIME;
//      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small>
<?php } ?>

</body>
</html><?php unset($attr) ?>