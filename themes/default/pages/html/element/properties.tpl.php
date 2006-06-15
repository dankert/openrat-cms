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


<?php unset($attr) ?><?php unset($attr_class) ?><?php $attr = array('action'=>'','subaction'=>'','id'=>'','name'=>'','target'=>'_self','method'=>'post','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr_action='' ?><?php $attr_subaction='' ?><?php $attr_id='' ?><?php $attr_name='' ?><?php $attr_target='_self' ?><?php $attr_method='post' ?><?php $attr_enctype='application/x-www-form-urlencoded' ?><?php
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
?><?php unset($attr) ?><?php unset($attr_action) ?><?php unset($attr_subaction) ?><?php unset($attr_id) ?><?php unset($attr_name) ?><?php unset($attr_target) ?><?php unset($attr_method) ?><?php unset($attr_enctype) ?><?php $attr = array('title'=>'','name'=>'GLOBAL_PREFS','icon'=>'','widths'=>'30%,70%','width'=>'85%') ?><?php $attr_title='' ?><?php $attr_name='GLOBAL_PREFS' ?><?php $attr_icon='' ?><?php $attr_widths='30%,70%' ?><?php $attr_width='85%' ?><?php
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
      <table class="n" cellspacing="0" width="100%" cellpadding="4"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_name) ?><?php unset($attr_icon) ?><?php unset($attr_widths) ?><?php unset($attr_width) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'subtypes','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='subtypes' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'ELEMENT_SUBTYPE','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='ELEMENT_SUBTYPE' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('list'=>'subtypes','name'=>'subtype','default'=>'','onchange'=>'','title'=>'','class'=>'') ?><?php $attr_list='subtypes' ?><?php $attr_name='subtype' ?><?php $attr_default='' ?><?php $attr_onchange='' ?><?php $attr_title='' ?><?php $attr_class='' ?><select size="1" name="<?php echo $attr_name ?>" onchange="<?php echo $attr_onchange ?>" title="<?php echo $attr_title ?>" class="<?php echo $attr_class ?>"<?php
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
?><?php unset($attr) ?><?php unset($attr_list) ?><?php unset($attr_name) ?><?php unset($attr_default) ?><?php unset($attr_onchange) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'with_icon','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='with_icon' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'EL_PROP_WITH_ICON','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='EL_PROP_WITH_ICON' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('default'=>'false','var'=>'','readonly'=>'false','name'=>'with_icon','prefix'=>'') ?><?php $attr_default='false' ?><?php $attr_var='' ?><?php $attr_readonly='false' ?><?php $attr_name='with_icon' ?><?php $attr_prefix='' ?><input type="checkbox" name="<?php echo !empty($$attr_var)?$attr_prefix.$$attr_var:$attr_name ?>" <?php if ($attr_readonly=='true') echo ' disabled="disabled"' ?> value="1" <?php if( ($attr_default=='true')||(isset($$attr_name)&&$$attr_name) ) echo 'checked="checked"' ?> /><?php unset($attr) ?><?php unset($attr_default) ?><?php unset($attr_var) ?><?php unset($attr_readonly) ?><?php unset($attr_name) ?><?php unset($attr_prefix) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'all_languages','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='all_languages' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'EL_PROP_ALL_LANGUAGES','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='EL_PROP_ALL_LANGUAGES' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('default'=>'false','var'=>'','readonly'=>'false','name'=>'all_languages','prefix'=>'') ?><?php $attr_default='false' ?><?php $attr_var='' ?><?php $attr_readonly='false' ?><?php $attr_name='all_languages' ?><?php $attr_prefix='' ?><input type="checkbox" name="<?php echo !empty($$attr_var)?$attr_prefix.$$attr_var:$attr_name ?>" <?php if ($attr_readonly=='true') echo ' disabled="disabled"' ?> value="1" <?php if( ($attr_default=='true')||(isset($$attr_name)&&$$attr_name) ) echo 'checked="checked"' ?> /><?php unset($attr) ?><?php unset($attr_default) ?><?php unset($attr_var) ?><?php unset($attr_readonly) ?><?php unset($attr_name) ?><?php unset($attr_prefix) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'writable','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='writable' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'EL_PROP_writable','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='EL_PROP_writable' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('default'=>'false','var'=>'','readonly'=>'false','name'=>'writable','prefix'=>'') ?><?php $attr_default='false' ?><?php $attr_var='' ?><?php $attr_readonly='false' ?><?php $attr_name='writable' ?><?php $attr_prefix='' ?><input type="checkbox" name="<?php echo !empty($$attr_var)?$attr_prefix.$$attr_var:$attr_name ?>" <?php if ($attr_readonly=='true') echo ' disabled="disabled"' ?> value="1" <?php if( ($attr_default=='true')||(isset($$attr_name)&&$$attr_name) ) echo 'checked="checked"' ?> /><?php unset($attr) ?><?php unset($attr_default) ?><?php unset($attr_var) ?><?php unset($attr_readonly) ?><?php unset($attr_name) ?><?php unset($attr_prefix) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'width','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='width' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'width','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='width' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('class'=>'','default'=>'','type'=>'text','index'=>'','name'=>'width','prefix'=>'','value'=>'','size'=>'10','maxlength'=>'256','onchange'=>'') ?><?php $attr_class='' ?><?php $attr_default='' ?><?php $attr_type='text' ?><?php $attr_index='' ?><?php $attr_name='width' ?><?php $attr_prefix='' ?><?php $attr_value='' ?><?php $attr_size='10' ?><?php $attr_maxlength='256' ?><?php $attr_onchange='' ?><input name="<?php echo $attr_name ?>" size="<?php echo $attr_size ?>" maxlength="<?php echo $attr_maxlength ?>" class="<?php echo $attr_class ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" /><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_default) ?><?php unset($attr_type) ?><?php unset($attr_index) ?><?php unset($attr_name) ?><?php unset($attr_prefix) ?><?php unset($attr_value) ?><?php unset($attr_size) ?><?php unset($attr_maxlength) ?><?php unset($attr_onchange) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'height','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='height' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'height','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='height' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('class'=>'','default'=>'','type'=>'text','index'=>'','name'=>'height','prefix'=>'','value'=>'','size'=>'10','maxlength'=>'256','onchange'=>'') ?><?php $attr_class='' ?><?php $attr_default='' ?><?php $attr_type='text' ?><?php $attr_index='' ?><?php $attr_name='height' ?><?php $attr_prefix='' ?><?php $attr_value='' ?><?php $attr_size='10' ?><?php $attr_maxlength='256' ?><?php $attr_onchange='' ?><input name="<?php echo $attr_name ?>" size="<?php echo $attr_size ?>" maxlength="<?php echo $attr_maxlength ?>" class="<?php echo $attr_class ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" /><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_default) ?><?php unset($attr_type) ?><?php unset($attr_index) ?><?php unset($attr_name) ?><?php unset($attr_prefix) ?><?php unset($attr_value) ?><?php unset($attr_size) ?><?php unset($attr_maxlength) ?><?php unset($attr_onchange) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'dateformat','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='dateformat' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'EL_PROP_DATEFORMAT','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='EL_PROP_DATEFORMAT' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('list'=>'dateformats','name'=>'dateformat','default'=>'','onchange'=>'','title'=>'','class'=>'') ?><?php $attr_list='dateformats' ?><?php $attr_name='dateformat' ?><?php $attr_default='' ?><?php $attr_onchange='' ?><?php $attr_title='' ?><?php $attr_class='' ?><select size="1" name="<?php echo $attr_name ?>" onchange="<?php echo $attr_onchange ?>" title="<?php echo $attr_title ?>" class="<?php echo $attr_class ?>"<?php
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
?><?php unset($attr) ?><?php unset($attr_list) ?><?php unset($attr_name) ?><?php unset($attr_default) ?><?php unset($attr_onchange) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'wiki','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='wiki' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'EL_PROP_wiki','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='EL_PROP_wiki' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('default'=>'false','var'=>'','readonly'=>'false','name'=>'wiki','prefix'=>'') ?><?php $attr_default='false' ?><?php $attr_var='' ?><?php $attr_readonly='false' ?><?php $attr_name='wiki' ?><?php $attr_prefix='' ?><input type="checkbox" name="<?php echo !empty($$attr_var)?$attr_prefix.$$attr_var:$attr_name ?>" <?php if ($attr_readonly=='true') echo ' disabled="disabled"' ?> value="1" <?php if( ($attr_default=='true')||(isset($$attr_name)&&$$attr_name) ) echo 'checked="checked"' ?> /><?php unset($attr) ?><?php unset($attr_default) ?><?php unset($attr_var) ?><?php unset($attr_readonly) ?><?php unset($attr_name) ?><?php unset($attr_prefix) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'html','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='html' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'EL_PROP_html','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='EL_PROP_html' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('default'=>'false','var'=>'','readonly'=>'false','name'=>'html','prefix'=>'') ?><?php $attr_default='false' ?><?php $attr_var='' ?><?php $attr_readonly='false' ?><?php $attr_name='html' ?><?php $attr_prefix='' ?><input type="checkbox" name="<?php echo !empty($$attr_var)?$attr_prefix.$$attr_var:$attr_name ?>" <?php if ($attr_readonly=='true') echo ' disabled="disabled"' ?> value="1" <?php if( ($attr_default=='true')||(isset($$attr_name)&&$$attr_name) ) echo 'checked="checked"' ?> /><?php unset($attr) ?><?php unset($attr_default) ?><?php unset($attr_var) ?><?php unset($attr_readonly) ?><?php unset($attr_name) ?><?php unset($attr_prefix) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'decimals','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='decimals' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'EL_PROP_DECIMALS','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='EL_PROP_DECIMALS' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('class'=>'','default'=>'','type'=>'text','index'=>'','name'=>'decimals','prefix'=>'','value'=>'','size'=>'10','maxlength'=>'2','onchange'=>'') ?><?php $attr_class='' ?><?php $attr_default='' ?><?php $attr_type='text' ?><?php $attr_index='' ?><?php $attr_name='decimals' ?><?php $attr_prefix='' ?><?php $attr_value='' ?><?php $attr_size='10' ?><?php $attr_maxlength='2' ?><?php $attr_onchange='' ?><input name="<?php echo $attr_name ?>" size="<?php echo $attr_size ?>" maxlength="<?php echo $attr_maxlength ?>" class="<?php echo $attr_class ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" /><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_default) ?><?php unset($attr_type) ?><?php unset($attr_index) ?><?php unset($attr_name) ?><?php unset($attr_prefix) ?><?php unset($attr_value) ?><?php unset($attr_size) ?><?php unset($attr_maxlength) ?><?php unset($attr_onchange) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'dec_point','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='dec_point' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'EL_PROP_DEC_POINT','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='EL_PROP_DEC_POINT' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('class'=>'','default'=>'','type'=>'text','index'=>'','name'=>'dec_point','prefix'=>'','value'=>'','size'=>'10','maxlength'=>'5','onchange'=>'') ?><?php $attr_class='' ?><?php $attr_default='' ?><?php $attr_type='text' ?><?php $attr_index='' ?><?php $attr_name='dec_point' ?><?php $attr_prefix='' ?><?php $attr_value='' ?><?php $attr_size='10' ?><?php $attr_maxlength='5' ?><?php $attr_onchange='' ?><input name="<?php echo $attr_name ?>" size="<?php echo $attr_size ?>" maxlength="<?php echo $attr_maxlength ?>" class="<?php echo $attr_class ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" /><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_default) ?><?php unset($attr_type) ?><?php unset($attr_index) ?><?php unset($attr_name) ?><?php unset($attr_prefix) ?><?php unset($attr_value) ?><?php unset($attr_size) ?><?php unset($attr_maxlength) ?><?php unset($attr_onchange) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'thousand_sep','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='thousand_sep' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'EL_PROP_thousand_sep','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='EL_PROP_thousand_sep' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('class'=>'','default'=>'','type'=>'text','index'=>'','name'=>'thousand_sep','prefix'=>'','value'=>'','size'=>'10','maxlength'=>'1','onchange'=>'') ?><?php $attr_class='' ?><?php $attr_default='' ?><?php $attr_type='text' ?><?php $attr_index='' ?><?php $attr_name='thousand_sep' ?><?php $attr_prefix='' ?><?php $attr_value='' ?><?php $attr_size='10' ?><?php $attr_maxlength='1' ?><?php $attr_onchange='' ?><input name="<?php echo $attr_name ?>" size="<?php echo $attr_size ?>" maxlength="<?php echo $attr_maxlength ?>" class="<?php echo $attr_class ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" /><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_default) ?><?php unset($attr_type) ?><?php unset($attr_index) ?><?php unset($attr_name) ?><?php unset($attr_prefix) ?><?php unset($attr_value) ?><?php unset($attr_size) ?><?php unset($attr_maxlength) ?><?php unset($attr_onchange) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'default_text','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='default_text' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'EL_PROP_default_text','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='EL_PROP_default_text' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('class'=>'','default'=>'','type'=>'text','index'=>'','name'=>'default_text','prefix'=>'','value'=>'','size'=>'40','maxlength'=>'255','onchange'=>'') ?><?php $attr_class='' ?><?php $attr_default='' ?><?php $attr_type='text' ?><?php $attr_index='' ?><?php $attr_name='default_text' ?><?php $attr_prefix='' ?><?php $attr_value='' ?><?php $attr_size='40' ?><?php $attr_maxlength='255' ?><?php $attr_onchange='' ?><input name="<?php echo $attr_name ?>" size="<?php echo $attr_size ?>" maxlength="<?php echo $attr_maxlength ?>" class="<?php echo $attr_class ?>" value="<?php echo isset($$attr_name)?$$attr_name:$attr_default ?>" /><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_default) ?><?php unset($attr_type) ?><?php unset($attr_index) ?><?php unset($attr_name) ?><?php unset($attr_prefix) ?><?php unset($attr_value) ?><?php unset($attr_size) ?><?php unset($attr_maxlength) ?><?php unset($attr_onchange) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'default_longtext','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='default_longtext' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'EL_PROP_default_longtext','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='EL_PROP_default_longtext' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('name'=>'default_longtext','rows'=>'10','cols'=>'40','value'=>'','index'=>'','onchange'=>'','prefix'=>'','class'=>'','default'=>'') ?><?php $attr_name='default_longtext' ?><?php $attr_rows='10' ?><?php $attr_cols='40' ?><?php $attr_value='' ?><?php $attr_index='' ?><?php $attr_onchange='' ?><?php $attr_prefix='' ?><?php $attr_class='' ?><?php $attr_default='' ?><textarea name="<?php echo $attr_name ?>" rows="<?php echo $attr_rows ?>" cols="<?php echo $attr_cols ?>"><?php echo htmlentities(isset($$attr_name)?$$attr_name:$attr_default) ?></textarea><?php unset($attr) ?><?php unset($attr_name) ?><?php unset($attr_rows) ?><?php unset($attr_cols) ?><?php unset($attr_value) ?><?php unset($attr_index) ?><?php unset($attr_onchange) ?><?php unset($attr_prefix) ?><?php unset($attr_class) ?><?php unset($attr_default) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'parameters','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='parameters' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'EL_PROP_DYNAMIC_PARAMETERS','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='EL_PROP_DYNAMIC_PARAMETERS' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('name'=>'parameters','rows'=>'15','cols'=>'40','value'=>'','index'=>'','onchange'=>'','prefix'=>'','class'=>'','default'=>'') ?><?php $attr_name='parameters' ?><?php $attr_rows='15' ?><?php $attr_cols='40' ?><?php $attr_value='' ?><?php $attr_index='' ?><?php $attr_onchange='' ?><?php $attr_prefix='' ?><?php $attr_class='' ?><?php $attr_default='' ?><textarea name="<?php echo $attr_name ?>" rows="<?php echo $attr_rows ?>" cols="<?php echo $attr_cols ?>"><?php echo htmlentities(isset($$attr_name)?$$attr_name:$attr_default) ?></textarea><?php unset($attr) ?><?php unset($attr_name) ?><?php unset($attr_rows) ?><?php unset($attr_cols) ?><?php unset($attr_value) ?><?php unset($attr_index) ?><?php unset($attr_onchange) ?><?php unset($attr_prefix) ?><?php unset($attr_class) ?><?php unset($attr_default) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('list'=>'dynamic_class_parameters','extract'=>'false','key'=>'paramName','value'=>'defaultValue') ?><?php $attr_list='dynamic_class_parameters' ?><?php $attr_extract='false' ?><?php $attr_key='paramName' ?><?php $attr_value='defaultValue' ?><?php
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
?><?php unset($attr) ?><?php unset($attr_list) ?><?php unset($attr_extract) ?><?php unset($attr_key) ?><?php unset($attr_value) ?><?php $attr = array('title'=>'','class'=>'','var'=>'paramName','text'=>'','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='paramName' ?><?php $attr_text='' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>':_(','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw=':_(' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'GLOBAL_DEFAULT','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='GLOBAL_DEFAULT' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>')_=_','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw=')_=_' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array('title'=>'','class'=>'','var'=>'defaultValue','text'=>'','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='defaultValue' ?><?php $attr_text='' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?><br/><?php unset($attr) ?><?php $attr = array() ?><?php } ?><?php unset($attr) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'select_items','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='select_items' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'EL_PROP_select_items','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='EL_PROP_select_items' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('name'=>'select_items','rows'=>'15','cols'=>'40','value'=>'','index'=>'','onchange'=>'','prefix'=>'','class'=>'','default'=>'') ?><?php $attr_name='select_items' ?><?php $attr_rows='15' ?><?php $attr_cols='40' ?><?php $attr_value='' ?><?php $attr_index='' ?><?php $attr_onchange='' ?><?php $attr_prefix='' ?><?php $attr_class='' ?><?php $attr_default='' ?><textarea name="<?php echo $attr_name ?>" rows="<?php echo $attr_rows ?>" cols="<?php echo $attr_cols ?>"><?php echo htmlentities(isset($$attr_name)?$$attr_name:$attr_default) ?></textarea><?php unset($attr) ?><?php unset($attr_name) ?><?php unset($attr_rows) ?><?php unset($attr_cols) ?><?php unset($attr_value) ?><?php unset($attr_index) ?><?php unset($attr_onchange) ?><?php unset($attr_prefix) ?><?php unset($attr_class) ?><?php unset($attr_default) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'folderobjectid','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='folderobjectid' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'EL_PROP_DEFAULT_FOLDEROBJECT','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='EL_PROP_DEFAULT_FOLDEROBJECT' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('list'=>'folders','name'=>'folderobjectid','default'=>'','onchange'=>'','title'=>'','class'=>'') ?><?php $attr_list='folders' ?><?php $attr_name='folderobjectid' ?><?php $attr_default='' ?><?php $attr_onchange='' ?><?php $attr_title='' ?><?php $attr_class='' ?><select size="1" name="<?php echo $attr_name ?>" onchange="<?php echo $attr_onchange ?>" title="<?php echo $attr_title ?>" class="<?php echo $attr_class ?>"<?php
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
?><?php unset($attr) ?><?php unset($attr_list) ?><?php unset($attr_name) ?><?php unset($attr_default) ?><?php unset($attr_onchange) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'default_objectid','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='default_objectid' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'EL_PROP_DEFAULT_OBJECT','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='EL_PROP_DEFAULT_OBJECT' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('list'=>'objects','name'=>'default_objectid','default'=>'','onchange'=>'','title'=>'','class'=>'') ?><?php $attr_list='objects' ?><?php $attr_name='default_objectid' ?><?php $attr_default='' ?><?php $attr_onchange='' ?><?php $attr_title='' ?><?php $attr_class='' ?><select size="1" name="<?php echo $attr_name ?>" onchange="<?php echo $attr_onchange ?>" title="<?php echo $attr_title ?>" class="<?php echo $attr_class ?>"<?php
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
?><?php unset($attr) ?><?php unset($attr_list) ?><?php unset($attr_name) ?><?php unset($attr_default) ?><?php unset($attr_onchange) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'code','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='code' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php 

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

	// Vergleich auf Vorhandensein
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
			$exec = true;
	}

	// Vergleich auf nicht-leer
	elseif	( !empty($attr_notempty) )
	{
		if	( !isset($$attr_notempty) )
			$exec = false;
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
		die("error in IF");
	}

	// Ergebnis umdrehen
	if  ( !empty($attr_invert) )
		$exec = !$exec;

	if	( $exec )
	{
?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'EL_PROP_code','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='EL_PROP_code' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('name'=>'code','rows'=>'35','cols'=>'60','value'=>'','index'=>'','onchange'=>'','prefix'=>'','class'=>'','default'=>'') ?><?php $attr_name='code' ?><?php $attr_rows='35' ?><?php $attr_cols='60' ?><?php $attr_value='' ?><?php $attr_index='' ?><?php $attr_onchange='' ?><?php $attr_prefix='' ?><?php $attr_class='' ?><?php $attr_default='' ?><textarea name="<?php echo $attr_name ?>" rows="<?php echo $attr_rows ?>" cols="<?php echo $attr_cols ?>"><?php echo htmlentities(isset($$attr_name)?$$attr_name:$attr_default) ?></textarea><?php unset($attr) ?><?php unset($attr_name) ?><?php unset($attr_rows) ?><?php unset($attr_cols) ?><?php unset($attr_value) ?><?php unset($attr_index) ?><?php unset($attr_onchange) ?><?php unset($attr_prefix) ?><?php unset($attr_class) ?><?php unset($attr_default) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	}
?><?php unset($attr) ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php $attr = array('width'=>'','style'=>'','class'=>'act','colspan'=>'2') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='act' ?><?php $attr_colspan='2' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('type'=>'ok') ?><?php $attr_type='ok' ?><?php
	if ($attr_type=='ok')
	{
		$attr_type  = 'submit';
		$attr_class = 'ok';
		$attr_text  = 'BUTTON_OK';
		$attr_value = 'ok';
	}
?><input type="<?php echo $attr_type ?>" name="<?php echo $attr_value ?>" class="<?php echo $attr_class ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($attr_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr) ?><?php unset($attr_type) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?>      </table>
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
<?php unset($attr) ?><?php $attr = array() ?></form><?php unset($attr) ?><?php $attr = array('field'=>'name') ?><?php $attr_field='name' ?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $attr_field ?>.focus();
document.forms[0].<?php echo $attr_field ?>.select();
//--></script>
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