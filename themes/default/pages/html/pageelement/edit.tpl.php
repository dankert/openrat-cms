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

<?php unset($attr1) ?><?php unset($attr1_class) ?><?php unset($attr1_title) ?><?php $attr2 = array('name'=>'','target'=>'_self','method'=>'post','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr2_name='' ?><?php $attr2_target='_self' ?><?php $attr2_method='post' ?><?php $attr2_enctype='application/x-www-form-urlencoded' ?><?php
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
?><?php unset($attr2) ?><?php unset($attr2_name) ?><?php unset($attr2_target) ?><?php unset($attr2_method) ?><?php unset($attr2_enctype) ?><?php $attr3 = array('class'=>'','default'=>'','type'=>'hidden','name'=>'elementid','size'=>'40','maxlength'=>'256','onchange'=>'') ?><?php $attr3_class='' ?><?php $attr3_default='' ?><?php $attr3_type='hidden' ?><?php $attr3_name='elementid' ?><?php $attr3_size='40' ?><?php $attr3_maxlength='256' ?><?php $attr3_onchange='' ?><?php if(!isset($attr3_default)) $attr3_default='';
?><input id="id_<?php echo $attr3_name ?>" name="<?php echo $attr3_name ?>" type="<?php echo $attr3_type ?>" size="<?php echo $attr3_size ?>" maxlength="<?php echo $attr3_maxlength ?>" class="<?php echo $attr3_class ?>" value="<?php echo isset($$attr3_name)?$$attr3_name:$attr3_default ?>" onxxxMouseOver="this.focus();"  /><?php unset($attr3) ?><?php unset($attr3_class) ?><?php unset($attr3_default) ?><?php unset($attr3_type) ?><?php unset($attr3_name) ?><?php unset($attr3_size) ?><?php unset($attr3_maxlength) ?><?php unset($attr3_onchange) ?><?php $attr3 = array('name'=>'element','width'=>'93%','rowclasses'=>'odd,even','columnclasses'=>'1,2,3') ?><?php $attr3_name='element' ?><?php $attr3_width='93%' ?><?php $attr3_rowclasses='odd,even' ?><?php $attr3_columnclasses='1,2,3' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('class'=>'ansidate','default'=>'','type'=>'text','name'=>'ansidate','size'=>'25','maxlength'=>'25','onchange'=>'') ?><?php $attr7_class='ansidate' ?><?php $attr7_default='' ?><?php $attr7_type='text' ?><?php $attr7_name='ansidate' ?><?php $attr7_size='25' ?><?php $attr7_maxlength='25' ?><?php $attr7_onchange='' ?><?php if(!isset($attr7_default)) $attr7_default='';
?><input id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" onxxxMouseOver="this.focus();"  /><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php $attr7 = array('field'=>'ansidate') ?><?php $attr7_field='ansidate' ?>
<script name="JavaScript" type="text/javascript">
<!--
document.forms[0].<?php echo $attr7_field ?>.focus();
document.forms[0].<?php echo $attr7_field ?>.select();
// -->
</script>
<?php unset($attr7) ?><?php unset($attr7_field) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3 = array() ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('class'=>'text','default'=>'','type'=>'text','name'=>'text','size'=>'50','maxlength'=>'255','onchange'=>'') ?><?php $attr7_class='text' ?><?php $attr7_default='' ?><?php $attr7_type='text' ?><?php $attr7_name='text' ?><?php $attr7_size='50' ?><?php $attr7_maxlength='255' ?><?php $attr7_onchange='' ?><?php if(!isset($attr7_default)) $attr7_default='';
?><input id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" onxxxMouseOver="this.focus();"  /><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php $attr7 = array('field'=>'text') ?><?php $attr7_field='text' ?>
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('name'=>'text','rows'=>'25','cols'=>'70','class'=>'longtext','default'=>'') ?><?php $attr7_name='text' ?><?php $attr7_rows='25' ?><?php $attr7_cols='70' ?><?php $attr7_class='longtext' ?><?php $attr7_default='' ?><textarea class="<?php echo $attr7_class ?>" name="<?php echo $attr7_name ?>" rows="<?php echo $attr7_rows ?>" cols="<?php echo $attr7_cols ?>"><?php echo htmlentities(isset($$attr7_name)?$$attr7_name:$attr7_default) ?></textarea><?php unset($attr7) ?><?php unset($attr7_name) ?><?php unset($attr7_rows) ?><?php unset($attr7_cols) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php $attr7 = array('field'=>'text') ?><?php $attr7_field='text' ?>
<script name="JavaScript" type="text/javascript">
<!--
document.forms[0].<?php echo $attr7_field ?>.focus();
document.forms[0].<?php echo $attr7_field ?>.select();
// -->
</script>
<?php unset($attr7) ?><?php unset($attr7_field) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3 = array() ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('list'=>'objects','name'=>'linkobjectid','default'=>'','onchange'=>'','title'=>'','class'=>'') ?><?php $attr7_list='objects' ?><?php $attr7_name='linkobjectid' ?><?php $attr7_default='' ?><?php $attr7_onchange='' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><select size="1" id="id_<?php echo $attr7_name ?>"  name="<?php echo $attr7_name ?>" onchange="<?php echo $attr7_onchange ?>" title="<?php echo $attr7_title ?>" class="<?php echo $attr7_class ?>"<?php
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
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_default) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php $attr7 = array('field'=>'linkobjectid') ?><?php $attr7_field='linkobjectid' ?>
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('list'=>'objects','name'=>'linkobjectid','default'=>'','onchange'=>'','title'=>'','class'=>'') ?><?php $attr7_list='objects' ?><?php $attr7_name='linkobjectid' ?><?php $attr7_default='' ?><?php $attr7_onchange='' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><select size="1" id="id_<?php echo $attr7_name ?>"  name="<?php echo $attr7_name ?>" onchange="<?php echo $attr7_onchange ?>" title="<?php echo $attr7_title ?>" class="<?php echo $attr7_class ?>"<?php
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
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_default) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php $attr7 = array('field'=>'linkobjectid') ?><?php $attr7_field='linkobjectid' ?>
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('name'=>'decimals','default'=>'decimals') ?><?php $attr7_name='decimals' ?><?php $attr7_default='decimals' ?><input type="hidden" name="<?php echo $attr7_name ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" /><?php unset($attr7) ?><?php unset($attr7_name) ?><?php unset($attr7_default) ?><?php $attr7 = array('class'=>'','default'=>'','type'=>'text','name'=>'number','size'=>'15','maxlength'=>'20','onchange'=>'') ?><?php $attr7_class='' ?><?php $attr7_default='' ?><?php $attr7_type='text' ?><?php $attr7_name='number' ?><?php $attr7_size='15' ?><?php $attr7_maxlength='20' ?><?php $attr7_onchange='' ?><?php if(!isset($attr7_default)) $attr7_default='';
?><input id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name ?>" type="<?php echo $attr7_type ?>" size="<?php echo $attr7_size ?>" maxlength="<?php echo $attr7_maxlength ?>" class="<?php echo $attr7_class ?>" value="<?php echo isset($$attr7_name)?$$attr7_name:$attr7_default ?>" onxxxMouseOver="this.focus();"  /><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_default) ?><?php unset($attr7_type) ?><?php unset($attr7_name) ?><?php unset($attr7_size) ?><?php unset($attr7_maxlength) ?><?php unset($attr7_onchange) ?><?php $attr7 = array('field'=>'number') ?><?php $attr7_field='number' ?>
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('list'=>'items','name'=>'text','default'=>'','onchange'=>'','title'=>'','class'=>'') ?><?php $attr7_list='items' ?><?php $attr7_name='text' ?><?php $attr7_default='' ?><?php $attr7_onchange='' ?><?php $attr7_title='' ?><?php $attr7_class='' ?><select size="1" id="id_<?php echo $attr7_name ?>"  name="<?php echo $attr7_name ?>" onchange="<?php echo $attr7_onchange ?>" title="<?php echo $attr7_title ?>" class="<?php echo $attr7_class ?>"<?php
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
?><?php unset($attr7) ?><?php unset($attr7_list) ?><?php unset($attr7_name) ?><?php unset($attr7_default) ?><?php unset($attr7_onchange) ?><?php unset($attr7_title) ?><?php unset($attr7_class) ?><?php $attr7 = array('field'=>'text') ?><?php $attr7_field='text' ?>
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('default'=>false,'readonly'=>false,'name'=>'release') ?><?php $attr7_default=false ?><?php $attr7_readonly=false ?><?php $attr7_name='release' ?><?php
	if	( isset($$attr7_name) )
		$checked = $$attr7_name;
	else
		$checked = $attr7_default;
?><input type="checkbox" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name  ?>"  <?php if ($attr7_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php unset($attr7_name); unset($attr7_readonly); unset($attr7_default); ?><?php unset($attr7) ?><?php unset($attr7_default) ?><?php unset($attr7_readonly) ?><?php unset($attr7_name) ?><?php $attr7 = array('class'=>'text','raw'=>'_') ?><?php $attr7_class='text' ?><?php $attr7_raw='_' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('default'=>false,'readonly'=>false,'name'=>'publish') ?><?php $attr7_default=false ?><?php $attr7_readonly=false ?><?php $attr7_name='publish' ?><?php
	if	( isset($$attr7_name) )
		$checked = $$attr7_name;
	else
		$checked = $attr7_default;
?><input type="checkbox" id="id_<?php echo $attr7_name ?>" name="<?php echo $attr7_name  ?>"  <?php if ($attr7_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php unset($attr7_name); unset($attr7_readonly); unset($attr7_default); ?><?php unset($attr7) ?><?php unset($attr7_default) ?><?php unset($attr7_readonly) ?><?php unset($attr7_name) ?><?php $attr7 = array('class'=>'text','raw'=>'_') ?><?php $attr7_class='text' ?><?php $attr7_raw='_' ?><?php
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