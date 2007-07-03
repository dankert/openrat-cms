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
<?php if(!empty($root_stylesheet)) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $root_stylesheet ?>" />
<?php } ?>
<?php if($root_stylesheet!=$user_stylesheet) { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $user_stylesheet ?>" />
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
?><?php unset($attr2) ?><?php unset($attr2_name) ?><?php unset($attr2_target) ?><?php unset($attr2_method) ?><?php unset($attr2_enctype) ?><?php $attr3 = array('title'=>'TEMPLATE_ELEMENTS','name'=>'TEMPLATE_ELEMENTS','widths'=>'30%,5%,65%','width'=>'93%','rowclasses'=>'odd,even','columnclasses'=>'1,2,3') ?><?php $attr3_title='TEMPLATE_ELEMENTS' ?><?php $attr3_name='TEMPLATE_ELEMENTS' ?><?php $attr3_widths='30%,5%,65%' ?><?php $attr3_width='93%' ?><?php $attr3_rowclasses='odd,even' ?><?php $attr3_columnclasses='1,2,3' ?><?php
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
		</td><!--<td class="menu" style="align:right;">
    <?php if (isset($windowIcons)) foreach( $windowIcons as $icon )
          {
          	?><a href="<?php echo $icon['url'] ?>" title="<?php echo 'ICON_'.lang($menu['type'].'_DESC') ?>"><image border="0" src="<?php echo $image_dir.$icon['type'].IMG_ICON_EXT ?>"></a>&nbsp;<?php
          }
     ?>
    </td>-->
  </tr>
  <tr><td class="subaction">
  
    <?php if	( !isset($windowMenu) || !is_array($windowMenu) )
			$windowMenu = array();
    foreach( $windowMenu as $menu )
          {
          	$tmp_text = lang($menu['text']);
          	$tmp_key  = strtoupper(lang($menu['key' ]));
			$tmp_pos = strpos(strtolower($tmp_text),strtolower($tmp_key));
			if	( $tmp_pos !== false )
				$tmp_text = substr($tmp_text,0,max($tmp_pos,0)).'<span class="accesskey">'. substr($tmp_text,$tmp_pos,1).'</span>'.substr($tmp_text,$tmp_pos+1);
          	
          	if	( isset($menu['url']) )
          	{
          		?><a href="<?php echo Html::url($actionName,$menu['subaction'],$this->getRequestId() ) ?>" accesskey="<?php echo $tmp_key ?>" title="<?php echo lang($menu['text'].'_DESC') ?>" class="menu<?php echo $this->subActionName==$menu['subaction']?'_highlight':'' ?>"><?php echo $tmp_text ?></a>&nbsp;&nbsp;&nbsp;<?php
          	}
          	else
          	{
          		?><span class="menu_disabled" title="<?php echo lang($menu['text'].'_DESC') ?>" class="menu_disabled"><?php echo $tmp_text ?></span>&nbsp;&nbsp;&nbsp;<?php
          	}
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
    
  <tr>
    <td><img src="<?php echo $image_dir.'notice_'.$notice['status'].IMG_ICON_EXT ?>" style="padding:10px" /></td>
    <td class="f1"><?php if ($notice['name']!='') { ?><img src="<?php echo $image_dir.'icon_'.$notice['type'].IMG_ICON_EXT ?>" align="left" /><?php echo $notice['name'] ?>: <?php } ?><?php if ($notice['status']=='error') { ?><strong><?php } ?><?php echo $notice['text'] ?><?php if ($notice['status']=='error') { ?></strong><?php } ?></td>
  </tr>
  <?php } ?>
  
    </table></td>
  </tr>

<?php } ?>



  <tr>
    <td>
      <table class="n" cellspacing="0" width="100%" cellpadding="4"><?php unset($attr3) ?><?php unset($attr3_title) ?><?php unset($attr3_name) ?><?php unset($attr3_widths) ?><?php unset($attr3_width) ?><?php unset($attr3_rowclasses) ?><?php unset($attr3_columnclasses) ?><?php $attr4 = array('empty'=>'el') ?><?php $attr4_empty='el' ?><?php 

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
?><?php unset($attr4) ?><?php unset($attr4_empty) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('class'=>'fx','colspan'=>'4') ?><?php $attr6_class='fx' ?><?php $attr6_colspan='4' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php unset($attr6_colspan) ?><?php $attr7 = array('class'=>'text','text'=>'GLOBAL_NOT_FOUND','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='GLOBAL_NOT_FOUND' ?><?php $attr7_escape=true ?><?php
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
		$tmp_text = isset($$attr7_var)?($attr7_escape?htmlentities($$attr7_var):$$attr7_var):'?'.$attr7_var.'?';	
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

	if	(isset($attr7_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
			
	echo $tmp_text;
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3 = array() ?><?php
	}
	
?><?php unset($attr3) ?><?php $attr4 = array('invert'=>true,'empty'=>'el') ?><?php $attr4_invert=true ?><?php $attr4_empty='el' ?><?php 

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
?><?php unset($attr4) ?><?php unset($attr4_invert) ?><?php unset($attr4_empty) ?><?php $attr5 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr5_class))
		$attr5_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('class'=>'help') ?><?php $attr6_class='help' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7 = array('class'=>'text','text'=>'PAGE_ELEMENT_NAME','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='PAGE_ELEMENT_NAME' ?><?php $attr7_escape=true ?><?php
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
		$tmp_text = isset($$attr7_var)?($attr7_escape?htmlentities($$attr7_var):$$attr7_var):'?'.$attr7_var.'?';	
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

	if	(isset($attr7_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
			
	echo $tmp_text;
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6 = array('class'=>'help') ?><?php $attr6_class='help' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7 = array('class'=>'text','text'=>'GLOBAL_CHANGE','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='GLOBAL_CHANGE' ?><?php $attr7_escape=true ?><?php
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
		$tmp_text = isset($$attr7_var)?($attr7_escape?htmlentities($$attr7_var):$$attr7_var):'?'.$attr7_var.'?';	
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

	if	(isset($attr7_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
			
	echo $tmp_text;
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr6 = array('class'=>'help') ?><?php $attr6_class='help' ?><?php
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
		
?><td <?php foreach( $attr6 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr6) ?><?php unset($attr6_class) ?><?php $attr7 = array('class'=>'text','text'=>'GLOBAL_VALUE','escape'=>true) ?><?php $attr7_class='text' ?><?php $attr7_text='GLOBAL_VALUE' ?><?php $attr7_escape=true ?><?php
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
		$tmp_text = isset($$attr7_var)?($attr7_escape?htmlentities($$attr7_var):$$attr7_var):'?'.$attr7_var.'?';	
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

	if	(isset($attr7_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr7_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
			
	echo $tmp_text;
?></span><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_text) ?><?php unset($attr7_escape) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr5 = array('list'=>'el','extract'=>true,'key'=>'list_key','value'=>'list_value') ?><?php $attr5_list='el' ?><?php $attr5_extract=true ?><?php $attr5_key='list_key' ?><?php $attr5_value='list_value' ?><?php
	$attr5_list_tmp_key   = $attr5_key;
	$attr5_list_tmp_value = $attr5_value;
	$attr5_list_extract   = $attr5_extract;

	if	( !isset($$attr5_list) || !is_array($$attr5_list) )
		$$attr5_list = array();
	
	foreach( $$attr5_list as $$attr5_list_tmp_key => $$attr5_list_tmp_value )
	{
		if	( $attr5_list_extract )
		{
			if	( !is_array($$attr5_list_tmp_value) )
			{
				print_r($$attr5_list_tmp_value);
				die( 'not an array at key: '.$$attr5_list_tmp_key );
			}
			extract($$attr5_list_tmp_value);
		}
?><?php unset($attr5) ?><?php unset($attr5_list) ?><?php unset($attr5_extract) ?><?php unset($attr5_key) ?><?php unset($attr5_value) ?><?php $attr6 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr6_class))
		$attr6_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr6_class ?>"><?php unset($attr6) ?><?php $attr7 = array('class'=>'fx') ?><?php $attr7_class='fx' ?><?php
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
		
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php $attr8 = array('align'=>'left','elementtype'=>$type) ?><?php $attr8_align='left' ?><?php $attr8_elementtype=$type ?><?php
if (isset($attr8_elementtype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$attr8_elementtype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_type)) {
?><img src="<?php echo $image_dir.'icon_'.$attr8_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_icon)) {
?><img src="<?php echo $image_dir.'icon_'.$attr8_icon.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_url)) {
?><img src="<?php echo $attr8_url ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_fileext)) {
?><img src="<?php echo $image_dir.$attr8_fileext ?>" border="0" align="<?php echo $attr8_align ?>"><?php
} elseif (isset($attr8_file)) {
?><img src="<?php echo $image_dir.$attr8_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr8_align ?>"><?php } ?><?php unset($attr8) ?><?php unset($attr8_align) ?><?php unset($attr8_elementtype) ?><?php $attr8 = array('class'=>'text','var'=>'name','escape'=>true) ?><?php $attr8_class='text' ?><?php $attr8_var='name' ?><?php $attr8_escape=true ?><?php
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
		$tmp_text = isset($$attr8_var)?($attr8_escape?htmlentities($$attr8_var):$$attr8_var):'?'.$attr8_var.'?';	
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

	if	(isset($attr8_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr8_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
			
	echo $tmp_text;
?></span><?php unset($attr8) ?><?php unset($attr8_class) ?><?php unset($attr8_var) ?><?php unset($attr8_escape) ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr7 = array('class'=>'fx') ?><?php $attr7_class='fx' ?><?php
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
		
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php $attr8 = array('default'=>false,'readonly'=>false,'name'=>$saveid) ?><?php $attr8_default=false ?><?php $attr8_readonly=false ?><?php $attr8_name=$saveid ?><?php
	if	( isset($$attr8_name) )
		$checked = $$attr8_name;
	else
		$checked = $attr8_default;
?><input type="checkbox" id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name  ?>"  <?php if ($attr8_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php unset($attr8_name); unset($attr8_readonly); unset($attr8_default); ?><?php unset($attr8) ?><?php unset($attr8_default) ?><?php unset($attr8_readonly) ?><?php unset($attr8_name) ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr7 = array('class'=>'fx') ?><?php $attr7_class='fx' ?><?php
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
		
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php $attr8 = array('value'=>$type,'contains'=>'text,date,number') ?><?php $attr8_value=$type ?><?php $attr8_contains='text,date,number' ?><?php 

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
?><?php unset($attr8) ?><?php unset($attr8_value) ?><?php unset($attr8_contains) ?><?php $attr9 = array('class'=>'','default'=>$value,'type'=>'text','index'=>true,'name'=>$id,'size'=>'40','maxlength'=>'255','onchange'=>'onchange') ?><?php $attr9_class='' ?><?php $attr9_default=$value ?><?php $attr9_type='text' ?><?php $attr9_index=true ?><?php $attr9_name=$id ?><?php $attr9_size='40' ?><?php $attr9_maxlength='255' ?><?php $attr9_onchange='onchange' ?><?php if(!isset($attr9_default)) $attr9_default='';
?><input id="id_<?php echo $attr9_name ?>" name="<?php echo $attr9_name ?>" type="<?php echo $attr9_type ?>" size="<?php echo $attr9_size ?>" maxlength="<?php echo $attr9_maxlength ?>" class="<?php echo $attr9_class ?>" value="<?php echo isset($$attr9_name)?$$attr9_name:$attr9_default ?>" onxxxMouseOver="this.focus();"  /><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_default) ?><?php unset($attr9_type) ?><?php unset($attr9_index) ?><?php unset($attr9_name) ?><?php unset($attr9_size) ?><?php unset($attr9_maxlength) ?><?php unset($attr9_onchange) ?><?php $attr7 = array() ?><?php
	}
	
?><?php unset($attr7) ?><?php $attr8 = array('equals'=>'longtext','value'=>$type) ?><?php $attr8_equals='longtext' ?><?php $attr8_value=$type ?><?php 

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
?><?php unset($attr8) ?><?php unset($attr8_equals) ?><?php unset($attr8_value) ?><?php $attr9 = array('name'=>$id,'rows'=>'7','cols'=>'50','index'=>true,'onchange'=>'onchange','class'=>'','default'=>$value) ?><?php $attr9_name=$id ?><?php $attr9_rows='7' ?><?php $attr9_cols='50' ?><?php $attr9_index=true ?><?php $attr9_onchange='onchange' ?><?php $attr9_class='' ?><?php $attr9_default=$value ?><textarea class="<?php echo $attr9_class ?>" name="<?php echo $attr9_name ?>" rows="<?php echo $attr9_rows ?>" cols="<?php echo $attr9_cols ?>"><?php echo htmlentities(isset($$attr9_name)?$$attr9_name:$attr9_default) ?></textarea><?php unset($attr9) ?><?php unset($attr9_name) ?><?php unset($attr9_rows) ?><?php unset($attr9_cols) ?><?php unset($attr9_index) ?><?php unset($attr9_onchange) ?><?php unset($attr9_class) ?><?php unset($attr9_default) ?><?php $attr7 = array() ?><?php
	}
	
?><?php unset($attr7) ?><?php $attr8 = array('value'=>$type,'contains'=>'select,link,list') ?><?php $attr8_value=$type ?><?php $attr8_contains='select,link,list' ?><?php 

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
?><?php unset($attr8) ?><?php unset($attr8_value) ?><?php unset($attr8_contains) ?><?php $attr9 = array('list'=>'list','name'=>$id,'default'=>$value,'onchange'=>'','title'=>'','class'=>'') ?><?php $attr9_list='list' ?><?php $attr9_name=$id ?><?php $attr9_default=$value ?><?php $attr9_onchange='' ?><?php $attr9_title='' ?><?php $attr9_class='' ?><select size="1" id="id_<?php echo $attr9_name ?>"  name="<?php echo $attr9_name ?>" onchange="<?php echo $attr9_onchange ?>" title="<?php echo $attr9_title ?>" class="<?php echo $attr9_class ?>"<?php
if (count($$attr9_list)==1) echo ' disabled="disabled"'
?>><?php
		$attr9_tmp_list = $$attr9_list;
		if	( isset($$attr9_name) && isset($attr9_tmp_list[$$attr9_name]) )
			$attr9_tmp_default = $$attr9_name;
		elseif ( isset($attr9_default) )
			$attr9_tmp_default = $attr9_default;
		else
			$attr9_tmp_default = '';
		
		foreach( $attr9_tmp_list as $box_key=>$box_value )
		{
			echo '<option class="'.$attr9_class.'" value="'.$box_key.'"';
			if ($box_key==$attr9_tmp_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr9_list)==1) echo '<input type="hidden" name="'.$attr9_name.'" value="'.$box_key.'" />'
?><?php unset($attr9) ?><?php unset($attr9_list) ?><?php unset($attr9_name) ?><?php unset($attr9_default) ?><?php unset($attr9_onchange) ?><?php unset($attr9_title) ?><?php unset($attr9_class) ?><?php $attr7 = array() ?><?php
	}
	
?><?php unset($attr7) ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr4 = array() ?><?php } ?><?php unset($attr4) ?><?php $attr5 = array('present'=>'release') ?><?php $attr5_present='release' ?><?php 

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
?><?php unset($attr5) ?><?php unset($attr5_present) ?><?php $attr6 = array('present'=>'publish') ?><?php $attr6_present='publish' ?><?php 

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
?><?php unset($attr6) ?><?php unset($attr6_present) ?><?php $attr7 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr7_class))
		$attr7_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr7_class ?>"><?php unset($attr7) ?><?php $attr8 = array('colspan'=>'3') ?><?php $attr8_colspan='3' ?><?php
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
		
?><td <?php foreach( $attr8 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr8) ?><?php unset($attr8_colspan) ?><?php $attr9 = array('title'=>lang('options')) ?><?php $attr9_title=lang('options') ?><fieldset><legend><?php echo $attr9_title ?></legend><?php unset($attr9) ?><?php unset($attr9_title) ?><?php $attr8 = array() ?></fieldset><?php unset($attr8) ?><?php $attr7 = array() ?></td><?php unset($attr7) ?><?php $attr6 = array() ?></tr><?php unset($attr6) ?><?php $attr5 = array() ?><?php
	}
	
