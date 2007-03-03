<?php $attr-2082672713 = array('class'=>'main','title'=>$cms_title) ?><?php $attr-2082672713_class='main' ?><?php $attr-2082672713_title=$cms_title ?><?php header('Content-Type: text/html; charset='.lang('CHARSET'))
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<!-- $Id$ -->
<head>
  <title><?php echo $attr-2082672713_title ?></title>
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

<body class="<?php echo $attr-2082672713_class ?>">

<?php unset($attr-2082672713) ?><?php unset($attr-2082672713_class) ?><?php unset($attr-2082672713_title) ?><?php $attr450215437 = array('target'=>'_self','method'=>'post','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr450215437_target='_self' ?><?php $attr450215437_method='post' ?><?php $attr450215437_enctype='application/x-www-form-urlencoded' ?><?php
	if	(empty($attr450215437_action))
		$attr450215437_action = $actionName;
	if	(empty($attr450215437_subaction))
		$attr450215437_subaction = $targetSubActionName;
	if	(empty($attr450215437_id))
		$attr450215437_id = $this->getRequestId();
		
?><form name="<?php echo $attr450215437_name ?>"
      target="<?php echo $attr450215437_target ?>"
      action="<?php echo Html::url( $attr450215437_action,$attr450215437_subaction,$attr450215437_id ) ?>"
      method="<?php echo $attr450215437_method ?>"
      enctype="<?php echo $attr450215437_enctype ?>">
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr450215437_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr450215437_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr450215437_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?><?php unset($attr450215437) ?><?php unset($attr450215437_target) ?><?php unset($attr450215437_method) ?><?php unset($attr450215437_enctype) ?><?php $attr1842515611 = array('width'=>'93%','rowclasses'=>'odd,even','columnclasses'=>'1,2,3') ?><?php $attr1842515611_width='93%' ?><?php $attr1842515611_rowclasses='odd,even' ?><?php $attr1842515611_columnclasses='1,2,3' ?><?php
	$coloumn_widths=array();
	if	(!empty($attr1842515611_widths))
	{
		$column_widths = explode(',',$attr1842515611_widths);
		unset($attr1842515611['widths']);
	}
	if	(!empty($attr1842515611_rowclasses))
	{
		$row_classes   = explode(',',$attr1842515611_rowclasses);
		$row_class_idx = 999;
		unset($attr1842515611['rowclasses']);
	}
	if	(!empty($attr1842515611_columnclasses))
	{
		$column_classes = explode(',',$attr1842515611_columnclasses);
		unset($attr1842515611['columnclasses']);
	}
		global $image_dir;
		echo '<br/><br/><br/><center>';
		echo '<table class="main" cellspacing="0" cellpadding="4" width="'.$attr1842515611_width.'">';
		echo '<tr><td class="menu">';
		if	( !empty($attr1842515611_icon) )
			echo '<img src="'.$image_dir.'icon_'.$attr1842515611_icon.IMG_ICON_EXT.'" align="left" border="0">';
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
      <table class="n" cellspacing="0" width="100%" cellpadding="4"><?php unset($attr1842515611) ?><?php unset($attr1842515611_width) ?><?php unset($attr1842515611_rowclasses) ?><?php unset($attr1842515611_columnclasses) ?><?php $attr-206169288 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr-206169288_class))
		$attr-206169288_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr-206169288_class ?>"><?php unset($attr-206169288) ?><?php $attr-2068763730 = array('class'=>'fx') ?><?php $attr-2068763730_class='fx' ?><?php
