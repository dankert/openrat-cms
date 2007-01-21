<?php $attr = array('class'=>'main title') ?><?php $attr_class='main title' ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<!-- $Id$ -->
<head>
  <title><?php echo $attr_title ?></title>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <meta name="MSSmartTagsPreventParsing" content="true" />
  <meta name="robots" content="noindex,nofollow" />
  <link rel="stylesheet" type="text/css" href="./themes/default/css/default.css" />
<?php if($stylesheet!='default') { ?>
  <link rel="stylesheet" type="text/css" href="<?php echo $stylesheet ?>" />
<?php } ?>
</head>

<body class="<?php echo $attr_class ?>">

<?php unset($attr) ?><?php unset($attr_class) ?><?php $attr = array('name'=>'','target'=>'_self','method'=>'post','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr_name='' ?><?php $attr_target='_self' ?><?php $attr_method='post' ?><?php $attr_enctype='application/x-www-form-urlencoded' ?><?php
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
?><?php unset($attr) ?><?php unset($attr_name) ?><?php unset($attr_target) ?><?php unset($attr_method) ?><?php unset($attr_enctype) ?><?php $attr = array('name'=>'GLOBAL_GROUPS','icon'=>'group','width'=>'93%','rowclasses'=>'odd,even','columnclasses'=>'1,2,3') ?><?php $attr_name='GLOBAL_GROUPS' ?><?php $attr_icon='group' ?><?php $attr_width='93%' ?><?php $attr_rowclasses='odd,even' ?><?php $attr_columnclasses='1,2,3' ?><?php
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
      <table class="n" cellspacing="0" width="100%" cellpadding="4"><?php unset($attr) ?><?php unset($attr_name) ?><?php unset($attr_icon) ?><?php unset($attr_width) ?><?php unset($attr_rowclasses) ?><?php unset($attr_columnclasses) ?><?php $attr = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr_class))
		$attr_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr_class ?>"><?php unset($attr) ?><?php $attr = array() ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php $attr = array('class'=>'text','text'=>'GLOBAL_NAME') ?><?php $attr_class='text' ?><?php $attr_text='GLOBAL_NAME' ?><?php
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
		if	( isset($$attr_text))
			$tmp_text = lang($$attr_text);
		else
			$tmp_text = lang($attr_text);
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
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_text) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array('class'=>'fx') ?><?php $attr_class='fx' ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_class) ?><?php $attr = array('class'=>'text','var'=>'name') ?><?php $attr_class='text' ?><?php $attr_var='name' ?><?php
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
		if	( isset($$attr_text))
			$tmp_text = lang($$attr_text);
		else
			$tmp_text = lang($attr_text);
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
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
	$row_class_idx++;
	if ($row_class_idx > count($row_classes))
		$row_class_idx=1;
	$row_class=$row_classes[$row_class_idx-1];

	if (empty($attr_class))
		$attr_class=$row_class;
		
	global $cell_column_nr;
	$cell_column_nr=0;
	
	$column_class_idx = 999;

?><tr class="<?php echo $attr_class ?>"><?php unset($attr) ?><?php $attr = array() ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php $attr = array('class'=>'text','text'=>'GLOBAL_DELETE') ?><?php $attr_class='text' ?><?php $attr_text='GLOBAL_DELETE' ?><?php
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
		if	( isset($$attr_text))
			$tmp_text = lang($$attr_text);
		else
			$tmp_text = lang($attr_text);
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
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_text) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php $attr = array('default'=>'','readonly'=>'','name'=>'delete') ?><?php $attr_default='' ?><?php $attr_readonly='' ?><?php $attr_name='delete' ?><?php
	$attr_default  = ( $attr_default  == true );
	
	if	( isset($$attr_name) )
		$checked = $$attr_name == true;
//		$checked = isset($$$attr_name)&& $$$attr_name==true;
	else
		$checked = $attr_default == true;
?><input type="checkbox" name="<?php echo $attr_name  ?>" <?php if ($attr_readonly) echo ' disabled="disabled"' ?> value="1" <?php if( $checked ) echo 'checked="checked"' ?> /><?php unset($attr_name); unset($attr_readonly); unset($attr_default); ?><?php unset($attr) ?><?php unset($attr_default) ?><?php unset($attr_readonly) ?><?php unset($attr_name) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php $attr = array('class'=>'text','text'=>'GROUP_DELETE_DESC') ?><?php $attr_class='text' ?><?php $attr_text='GROUP_DELETE_DESC' ?><?php
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
		if	( isset($$attr_text))
			$tmp_text = lang($$attr_text);
		else
			$tmp_text = lang($attr_text);
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
?></span><?php unset($attr) ?><?php unset($attr_class) ?><?php unset($attr_text) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?><?php
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
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_colspan) ?><?php $attr = array('type'=>'ok','class'=>'ok','value'=>'ok','text'=>'button_ok') ?><?php $attr_type='ok' ?><?php $attr_class='ok' ?><?php $attr_value='ok' ?><?php $attr_text='button_ok' ?><?php
	if ($attr_type=='ok')
	{
		$attr_type  = 'submit';
//		$attr_class = 'ok';
//		$attr_text  = 'BUTTON_OK';
//		$attr_value = 'ok';
	}
?><input type="<?php echo $attr_type ?>" name="<?php echo $attr_value ?>" class="<?php echo $attr_class ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($attr_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" /><?php unset($attr) ?><?php unset($attr_type) ?><?php unset($attr_class) ?><?php unset($attr_value) ?><?php unset($attr_text) ?><?php $attr = array() ?></td><?php unset($attr) ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php $attr = array() ?>      </table>
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

<?php unset($attr) ?><?php $attr = array('field'=>'delete') ?><?php $attr_field='delete' ?>
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