?><?php unset($attr5) ?><?php $attr4 = array() ?><?php
	}
	
?><?php unset($attr4) ?><?php $attr5 = array('present'=>'release') ?><?php $attr5_present='release' ?><?php 

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
?><?php unset($attr5) ?><?php unset($attr5_present) ?><?php $attr6 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr6_class))
		$attr6_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr6_class ?>"><?php unset($attr6) ?><?php $attr7 = array('class'=>'fx','colspan'=>'3') ?><?php $attr7_class='fx' ?><?php $attr7_colspan='3' ?><?php
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
		
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_colspan) ?><?php $attr8 = array('default'=>false,'readonly'=>false,'name'=>'release') ?><?php $attr8_default=false ?><?php $attr8_readonly=false ?><?php $attr8_name='release' ?><?php
	if	( isset($$attr8_name) )
		$checked = $$attr8_name;
	else
		$checked = $attr8_default;
?><input type="checkbox" id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name  ?>"  <?php if ($attr8_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php unset($attr8_name); unset($attr8_readonly); unset($attr8_default); ?><?php unset($attr8) ?><?php unset($attr8_default) ?><?php unset($attr8_readonly) ?><?php unset($attr8_name) ?><?php $attr8 = array('for'=>'release') ?><?php $attr8_for='release' ?><label for="id_<?php echo $attr8_for ?><?php if (!empty($attr8_value)) echo '_'.$attr8_value ?>"><?php unset($attr8) ?><?php unset($attr8_for) ?><?php $attr9 = array('class'=>'text','raw'=>'_','escape'=>true) ?><?php $attr9_class='text' ?><?php $attr9_raw='_' ?><?php $attr9_escape=true ?><?php
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
		$tmp_text = isset($$attr9_var)?($attr9_escape?htmlentities($$attr9_var):$$attr9_var):'?'.$attr9_var.'?';	
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

	if	(isset($attr9_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr9_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
			
	echo $tmp_text;
?></span><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_raw) ?><?php unset($attr9_escape) ?><?php $attr9 = array('class'=>'text','text'=>'GLOBAL_RELEASE','escape'=>true) ?><?php $attr9_class='text' ?><?php $attr9_text='GLOBAL_RELEASE' ?><?php $attr9_escape=true ?><?php
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
		$tmp_text = isset($$attr9_var)?($attr9_escape?htmlentities($$attr9_var):$$attr9_var):'?'.$attr9_var.'?';	
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

	if	(isset($attr9_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr9_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
			
	echo $tmp_text;
?></span><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_text) ?><?php unset($attr9_escape) ?><?php $attr7 = array() ?></label><?php unset($attr7) ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr4 = array() ?><?php
	}
	
?><?php unset($attr4) ?><?php $attr5 = array('present'=>'publish') ?><?php $attr5_present='publish' ?><?php 

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
?><?php unset($attr5) ?><?php unset($attr5_present) ?><?php $attr6 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr6_class))
		$attr6_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr6_class ?>"><?php unset($attr6) ?><?php $attr7 = array('class'=>'fx','colspan'=>'3') ?><?php $attr7_class='fx' ?><?php $attr7_colspan='3' ?><?php
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
		