//	if (empty($attr-2068763730_class))
//		$attr-2068763730['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr-2068763730_class))
		$attr-2068763730['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr-2068763730_rowspan) )
		$attr-2068763730['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr-2068763730 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr-2068763730) ?><?php unset($attr-2068763730_class) ?><?php $attr498629140 = array('default'=>'','readonly'=>'','name'=>'files') ?><?php $attr498629140_default='' ?><?php $attr498629140_readonly='' ?><?php $attr498629140_name='files' ?><?php
	$attr498629140_default  = ( $attr498629140_default  == true );
	
	if	( isset($$attr498629140_name) )
		$checked = $$attr498629140_name == true;
//		$checked = isset($$$attr498629140_name)&& $$$attr498629140_name==true;
	else
		$checked = $attr498629140_default == true;
?><input type="checkbox" name="<?php echo $attr498629140_name  ?>" <?php if ($attr498629140_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php unset($attr498629140_name); unset($attr498629140_readonly); unset($attr498629140_default); ?><?php unset($attr498629140) ?><?php unset($attr498629140_default) ?><?php unset($attr498629140_readonly) ?><?php unset($attr498629140_name) ?><?php $attr498629140 = array('class'=>'text','raw'=>'_') ?><?php $attr498629140_class='text' ?><?php $attr498629140_raw='_' ?><?php
	if(empty($attr498629140_title))
		if (!empty($attr498629140_key))
			$attr498629140_title = lang($attr498629140_key).'_HELP';
		else
			$attr498629140_title = '';

?><span class="<?php echo $attr498629140_class ?>" title="<?php echo $attr498629140_title ?>"><?php
	$attr498629140_title = '';
	if (!empty($attr498629140_array))
	{
		//geht nicht:
		//echo $$attr498629140_array[$attr498629140_var].'%';
		$tmpArray = $$attr498629140_array;
		if (!empty($attr498629140_var))
			$tmp_text = $tmpArray[$attr498629140_var];
		else
			$tmp_text = lang($tmpArray[$attr498629140_text]);
	}
	elseif (!empty($attr498629140_text))
		if	( isset($$attr498629140_text))
			$tmp_text = lang($$attr498629140_text);
		else
			$tmp_text = lang($attr498629140_text);
	elseif (!empty($attr498629140_textvar))
		$tmp_text = lang($$attr498629140_textvar);
	elseif (!empty($attr498629140_key))
		$tmp_text = lang($attr498629140_key);
	elseif (!empty($attr498629140_var))
		$tmp_text = isset($$attr498629140_var)?htmlentities($$attr498629140_var):'error: variable '.$attr498629140_var.' not present';	
	elseif (!empty($attr498629140_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr498629140_raw);
	elseif (!empty($attr498629140_value))
		$tmp_text = $attr498629140_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr498629140);echo 'text error';
	}
	
	if	( !empty($attr498629140_maxlength) && intval($attr498629140_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr498629140_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr498629140) ?><?php unset($attr498629140_class) ?><?php unset($attr498629140_raw) ?><?php $attr498629140 = array('class'=>'text','text'=>'global_files') ?><?php $attr498629140_class='text' ?><?php $attr498629140_text='global_files' ?><?php
	if(empty($attr498629140_title))
		if (!empty($attr498629140_key))
			$attr498629140_title = lang($attr498629140_key).'_HELP';
		else
			$attr498629140_title = '';

?><span class="<?php echo $attr498629140_class ?>" title="<?php echo $attr498629140_title ?>"><?php
	$attr498629140_title = '';
	if (!empty($attr498629140_array))
	{
		//geht nicht:
		//echo $$attr498629140_array[$attr498629140_var].'%';
		$tmpArray = $$attr498629140_array;
		if (!empty($attr498629140_var))
			$tmp_text = $tmpArray[$attr498629140_var];
		else
			$tmp_text = lang($tmpArray[$attr498629140_text]);
	}
	elseif (!empty($attr498629140_text))
		if	( isset($$attr498629140_text))
			$tmp_text = lang($$attr498629140_text);
		else
			$tmp_text = lang($attr498629140_text);
	elseif (!empty($attr498629140_textvar))
		$tmp_text = lang($$attr498629140_textvar);
	elseif (!empty($attr498629140_key))
		$tmp_text = lang($attr498629140_key);
	elseif (!empty($attr498629140_var))
		$tmp_text = isset($$attr498629140_var)?htmlentities($$attr498629140_var):'error: variable '.$attr498629140_var.' not present';	
	elseif (!empty($attr498629140_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr498629140_raw);
	elseif (!empty($attr498629140_value))
		$tmp_text = $attr498629140_value;
	else
	{
	  $tmp_text = '&nbsp;';
	  //Html::debug($attr498629140);echo 'text error';
	}
	
	if	( !empty($attr498629140_maxlength) && intval($attr498629140_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr498629140_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr498629140) ?><?php unset($attr498629140_class) ?><?php unset($attr498629140_text) ?><?php $attr498629140 = array() ?><br/><?php unset($attr498629140) ?><?php $attr-206169288 = array() ?></td><?php unset($attr-206169288) ?><?php $attr1842515611 = array() ?></tr><?php unset($attr1842515611) ?><?php $attr-206169288 = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr-206169288_class))
		$attr-206169288_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr-206169288_class ?>"><?php unset($attr-206169288) ?><?php $attr-2068763730 = array('class'=>'act') ?><?php $attr-2068763730_class='act' ?><?php
//	if (empty($attr-2068763730_class))
//		$attr-2068763730['class']=$row_class;
	$column_class_idx++;
	if ($column_class_idx > count($column_classes))
		$column_class_idx=1;
	$column_class=$column_classes[$column_class_idx-1];
	if (empty($attr-2068763730_class))
		$attr-2068763730['class']=$column_class;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr-2068763730_rowspan) )
		$attr-2068763730['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr-2068763730 as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr-2068763730) ?><?php unset($attr-2068763730_class) ?><?php $attr498629140 = array('type'=>'ok','class'=>'ok','value'=>'ok','text'=>'button_ok') ?><?php $attr498629140_type='ok' ?><?php $attr498629140_class='ok' ?><?php $attr498629140_value='ok' ?><?php $attr498629140_text='button_ok' ?><?php
	if ($attr498629140_type=='ok')
	{
		$attr498629140_type  = 'submit';
//		$attr498629140_class = 'ok';
//		$attr498629140_text  = 'BUTTON_OK';
//		$attr498629140_value = 'ok';
	}
?><input type="<?php echo $attr498629140_type ?>" name="<?php echo $attr498629140_value ?>" class="<?php echo $attr498629140_class ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($attr498629140_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr498629140) ?><?php unset($attr498629140_type) ?><?php unset($attr498629140_class) ?><?php unset($attr498629140_value) ?><?php unset($attr498629140_text) ?><?php $attr-206169288 = array() ?></td><?php unset($attr-206169288) ?><?php $attr1842515611 = array() ?></tr><?php unset($attr1842515611) ?><?php $attr450215437 = array() ?>      </table>
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
<?php unset($attr450215437) ?><?php $attr-2082672713 = array() ?></form>

<?php unset($attr-2082672713) ?><?php $attr-186917087 = array() ?>
<!-- $Id$ -->

<?php if ($showDuration) { ?>
<br/>
<small>&nbsp;
<?php $dur = time()-START_TIME;
//      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small>
<?php } ?>

</body>
</html><?php unset($attr-186917087) ?>