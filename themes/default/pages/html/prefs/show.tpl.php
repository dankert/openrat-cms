<?php /* source: ./themes/default/templates/include/html/insert.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array('file'=>'header') ?><?php $attr_file='header' ?><?php include( $tpl_dir.$attr_file.'.tpl.php') ?>
<?php unset($attr) ?><?php unset($attr_file) ?>
<?php /* source: ./themes/default/templates/include/html/form.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array('action'=>'prefs','subaction'=>'save') ?><?php $attr_action='prefs' ?><?php $attr_subaction='save' ?><?php
		global $conf;

		if	( !isset($attr_target  ) )  $attr_target  = '_self';
		if	( !isset($attr_method  ) )  $attr_method  = 'post';
		if	( !isset($attr_name    ) )  $attr_name    = '';
		if	( !isset($attr_enctype ) )  $attr_enctype = '';
		if	( !isset($attr_id      ) )  $attr_id      = 0;

		$url = Html::url( $attr_action,$attr_subaction,$attr_id );
?>

<form name="<?php echo $name ?>" target="<?php echo $target ?>" action="<?php echo $attr_url ?>" method="<?php echo $method ?>" enctype="<?php echo $enctype ?>">
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr_id ?>" />
<?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";

		unset($attr['target' ]);
		unset($attr['method' ]);
		unset($attr['name'   ]);
		unset($attr['enctype']);
		foreach( $attr as $paramName=>$paramValue )
			echo '<input type="hidden" name="'.$paramName.'" value="'.$paramValue.'" />'."\n";
?>
<?php unset($attr) ?><?php unset($attr_action) ?><?php unset($attr_subaction) ?>
<?php /* source: ./themes/default/templates/include/html/form-end.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array() ?></form>
<?php unset($attr) ?><?php /* source: ./themes/default/templates/include/html/window.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array('name'=>'GLOBAL_PROP','title'=>'global_prefs','width'=>'90%','widths'=>'40%,60%') ?><?php $attr_name='GLOBAL_PROP' ?><?php $attr_title='global_prefs' ?><?php $attr_width='90%' ?><?php $attr_widths='40%,60%' ?><?php
	$coloumn_widths=array();
	if	(isset($attr_widths))
	{
		$column_widths = explode(',',$attr_widths);
		unset($attr['widths']);
	}
		global $image_dir;
		if	( !isset($attr_width)) $width='90%';
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
  <tr>
    <td>
      <table class="n" cellspacing="0" width="100%" cellpadding="4">
<?php unset($attr) ?><?php unset($attr_name) ?><?php unset($attr_title) ?><?php unset($attr_width) ?><?php unset($attr_widths) ?>
<?php /* source: ./themes/default/templates/include/html/row.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';

	global $cell_column_nr;
	$cell_column_nr=0;

?><tr>
<?php unset($attr) ?><?php /* source: ./themes/default/templates/include/html/cell.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array('class'=>'fx') ?><?php $attr_class='fx' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr['class']='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_class) ?><?php /* source: ./themes/default/templates/include/html/text.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array('text'=>'GLOBAL_name') ?><?php $attr_text='GLOBAL_name' ?><?php if(!isset($attr_class)) $attr_class='' ?><?php if(!isset($attr_title)) $attr_title=$attr_text ?><span class="<?php echo $attr_class ?>"><?php
	if (isset($attr_url)) echo "<a href=\"".$$attr_url."\" title=\"$attr_title\">";
	if (isset($attr_text)) echo lang($attr_text);
	elseif (isset($attr_var)) echo $$attr_var;
	elseif (isset($attr_raw)) echo str_replace('_',' ',$attr_raw);
	if (isset($attr_url)) echo '</a';
?></span>
<?php unset($attr) ?><?php unset($attr_text) ?><?php /* source: ./themes/default/templates/include/html/cell-end.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/templates/include/html/cell.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array('class'=>'fx') ?><?php $attr_class='fx' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr['class']='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_class) ?><?php /* source: ./themes/default/templates/include/html/text.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array('var'=>'name') ?><?php $attr_var='name' ?><?php if(!isset($attr_class)) $attr_class='' ?><?php if(!isset($attr_title)) $attr_title=$attr_text ?><span class="<?php echo $attr_class ?>"><?php
	if (isset($attr_url)) echo "<a href=\"".$$attr_url."\" title=\"$attr_title\">";
	if (isset($attr_text)) echo lang($attr_text);
	elseif (isset($attr_var)) echo $$attr_var;
	elseif (isset($attr_raw)) echo str_replace('_',' ',$attr_raw);
	if (isset($attr_url)) echo '</a';
?></span>
<?php unset($attr) ?><?php unset($attr_var) ?><?php /* source: ./themes/default/templates/include/html/cell-end.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/templates/include/html/row-end.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array() ?></tr>
<?php unset($attr) ?><?php /* source: ./themes/default/templates/include/html/row.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';

	global $cell_column_nr;
	$cell_column_nr=0;

?><tr>
<?php unset($attr) ?><?php /* source: ./themes/default/templates/include/html/cell.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array('colspan'=>'2','class'=>'fx') ?><?php $attr_colspan='2' ?><?php $attr_class='fx' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr['class']='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_colspan) ?><?php unset($attr_class) ?><?php /* source: ./themes/default/templates/include/html/text.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array('url'=>'editprop_url','text'=>'GLOBAL_CHANGE') ?><?php $attr_url='editprop_url' ?><?php $attr_text='GLOBAL_CHANGE' ?><?php if(!isset($attr_class)) $attr_class='' ?><?php if(!isset($attr_title)) $attr_title=$attr_text ?><span class="<?php echo $attr_class ?>"><?php
	if (isset($attr_url)) echo "<a href=\"".$$attr_url."\" title=\"$attr_title\">";
	if (isset($attr_text)) echo lang($attr_text);
	elseif (isset($attr_var)) echo $$attr_var;
	elseif (isset($attr_raw)) echo str_replace('_',' ',$attr_raw);
	if (isset($attr_url)) echo '</a';
?></span>
<?php unset($attr) ?><?php unset($attr_url) ?><?php unset($attr_text) ?>
<?php /* source: ./themes/default/templates/include/html/cell-end.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/templates/include/html/row-end.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array() ?></tr>
<?php unset($attr) ?><?php /* source: ./themes/default/templates/include/html/window-end.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array() ?>      </table>
	</td>
  </tr>
</table>

</center>
<?php unset($attr) ?><?php /* source: ./themes/default/templates/include/html/focus.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array('field'=>'name') ?><?php $attr_field='name' ?><script name="JavaScript" type="text/javascript"><!--
document.forms[0].<?php echo $$attr_field ?>.focus();
//--></script>
<?php unset($attr) ?><?php unset($attr_field) ?>
<?php /* source: ./themes/default/templates/include/html/insert.inc.php - compile time: Tue, 20 Dec 2005 00:37:16 +0100 */ ?><?php $attr = array('file'=>'footer') ?><?php $attr_file='footer' ?><?php include( $tpl_dir.$attr_file.'.tpl.php') ?>
<?php unset($attr) ?><?php unset($attr_file) ?>