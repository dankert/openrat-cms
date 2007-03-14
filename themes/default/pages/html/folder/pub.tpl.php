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
?><?php unset($attr2) ?><?php unset($attr2_target) ?><?php unset($attr2_method) ?><?php unset($attr2_enctype) ?><?php $attr3 = array('width'=>'93%','rowclasses'=>'odd,even','columnclasses'=>'1,2,3') ?><?php $attr3_width='93%' ?><?php $attr3_rowclasses='odd,even' ?><?php $attr3_columnclasses='1,2,3' ?><?php
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
      <table class="n" cellspacing="0" width="100%" cellpadding="4"><?php unset($attr3) ?><?php unset($attr3_width) ?><?php unset($attr3_rowclasses) ?><?php unset($attr3_columnclasses) ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr4_class))
		$attr4_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5 = array('class'=>'fx') ?><?php $attr5_class='fx' ?><?php
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
		
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php $attr6 = array('present'=>'pages') ?><?php $attr6_present='pages' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr6);
	
	if	( isset($attr6_true) )
	{
		if	(gettype($attr6_true) === '' && gettype($attr6_true) === '1')
			$exec = $$attr6_true == true;
		else
			$exec = $attr6_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr6_false) )
	{
		if	(gettype($attr6_false) === '' && gettype($attr6_false) === '1')
			$exec = $$attr6_false == false;
		else
			$exec = $attr6_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr6_contains) )
		$exec = in_array($attr6_value,explode(',',$attr6_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr6_equals)&& isset($attr6_value) )
		$exec = $attr6_equals == $attr6_value;

	// Vergleich auf leer
	elseif	( isset($attr6_empty) )
	{
		if	( !isset($$attr6_empty) )
			$exec = empty($attr6_empty);
		elseif	( is_array($$attr6_empty) )
			$exec = (count($$attr6_empty)==0);
		elseif	( is_bool($$attr6_empty) )
			$exec = true;
		else
			$exec = empty( $$attr6_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr6_present) )
	{
		$exec = isset($$attr6_present);
//		if	( !isset($$attr6_present) )
//			$exec = false;
//		elseif	( is_array($$attr6_present) )
//			$exec = (count($$attr6_present)>0);
//		elseif	( is_bool($$attr6_present) )
//			$exec = $$attr6_present;
//		elseif	( is_numeric($$attr6_present) )
//			$exec = $$attr6_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr6 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr6_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr6_not) )
		$exec = !$exec;

	unset($attr6_true);
	unset($attr6_false);
	unset($attr6_notempty);
	unset($attr6_empty);
	unset($attr6_contains);
	unset($attr6_present);
	unset($attr6_invert);
	unset($attr6_not);
	unset($attr6_value);
	unset($attr6_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr6) ?><?php unset($attr6_present) ?><?php $attr7 = array('present'=>'subdirs') ?><?php $attr7_present='subdirs' ?><?php 

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
?><?php unset($attr7) ?><?php unset($attr7_present) ?><?php $attr8 = array('default'=>'','readonly'=>'','name'=>'pages') ?><?php $attr8_default='' ?><?php $attr8_readonly='' ?><?php $attr8_name='pages' ?><?php
	$attr8_default  = ( $attr8_default  == true );
	
	if	( isset($$attr8_name) )
		$checked = $$attr8_name == true;
//		$checked = isset($$$attr8_name)&& $$$attr8_name==true;
	else
		$checked = $attr8_default == true;
?><input type="checkbox" id="id_<?php echo $attr8_name  ?>" name="<?php echo $attr8_name  ?>"  <?php if ($attr8_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php unset($attr8_name); unset($attr8_readonly); unset($attr8_default); ?><?php unset($attr8) ?><?php unset($attr8_default) ?><?php unset($attr8_readonly) ?><?php unset($attr8_name) ?><?php $attr8 = array('class'=>'text','raw'=>'_') ?><?php $attr8_class='text' ?><?php $attr8_raw='_' ?><?php
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
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php $attr8 = array('class'=>'text','text'=>'global_pages') ?><?php $attr8_class='text' ?><?php $attr8_text='global_pages' ?><?php
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
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_text) ?><?php $attr8 = array() ?><br/><?php unset($attr8) ?><?php $attr6 = array() ?><?php
	}
	
?><?php unset($attr6) ?><?php $attr5 = array() ?><?php
	}
	