?><td <?php foreach( $attr7 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr7) ?><?php unset($attr7_class) ?><?php unset($attr7_colspan) ?><?php $attr8 = array('default'=>false,'readonly'=>false,'name'=>'publish') ?><?php $attr8_default=false ?><?php $attr8_readonly=false ?><?php $attr8_name='publish' ?><?php
	if	( isset($$attr8_name) )
		$checked = $$attr8_name;
	else
		$checked = $attr8_default;
?><input type="checkbox" id="id_<?php echo $attr8_name ?>" name="<?php echo $attr8_name  ?>"  <?php if ($attr8_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php unset($attr8_name); unset($attr8_readonly); unset($attr8_default); ?><?php unset($attr8) ?><?php unset($attr8_default) ?><?php unset($attr8_readonly) ?><?php unset($attr8_name) ?><?php $attr8 = array('for'=>'publish') ?><?php $attr8_for='publish' ?><label for="id_<?php echo $attr8_for ?><?php if (!empty($attr8_value)) echo '_'.$attr8_value ?>"><?php unset($attr8) ?><?php unset($attr8_for) ?><?php $attr9 = array('class'=>'text','raw'=>'_','escape'=>true) ?><?php $attr9_class='text' ?><?php $attr9_raw='_' ?><?php $attr9_escape=true ?><?php
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
		$tmp_text = isset($$attr9_var)?($attr9_escape?htmlentities($$attr9_var):$$attr9_var):'?'.$attr9_var.'?';	
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

	if	(isset($attr9_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr9_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
			
	echo $tmp_text;
?></span><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_raw) ?><?php unset($attr9_escape) ?><?php $attr9 = array('class'=>'text','text'=>'PAGE_PUBLISH_AFTER_SAVE','escape'=>true) ?><?php $attr9_class='text' ?><?php $attr9_text='PAGE_PUBLISH_AFTER_SAVE' ?><?php $attr9_escape=true ?><?php
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
		$tmp_text = isset($$attr9_var)?($attr9_escape?htmlentities($$attr9_var):$$attr9_var):'?'.$attr9_var.'?';	
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

	if	(isset($attr9_accesskey))
	{
		$pos = strpos(strtolower($tmp_text),strtolower($attr9_accesskey));
		if	( $pos !== false )
			$tmp_text = substr($tmp_text,0,max($pos,0)).'<span class="accesskey">'.substr($tmp_text,$pos,1).'</span>'.substr($tmp_text,$pos+1);
	}
			
	echo $tmp_text;
?></span><?php unset($attr9) ?><?php unset($attr9_class) ?><?php unset($attr9_text) ?><?php unset($attr9_escape) ?><?php $attr7 = array() ?></label><?php unset($attr7) ?><?php $attr6 = array() ?></td><?php unset($attr6) ?><?php $attr5 = array() ?></tr><?php unset($attr5) ?><?php $attr4 = array() ?><?php
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

?><tr class="<?php echo $attr5_class ?>"><?php unset($attr5) ?><?php $attr6 = array('class'=>'act','colspan'=>'3') ?><?php $attr6_class='act' ?><?php $attr6_colspan='3' ?><?php
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
		$attr7_type  = 'submit';
	if (isset($attr7_src))
		$attr7_type  = 'image';
	else
		$attr7_src  = '';
?><input type="<?php echo $attr7_type ?>"<?php if(isset($attr7_src)) { ?> src="<?php echo $image_dir.'icon_'.$attr7_src.IMG_ICON_EXT ?>"<?php } ?> name="<?php echo $attr7_value ?>" class="<?php echo $attr7_class ?>" title="<?php echo lang($attr7_text.'_DESC') ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($attr7_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr7_src) ?><?php unset($attr7) ?><?php unset($attr7_type) ?><?php unset($attr7_class) ?><?php unset($attr7_value) ?><?php unset($attr7_text) ?><?php $attr5 = array() ?></td><?php unset($attr5) ?><?php $attr4 = array() ?></tr><?php unset($attr4) ?><?php $attr3 = array() ?><?php
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