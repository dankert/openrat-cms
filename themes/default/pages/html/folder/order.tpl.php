<?php /* source: ./themes/default/include/html/page.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
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

<body<?php if( isset($css_body_class) )echo ' class="'.$css_body_class.'"' ?>>


<?php unset($attr) ?><?php /* source: ./themes/default/include/html/window.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'','name'=>'','widths'=>'','width'=>'') ?><?php $attr_title='' ?><?php $attr_name='' ?><?php $attr_widths='' ?><?php $attr_width='' ?><?php
	$coloumn_widths=array();
	if	(!empty($attr_widths))
	{
		$column_widths = explode(',',$attr_widths);
		unset($attr['widths']);
	}
		global $image_dir;
		if	( !isset($attr_width)) $attr['width']='90%';
		echo '<br/><br/><br/><center>';
		echo '<table class="main" cellspacing="0" cellpadding="4" ';
		foreach( $attr as $aName=>$aValue )
			echo " $aName=\"$aValue\"";
		echo '>';
		echo '<tr><th>';
		if	( !empty($attr_icon) )
			echo '<img src="'.$image_dir.'icon_'.$attr_icon.IMG_EXT.'" align="left" border="0">';
		if	( !isset($$attr_name)) $$attr_name='';
		echo $$attr_name.': ';
		echo lang( $attr_title );
		?>
    </th>
  </tr>
  <tr><td class="subaction">
    <?php foreach( $windowMenu as $menu )
          {
          	?><a href="<?php echo Html::url($actionName,$menu['subaction']) ?>"><?php echo lang($menu['text']) ?></a>&nbsp;&nbsp;&nbsp;<?php
          }
          	?></td>
  </tr>

<?php if (isset($notices) && count($notices)>0 )
      { ?>

  <tr>
    <td><table>

  <?php foreach( $notices as $notice ) { ?>

    <td><img src="<?php echo $image_dir.'notice_'.$notice['status'].IMG_EXT ?>" style="padding:10px" /></td>
    <td class="f1"><?php if ($notice['name']!='') { ?><img src="<?php echo $image_dir.'icon_'.$notice['type'].IMG_EXT ?>" align="left" /><?php echo $notice['name'] ?>: <?php } ?><?php if ($notice['status']=='error') { ?><strong><?php } ?><?php echo $notice['text'] ?><?php if ($notice['status']=='error') { ?></strong><?php } ?></td>
  </tr>
  <?php } ?>

    </table></td>
  </tr>

<?php } ?>



  <tr>
    <td>
      <table class="n" cellspacing="0" width="100%" cellpadding="4">
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_name) ?><?php unset($attr_widths) ?><?php unset($attr_width) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';

	global $cell_column_nr;
	$cell_column_nr=0;

?><tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'help','colspan'=>'7') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='help' ?><?php $attr_colspan='7' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'GLOBAL_FOLDER_DESC','raw'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='GLOBAL_FOLDER_DESC' ?><?php $attr_raw='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
	if (!empty($attr_url))
		echo "<a href=\"".$$attr_url."\" title=\"$attr_title\">";
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			echo $tmpArray[$attr_var];
		else
			echo lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		echo lang($attr_text);
	elseif (!empty($attr_var))
		echo $$attr_var;
	elseif (!empty($attr_raw))
		echo str_replace('_',' ',$attr_raw);
	else echo 'text error';

	if (!empty($attr_url))
		echo '</a';
?></span>
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?>
<?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';

	global $cell_column_nr;
	$cell_column_nr=0;

?><tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'help','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='help' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/link.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'FOLDER_ORDERBYTYPE','target'=>'','url'=>'orderbytype_url') ?><?php $attr_title='FOLDER_ORDERBYTYPE' ?><?php $attr_target='' ?><?php $attr_url='orderbytype_url' ?><a href="<?php echo $$attr_url ?>" target="<?php echo $attr_target ?>" title="<?php echo lang($$attr_title) ?>">
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'GLOBAL_TYPE','raw'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='GLOBAL_TYPE' ?><?php $attr_raw='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
	if (!empty($attr_url))
		echo "<a href=\"".$$attr_url."\" title=\"$attr_title\">";
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			echo $tmpArray[$attr_var];
		else
			echo lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		echo lang($attr_text);
	elseif (!empty($attr_var))
		echo $$attr_var;
	elseif (!empty($attr_raw))
		echo str_replace('_',' ',$attr_raw);
	else echo 'text error';

	if (!empty($attr_url))
		echo '</a';
?></span>
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/link-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></a>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>'_/_') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw='_/_' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
	if (!empty($attr_url))
		echo "<a href=\"".$$attr_url."\" title=\"$attr_title\">";
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			echo $tmpArray[$attr_var];
		else
			echo lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		echo lang($attr_text);
	elseif (!empty($attr_var))
		echo $$attr_var;
	elseif (!empty($attr_raw))
		echo str_replace('_',' ',$attr_raw);
	else echo 'text error';

	if (!empty($attr_url))
		echo '</a';
?></span>
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/link.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'FOLDER_ORDERBYNAME','target'=>'','url'=>'orderbyname_url') ?><?php $attr_title='FOLDER_ORDERBYNAME' ?><?php $attr_target='' ?><?php $attr_url='orderbyname_url' ?><a href="<?php echo $$attr_url ?>" target="<?php echo $attr_target ?>" title="<?php echo lang($$attr_title) ?>">
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'GLOBAL_NAME','raw'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='GLOBAL_NAME' ?><?php $attr_raw='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
	if (!empty($attr_url))
		echo "<a href=\"".$$attr_url."\" title=\"$attr_title\">";
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			echo $tmpArray[$attr_var];
		else
			echo lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		echo lang($attr_text);
	elseif (!empty($attr_var))
		echo $$attr_var;
	elseif (!empty($attr_raw))
		echo str_replace('_',' ',$attr_raw);
	else echo 'text error';

	if (!empty($attr_url))
		echo '</a';
?></span>
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/link-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></a>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'help','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='help' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/link.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'FOLDER_ORDERBYLASTCHANGE','target'=>'','url'=>'orderbylastchange_url') ?><?php $attr_title='FOLDER_ORDERBYLASTCHANGE' ?><?php $attr_target='' ?><?php $attr_url='orderbylastchange_url' ?><a href="<?php echo $$attr_url ?>" target="<?php echo $attr_target ?>" title="<?php echo lang($$attr_title) ?>">
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'GLOBAL_LASTCHANGE','raw'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='GLOBAL_LASTCHANGE' ?><?php $attr_raw='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
	if (!empty($attr_url))
		echo "<a href=\"".$$attr_url."\" title=\"$attr_title\">";
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			echo $tmpArray[$attr_var];
		else
			echo lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		echo lang($attr_text);
	elseif (!empty($attr_var))
		echo $$attr_var;
	elseif (!empty($attr_raw))
		echo str_replace('_',' ',$attr_raw);
	else echo 'text error';

	if (!empty($attr_url))
		echo '</a';
?></span>
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/link-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></a>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'help','colspan'=>'4') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='help' ?><?php $attr_colspan='4' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/link.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'FOLDER_FLIP','target'=>'','url'=>'flip_url') ?><?php $attr_title='FOLDER_FLIP' ?><?php $attr_target='' ?><?php $attr_url='flip_url' ?><a href="<?php echo $$attr_url ?>" target="<?php echo $attr_target ?>" title="<?php echo lang($$attr_title) ?>">
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'FOLDER_ORDER','raw'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='FOLDER_ORDER' ?><?php $attr_raw='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
	if (!empty($attr_url))
		echo "<a href=\"".$$attr_url."\" title=\"$attr_title\">";
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			echo $tmpArray[$attr_var];
		else
			echo lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		echo lang($attr_text);
	elseif (!empty($attr_var))
		echo $$attr_var;
	elseif (!empty($attr_raw))
		echo str_replace('_',' ',$attr_raw);
	else echo 'text error';

	if (!empty($attr_url))
		echo '</a';
?></span>
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?>
<?php /* source: ./themes/default/include/html/link-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></a>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/list.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('list'=>'object','extract'=>'true','key'=>'list_key','value'=>'list_value') ?><?php $attr_list='object' ?><?php $attr_extract='true' ?><?php $attr_key='list_key' ?><?php $attr_value='list_value' ?><?php
	$list_tmp_key   = $attr_key;
	$list_tmp_value = $attr_value;
	$list_extract   = ($attr_extract=='true');


	foreach( $$attr_list as $$list_tmp_key => $$list_tmp_value )
	{
		if	( $list_extract )
			extract($$list_tmp_value);
?>
<?php unset($attr) ?><?php unset($attr_list) ?><?php unset($attr_extract) ?><?php unset($attr_key) ?><?php unset($attr_value) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';

	global $cell_column_nr;
	$cell_column_nr=0;

?><tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('width'=>'40%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='40%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/image.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('file'=>'','url'=>'','align'=>'left','type'=>'icon') ?><?php $attr_file='' ?><?php $attr_url='' ?><?php $attr_align='left' ?><?php $attr_type='icon' ?><?php
if (!empty($attr_eltype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$$attr_eltype.IMG_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$$attr_type.IMG_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($$attr_url)) {
?><img src="<?php echo $$attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_file)) {
?><img src="<?php echo $image_dir.$$attr_file.IMG_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?>
<?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_url) ?><?php unset($attr_align) ?><?php unset($attr_type) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'name','text'=>'','raw'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='name' ?><?php $attr_text='' ?><?php $attr_raw='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
	if (!empty($attr_url))
		echo "<a href=\"".$$attr_url."\" title=\"$attr_title\">";
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			echo $tmpArray[$attr_var];
		else
			echo lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		echo lang($attr_text);
	elseif (!empty($attr_var))
		echo $$attr_var;
	elseif (!empty($attr_raw))
		echo str_replace('_',' ',$attr_raw);
	else echo 'text error';

	if (!empty($attr_url))
		echo '</a';
?></span>
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('width'=>'18%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='18%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'date','text'=>'','raw'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='date' ?><?php $attr_text='' ?><?php $attr_raw='' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
	if (!empty($attr_url))
		echo "<a href=\"".$$attr_url."\" title=\"$attr_title\">";
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			echo $tmpArray[$attr_var];
		else
			echo lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		echo lang($attr_text);
	elseif (!empty($attr_var))
		echo $$attr_var;
	elseif (!empty($attr_raw))
		echo str_replace('_',' ',$attr_raw);
	else echo 'text error';

	if (!empty($attr_url))
		echo '</a';
?></span>
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('width'=>'3%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='3%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/if.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'upurl','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='upurl' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php

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
?>
<?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php /* source: ./themes/default/include/html/link.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'GLOBAL_UP','target'=>'','url'=>'upurl') ?><?php $attr_title='GLOBAL_UP' ?><?php $attr_target='' ?><?php $attr_url='upurl' ?><a href="<?php echo $$attr_url ?>" target="<?php echo $attr_target ?>" title="<?php echo lang($$attr_title) ?>">
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php /* source: ./themes/default/include/html/set.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('var'=>'bild','value'=>'arrow_up') ?><?php $attr_var='bild' ?><?php $attr_value='arrow_up' ?><?php $$attr_var = $attr_value ?>
<?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php /* source: ./themes/default/include/html/image.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('file'=>'bild','url'=>'','align'=>'left','type'=>'') ?><?php $attr_file='bild' ?><?php $attr_url='' ?><?php $attr_align='left' ?><?php $attr_type='' ?><?php
if (!empty($attr_eltype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$$attr_eltype.IMG_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$$attr_type.IMG_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($$attr_url)) {
?><img src="<?php echo $$attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_file)) {
?><img src="<?php echo $image_dir.$$attr_file.IMG_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?>
<?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_url) ?><?php unset($attr_align) ?><?php unset($attr_type) ?><?php /* source: ./themes/default/include/html/link-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></a>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/if-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?><?php
	}
?>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/if.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'upurl','present'=>'','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='upurl' ?><?php $attr_present='' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php

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
?>
<?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>'_') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw='_' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
	if (!empty($attr_url))
		echo "<a href=\"".$$attr_url."\" title=\"$attr_title\">";
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			echo $tmpArray[$attr_var];
		else
			echo lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		echo lang($attr_text);
	elseif (!empty($attr_var))
		echo $$attr_var;
	elseif (!empty($attr_raw))
		echo str_replace('_',' ',$attr_raw);
	else echo 'text error';

	if (!empty($attr_url))
		echo '</a';
?></span>
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/if-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?><?php
	}
?>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('width'=>'3%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='3%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/if.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'topurl','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='topurl' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php

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
?>
<?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php /* source: ./themes/default/include/html/link.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'GLOBAL_TOP','target'=>'','url'=>'topurl') ?><?php $attr_title='GLOBAL_TOP' ?><?php $attr_target='' ?><?php $attr_url='topurl' ?><a href="<?php echo $$attr_url ?>" target="<?php echo $attr_target ?>" title="<?php echo lang($$attr_title) ?>">
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php /* source: ./themes/default/include/html/set.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('var'=>'bild','value'=>'arrow_top') ?><?php $attr_var='bild' ?><?php $attr_value='arrow_top' ?><?php $$attr_var = $attr_value ?>
<?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php /* source: ./themes/default/include/html/image.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('file'=>'bild','url'=>'','align'=>'left','type'=>'') ?><?php $attr_file='bild' ?><?php $attr_url='' ?><?php $attr_align='left' ?><?php $attr_type='' ?><?php
if (!empty($attr_eltype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$$attr_eltype.IMG_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$$attr_type.IMG_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($$attr_url)) {
?><img src="<?php echo $$attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_file)) {
?><img src="<?php echo $image_dir.$$attr_file.IMG_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?>
<?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_url) ?><?php unset($attr_align) ?><?php unset($attr_type) ?><?php /* source: ./themes/default/include/html/link-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></a>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/if-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?><?php
	}
?>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/if.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'topurl','present'=>'','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='topurl' ?><?php $attr_present='' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php

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
?>
<?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>'_') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw='_' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
	if (!empty($attr_url))
		echo "<a href=\"".$$attr_url."\" title=\"$attr_title\">";
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			echo $tmpArray[$attr_var];
		else
			echo lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		echo lang($attr_text);
	elseif (!empty($attr_var))
		echo $$attr_var;
	elseif (!empty($attr_raw))
		echo str_replace('_',' ',$attr_raw);
	else echo 'text error';

	if (!empty($attr_url))
		echo '</a';
?></span>
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/if-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?><?php
	}
?>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('width'=>'3%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='3%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/if.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'bottomurl','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='bottomurl' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php

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
?>
<?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php /* source: ./themes/default/include/html/link.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'GLOBAL_BOTTOM','target'=>'','url'=>'bottomurl') ?><?php $attr_title='GLOBAL_BOTTOM' ?><?php $attr_target='' ?><?php $attr_url='bottomurl' ?><a href="<?php echo $$attr_url ?>" target="<?php echo $attr_target ?>" title="<?php echo lang($$attr_title) ?>">
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php /* source: ./themes/default/include/html/set.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('var'=>'bild','value'=>'arrow_bottom') ?><?php $attr_var='bild' ?><?php $attr_value='arrow_bottom' ?><?php $$attr_var = $attr_value ?>
<?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php /* source: ./themes/default/include/html/image.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('file'=>'bild','url'=>'','align'=>'left','type'=>'') ?><?php $attr_file='bild' ?><?php $attr_url='' ?><?php $attr_align='left' ?><?php $attr_type='' ?><?php
if (!empty($attr_eltype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$$attr_eltype.IMG_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$$attr_type.IMG_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($$attr_url)) {
?><img src="<?php echo $$attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_file)) {
?><img src="<?php echo $image_dir.$$attr_file.IMG_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?>
<?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_url) ?><?php unset($attr_align) ?><?php unset($attr_type) ?><?php /* source: ./themes/default/include/html/link-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></a>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/if-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?><?php
	}
?>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/if.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'bottomurl','present'=>'','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='bottomurl' ?><?php $attr_present='' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php

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
?>
<?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>'_') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw='_' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
	if (!empty($attr_url))
		echo "<a href=\"".$$attr_url."\" title=\"$attr_title\">";
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			echo $tmpArray[$attr_var];
		else
			echo lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		echo lang($attr_text);
	elseif (!empty($attr_var))
		echo $$attr_var;
	elseif (!empty($attr_raw))
		echo str_replace('_',' ',$attr_raw);
	else echo 'text error';

	if (!empty($attr_url))
		echo '</a';
?></span>
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/if-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?><?php
	}
?>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('width'=>'3%','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='3%' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/if.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'','present'=>'downurl','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='' ?><?php $attr_present='downurl' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php

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
?>
<?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php /* source: ./themes/default/include/html/link.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'GLOBAL_DOWN','target'=>'','url'=>'downurl') ?><?php $attr_title='GLOBAL_DOWN' ?><?php $attr_target='' ?><?php $attr_url='downurl' ?><a href="<?php echo $$attr_url ?>" target="<?php echo $attr_target ?>" title="<?php echo lang($$attr_title) ?>">
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php /* source: ./themes/default/include/html/set.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('var'=>'bild','value'=>'arrow_down') ?><?php $attr_var='bild' ?><?php $attr_value='arrow_down' ?><?php $$attr_var = $attr_value ?>
<?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php /* source: ./themes/default/include/html/image.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('file'=>'bild','url'=>'','align'=>'left','type'=>'') ?><?php $attr_file='bild' ?><?php $attr_url='' ?><?php $attr_align='left' ?><?php $attr_type='' ?><?php
if (!empty($attr_eltype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$$attr_eltype.IMG_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$$attr_type.IMG_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($$attr_url)) {
?><img src="<?php echo $$attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_file)) {
?><img src="<?php echo $image_dir.$$attr_file.IMG_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?>
<?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_url) ?><?php unset($attr_align) ?><?php unset($attr_type) ?><?php /* source: ./themes/default/include/html/link-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></a>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/if-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?><?php
	}
?>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/if.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('var'=>'','value'=>'','invert'=>'','empty'=>'downurl','present'=>'','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='' ?><?php $attr_empty='downurl' ?><?php $attr_present='' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php

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
?>
<?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>'_') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw='_' ?><?php
	if(empty($attr_title)) $attr_title = $attr_text;
?><span class="<?php echo $attr_class ?>"><?php
	if (!empty($attr_url))
		echo "<a href=\"".$$attr_url."\" title=\"$attr_title\">";
	if (!empty($attr_array))
	{
		//geht nicht:
		//echo $$attr_array[$attr_var].'%';
		$tmpArray = $$attr_array;
		if (!empty($attr_var))
			echo $tmpArray[$attr_var];
		else
			echo lang($tmpArray[$attr_text]);
	}
	elseif (!empty($attr_text))
		echo lang($attr_text);
	elseif (!empty($attr_var))
		echo $$attr_var;
	elseif (!empty($attr_raw))
		echo str_replace('_',' ',$attr_raw);
	else echo 'text error';

	if (!empty($attr_url))
		echo '</a';
?></span>
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/if-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?><?php
	}
?>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?></tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/list-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?><?php } ?>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/window-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?>      </table>
	</td>
  </tr>
</table>

</center>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/page-end.inc.php - compile time: Wed, 11 Jan 2006 22:01:27 +0100 */ ?><?php $attr = array() ?>
<!-- $Id$ -->

<?php if ($showDuration) { ?>
<br/>
<small>&nbsp;
<?php $dur = time()-START_TIME;
      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small>
<?php } ?>

</body>
</html>
<?php unset($attr) ?>