?><?php unset($attr5) ?><?php $attr6 = array('present'=>'files') ?><?php $attr6_present='files' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr6);
	
	if	( isset($attr6_true) )
	{
		if	(gettype($attr6_true) === '' && gettype($attr6_true) === '1')
			$exec = $$attr6_true == true;
		else
			$exec = $attr6_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr6_false) )
	{
		if	(gettype($attr6_false) === '' && gettype($attr6_false) === '1')
			$exec = $$attr6_false == false;
		else
			$exec = $attr6_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr6_contains) )
		$exec = in_array($attr6_value,explode(',',$attr6_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr6_equals)&& isset($attr6_value) )
		$exec = $attr6_equals == $attr6_value;

	// Vergleich auf leer
	elseif	( isset($attr6_empty) )
	{
		if	( !isset($$attr6_empty) )
			$exec = empty($attr6_empty);
		elseif	( is_array($$attr6_empty) )
			$exec = (count($$attr6_empty)==0);
		elseif	( is_bool($$attr6_empty) )
			$exec = true;
		else
			$exec = empty( $$attr6_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr6_present) )
	{
		$exec = isset($$attr6_present);
//		if	( !isset($$attr6_present) )
//			$exec = false;
//		elseif	( is_array($$attr6_present) )
//			$exec = (count($$attr6_present)>0);
//		elseif	( is_bool($$attr6_present) )
//			$exec = $$attr6_present;
//		elseif	( is_numeric($$attr6_present) )
//			$exec = $$attr6_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr6 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr6_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr6_not) )
		$exec = !$exec;

	unset($attr6_true);
	unset($attr6_false);
	unset($attr6_notempty);
	unset($attr6_empty);
	unset($attr6_contains);
	unset($attr6_present);
	unset($attr6_invert);
	unset($attr6_not);
	unset($attr6_value);
	unset($attr6_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr6) ?><?php unset($attr6_present) ?><?php $attr7 = array('true'=>'subdirs') ?><?php $attr7_true='subdirs' ?><?php 

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
?><?php unset($attr7) ?><?php unset($attr7_true) ?><?php $attr8 = array('default'=>'','readonly'=>'','name'=>'files') ?><?php $attr8_default='' ?><?php $attr8_readonly='' ?><?php $attr8_name='files' ?><?php
	$attr8_default  = ( $attr8_default  == true );
	
	if	( isset($$attr8_name) )
		$checked = $$attr8_name == true;
//		$checked = isset($$$attr8_name)&& $$$attr8_name==true;
	else
		$checked = $attr8_default == true;
?><input type="checkbox" id="id_<?php echo $attr8_name  ?>" name="<?php echo $attr8_name  ?>"  <?php if ($attr8_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php unset($attr8_name); unset($attr8_readonly); unset($attr8_default); ?><?php unset($attr8) ?><?php unset($attr8_default) ?><?php unset($attr8_readonly) ?><?php unset($attr8_name) ?><?php $attr8 = array('class'=>'text','raw'=>'_') ?><?php $attr8_class='text' ?><?php $attr8_raw='_' ?><?php
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
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_raw) ?><?php $attr8 = array('class'=>'text','text'=>'global_files') ?><?php $attr8_class='text' ?><?php $attr8_text='global_files' ?><?php
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
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_text) ?><?php $attr8 = array() ?><br/><?php unset($attr8) ?><?php $attr6 = array() ?><?php
	}
	
?><?php unset($attr6) ?><?php $attr5 = array() ?><?php
	}
	
?><?php unset($attr5) ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr4_class))
		$attr4_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5 = array('class'=>'fx') ?><?php $attr5_class='fx' ?><?php
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
		
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php $attr6 = array('present'=>'subdirs') ?><?php $attr6_present='subdirs' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr6);
	
	if	( isset($attr6_true) )
	{
		if	(gettype($attr6_true) === '' && gettype($attr6_true) === '1')
			$exec = $$attr6_true == true;
		else
			$exec = $attr6_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr6_false) )
	{
		if	(gettype($attr6_false) === '' && gettype($attr6_false) === '1')
			$exec = $$attr6_false == false;
		else
			$exec = $attr6_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr6_contains) )
		$exec = in_array($attr6_value,explode(',',$attr6_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr6_equals)&& isset($attr6_value) )
		$exec = $attr6_equals == $attr6_value;

	// Vergleich auf leer
	elseif	( isset($attr6_empty) )
	{
		if	( !isset($$attr6_empty) )
			$exec = empty($attr6_empty);
		elseif	( is_array($$attr6_empty) )
			$exec = (count($$attr6_empty)==0);
		elseif	( is_bool($$attr6_empty) )
			$exec = true;
		else
			$exec = empty( $$attr6_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr6_present) )
	{
		$exec = isset($$attr6_present);
//		if	( !isset($$attr6_present) )
//			$exec = false;
//		elseif	( is_array($$attr6_present) )
//			$exec = (count($$attr6_present)>0);
//		elseif	( is_bool($$attr6_present) )
//			$exec = $$attr6_present;
//		elseif	( is_numeric($$attr6_present) )
//			$exec = $$attr6_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr6 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr6_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr6_not) )
		$exec = !$exec;

	unset($attr6_true);
	unset($attr6_false);
	unset($attr6_notempty);
	unset($attr6_empty);
	unset($attr6_contains);
	unset($attr6_present);
	unset($attr6_invert);
	unset($attr6_not);
	unset($attr6_value);
	unset($attr6_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr6) ?><?php unset($attr6_present) ?><?php $attr7 = array('default'=>'','readonly'=>'','name'=>'subdirs') ?><?php $attr7_default='' ?><?php $attr7_readonly='' ?><?php $attr7_name='subdirs' ?><?php
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
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_raw) ?><?php $attr7 = array('class'=>'text','text'=>'GLOBAL_PUBLISH_WITH_SUBDIRS') ?><?php $attr7_class='text' ?><?php $attr7_text='GLOBAL_PUBLISH_WITH_SUBDIRS' ?><?php
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
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php $attr7 = array() ?><br/><?php unset($attr7) ?><?php $attr5 = array() ?><?php
	}
	
