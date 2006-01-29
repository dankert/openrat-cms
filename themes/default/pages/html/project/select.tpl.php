<?php /* source: ./themes/default/include/html/page.inc.php - compile time: Wed, 18 Jan 2006 22:37:09 +0100 */ ?><?php $attr = array('class'=>'') ?><?php $attr_class='' ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
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


<?php unset($attr) ?><?php unset($attr_class) ?><?php /* source: ./themes/default/include/html/window.inc.php - compile time: Wed, 18 Jan 2006 22:37:09 +0100 */ ?><?php $attr = array('title'=>'GLOBAL_PROJECTS','name'=>'login','widths'=>'','width'=>'400') ?><?php $attr_title='GLOBAL_PROJECTS' ?><?php $attr_name='login' ?><?php $attr_widths='' ?><?php $attr_width='400' ?><?php
	$coloumn_widths=array();
	if	(!empty($attr_widths))
	{
		$column_widths = explode(',',$attr_widths);
		unset($attr['widths']);
	}
		global $image_dir;
		if	( empty($attr_width)) $attr['width']='90%';
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
      <table class="n" cellspacing="0" width="100%" cellpadding="4"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_name) ?><?php unset($attr_widths) ?><?php unset($attr_width) ?><?php /* source: ./themes/default/include/html/list.inc.php - compile time: Wed, 18 Jan 2006 22:37:09 +0100 */ ?><?php $attr = array('list'=>'el','extract'=>'true','key'=>'list_key','value'=>'list_value') ?><?php $attr_list='el' ?><?php $attr_extract='true' ?><?php $attr_key='list_key' ?><?php $attr_value='list_value' ?><?php
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
?><?php unset($attr) ?><?php unset($attr_list) ?><?php unset($attr_extract) ?><?php unset($attr_key) ?><?php unset($attr_value) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Wed, 18 Jan 2006 22:37:09 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';
	
	global $cell_column_nr;
	$cell_column_nr=0;

?><tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 18 Jan 2006 22:37:09 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;
	
	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];
		
?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>><?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/link.inc.php - compile time: Wed, 18 Jan 2006 22:37:09 +0100 */ ?><?php $attr = array('title'=>'TREE_CHOOSE_PROJECT','target'=>'','url'=>'url','class'=>'') ?><?php $attr_title='TREE_CHOOSE_PROJECT' ?><?php $attr_target='' ?><?php $attr_url='url' ?><?php $attr_class='' ?><a href="<?php echo $$attr_url ?>" class="<?php echo $attr_class ?>" target="<?php echo $attr_target ?>" title="<?php echo hasLang($attr_title)?lang($attr_title):lang($$attr_title) ?>"><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php unset($attr_class) ?><?php /* source: ./themes/default/include/html/set.inc.php - compile time: Wed, 18 Jan 2006 22:37:09 +0100 */ ?><?php $attr = array('var'=>'project','value'=>'project') ?><?php $attr_var='project' ?><?php $attr_value='project' ?><?php $$attr_var = $attr_value ?><?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php /* source: ./themes/default/include/html/image.inc.php - compile time: Wed, 18 Jan 2006 22:37:09 +0100 */ ?><?php $attr = array('file'=>'','url'=>'','align'=>'left','type'=>'project') ?><?php $attr_file='' ?><?php $attr_url='' ?><?php $attr_align='left' ?><?php $attr_type='project' ?><?php
if (!empty($attr_eltype)) {
?><img src="<?php echo $image_dir.'icon_el_'.$$attr_eltype.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_type)) {
?><img src="<?php echo $image_dir.'icon_'.$$attr_type.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($$attr_url)) {
?><img src="<?php echo $$attr_url ?>" border="0" align="<?php echo $attr_align ?>"><?php
} elseif (!empty($attr_file)) {
?><img src="<?php echo $image_dir.$$attr_file.IMG_ICON_EXT ?>" border="0" align="<?php echo $attr_align ?>"><?php } ?><?php unset($attr) ?><?php unset($attr_file) ?><?php unset($attr_url) ?><?php unset($attr_align) ?><?php unset($attr_type) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 18 Jan 2006 22:37:09 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'name','text'=>'','raw'=>'','maxlength'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='name' ?><?php $attr_text='' ?><?php $attr_raw='' ?><?php $attr_maxlength='' ?><?php
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
		$tmp_text = $$attr_var;	
	elseif (!empty($attr_raw))
		$tmp_text = str_replace('_','&nbsp;',$attr_raw);
	else echo 'text error';
	
	if	( !empty($attr_maxlength) && intval($attr_maxlength)!=0  )
		$tmp_text = Text::maxLength( $tmp_text,intval($attr_maxlength) );
		
	echo $tmp_text;
?></span><?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php unset($attr_maxlength) ?><?php /* source: ./themes/default/include/html/link-end.inc.php - compile time: Wed, 18 Jan 2006 22:37:09 +0100 */ ?><?php $attr = array() ?></a><?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 18 Jan 2006 22:37:09 +0100 */ ?><?php $attr = array() ?></td><?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Wed, 18 Jan 2006 22:37:09 +0100 */ ?><?php $attr = array() ?></tr><?php unset($attr) ?><?php /* source: ./themes/default/include/html/list-end.inc.php - compile time: Wed, 18 Jan 2006 22:37:09 +0100 */ ?><?php $attr = array() ?><?php } ?><?php unset($attr) ?><?php /* source: ./themes/default/include/html/window-end.inc.php - compile time: Wed, 18 Jan 2006 22:37:09 +0100 */ ?><?php $attr = array() ?>      </table>
	</td>
  </tr>
</table>

</center><?php unset($attr) ?><?php /* source: ./themes/default/include/html/page-end.inc.php - compile time: Wed, 18 Jan 2006 22:37:09 +0100 */ ?><?php $attr = array() ?>
<!-- $Id$ -->

<?php if ($showDuration) { ?>
<br/>
<small>&nbsp;
<?php $dur = time()-START_TIME;
      echo floor($dur/60).':'.str_pad($dur%60,2,'0',STR_PAD_LEFT); ?></small>
<?php } ?>

</body>
</html><?php unset($attr) ?>