?><?php unset($attr5) ?><?php $attr6 = array('present'=>'clean') ?><?php $attr6_present='clean' ?><?php 

	// Wahr-Vergleich
//	Html::debug($attr6);
	
	if	( isset($attr6_true) )
	{
		if	(gettype($attr6_true) === '' && gettype($attr6_true) === '1')
			$exec = $$attr6_true == true;
		else
			$exec = $attr6_true == true;
	}

	// Falsch-Vergleich
	elseif	( isset($attr6_false) )
	{
		if	(gettype($attr6_false) === '' && gettype($attr6_false) === '1')
			$exec = $$attr6_false == false;
		else
			$exec = $attr6_false == false;
	}
	// Inhalt-Vergleich mit Wertliste
	elseif( isset($attr6_contains) )
		$exec = in_array($attr6_value,explode(',',$attr6_contains));
				
	// Inhalt-Vergleich
	elseif( isset($attr6_equals)&& isset($attr6_value) )
		$exec = $attr6_equals == $attr6_value;

	// Vergleich auf leer
	elseif	( isset($attr6_empty) )
	{
		if	( !isset($$attr6_empty) )
			$exec = empty($attr6_empty);
		elseif	( is_array($$attr6_empty) )
			$exec = (count($$attr6_empty)==0);
		elseif	( is_bool($$attr6_empty) )
			$exec = true;
		else
			$exec = empty( $$attr6_empty );
	}

	// Vergleich auf Vorhandensein
	elseif	( isset($attr6_present) )
	{
		$exec = isset($$attr6_present);
//		if	( !isset($$attr6_present) )
//			$exec = false;
//		elseif	( is_array($$attr6_present) )
//			$exec = (count($$attr6_present)>0);
//		elseif	( is_bool($$attr6_present) )
//			$exec = $$attr6_present;
//		elseif	( is_numeric($$attr6_present) )
//			$exec = $$attr6_present>=0;
//		else
//			$exec = true;
	}

	else
	{
		Html::debug( $attr6 );
		echo("error in IF line ".__LINE__);
		echo("assume: FALSE");
		$exec = false;
	}

	// Ergebnis umdrehen
	// TODO: Bald ausbauen, stattdessen "not" verwenden.
	if  ( !empty($attr6_invert) )
		$exec = !$exec;

	// Ergebnis umdrehen
	if  ( !empty($attr6_not) )
		$exec = !$exec;

	unset($attr6_true);
	unset($attr6_false);
	unset($attr6_notempty);
	unset($attr6_empty);
	unset($attr6_contains);
	unset($attr6_present);
	unset($attr6_invert);
	unset($attr6_not);
	unset($attr6_value);
	unset($attr6_equals);

	$last_exec = $exec;
	
	if	( $exec )
	{
?><?php unset($attr6) ?><?php unset($attr6_present) ?><?php $attr7 = array('default'=>'','readonly'=>'','name'=>'clean') ?><?php $attr7_default='' ?><?php $attr7_readonly='' ?><?php $attr7_name='clean' ?><?php
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
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_raw) ?><?php $attr7 = array('class'=>'text','text'=>'global_CLEAN_AFTER_PUBLISH') ?><?php $attr7_class='text' ?><?php $attr7_text='global_CLEAN_AFTER_PUBLISH' ?><?php
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
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php $attr7 = array() ?><br/><?php unset($attr7) ?><?php $attr5 = array() ?><?php
	}
	
?><?php unset($attr5) ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr4_class))
		$attr4_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5 = array('class'=>'help') ?><?php $attr5_class='help' ?><?php
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
		
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php $attr6 = array('class'=>'text','text'=>'GLOBAL_MUCH_TIME') ?><?php $attr6_class='text' ?><?php $attr6_text='GLOBAL_MUCH_TIME' ?><?php
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
?></span><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_text) ?><?php $attr4 = array() ?></td><?php unset($attr4) ?><?php $attr3 = array() ?></tr><?php unset($attr3) ?><?php $attr4 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr4_class))
		$attr4_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr4_class ?>"><?php unset($attr4) ?><?php $attr5 = array('class'=>'act') ?><?php $attr5_class='act' ?><?php
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
		
?><td <?php foreach( $attr5 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr5) ?><?php unset($attr5_class) ?><?php $attr6 = array('type'=>'ok','class'=>'ok','value'=>'ok','text'=>'button_ok') ?><?php $attr6_type='ok' ?><?php $attr6_class='ok' ?><?php $attr6_value='ok' ?><?php $attr6_text='button_ok' ?><?php
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

<?php unset($attr1) ?><?php $attr0 = array() ?>
<!-- $Id$ -->

<?php if ($showDuration) { ?>
<br/>
<small>&nbsp;
<?php $dur = time()-START_TIME;
//      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small>
<?php } ?>

</body>
</html><?php unset($attr0) ?>