<?php /* source: ./themes/default/include/html/insert.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('file'=>'header') ?><?php $attr_file='header' ?><?php include( $tpl_dir.$attr_file.'.tpl.php') ?>
<?php unset($attr) ?><?php unset($attr_file) ?>
<?php /* source: ./themes/default/include/html/form.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('action'=>'action','subaction'=>'addacl','id'=>'objectid','name'=>'','target'=>'_self','method'=>'post','enctype'=>'application/x-www-form-urlencoded') ?><?php $attr_action='action' ?><?php $attr_subaction='addacl' ?><?php $attr_id='objectid' ?><?php $attr_name='' ?><?php $attr_target='_self' ?><?php $attr_method='post' ?><?php $attr_enctype='application/x-www-form-urlencoded' ?><form name="<?php echo $attr_name ?>"
      target="<?php echo $attr_target ?>"
      action="<?php echo Html::url( $attr_action,$attr_subaction,$attr_id ) ?>"
      method="<?php echo $attr_method ?>"
      enctype="<?php echo $attr_enctype ?>">
<input type="hidden" name="<?php echo REQ_PARAM_ACTION ?>" value="<?php echo $attr_action ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_SUBACTION ?>" value="<?php echo $attr_subaction ?>" />
<input type="hidden" name="<?php echo REQ_PARAM_ID ?>" value="<?php echo $attr_id ?>" /><?php
		if	( $conf['interface']['url_sessionid'] )
			echo '<input type="hidden" name="'.session_name().'" value="'.session_id().'" />'."\n";
?>
<?php unset($attr) ?><?php unset($attr_action) ?><?php unset($attr_subaction) ?><?php unset($attr_id) ?><?php unset($attr_name) ?><?php unset($attr_target) ?><?php unset($attr_method) ?><?php unset($attr_enctype) ?>
<?php /* source: ./themes/default/include/html/window.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('title'=>'GLOBAL_ADD','name'=>'','widths'=>'','width'=>'') ?><?php $attr_title='GLOBAL_ADD' ?><?php $attr_name='' ?><?php $attr_widths='' ?><?php $attr_width='' ?><?php
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
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_name) ?><?php unset($attr_widths) ?><?php unset($attr_width) ?>
<?php /* source: ./themes/default/include/html/row.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';

	global $cell_column_nr;
	$cell_column_nr=0;

?><tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'GLOBAL_ALL','raw'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='GLOBAL_ALL' ?><?php $attr_raw='' ?><?php
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
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/radio.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('readonly'=>'','name'=>'type','value'=>'all','default'=>'true') ?><?php $attr_readonly='' ?><?php $attr_name='type' ?><?php $attr_value='all' ?><?php $attr_default='true' ?><?php
?><input type="radio" name="<?php echo $attr_prefix.$attr_name ?><?php if ( $attr_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $attr_value ?>" <?php if( $attr_default ) echo 'checked="checked"' ?> />
<?php unset($attr) ?><?php unset($attr_readonly) ?><?php unset($attr_name) ?><?php unset($attr_value) ?><?php unset($attr_default) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>'_') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw='_' ?><?php
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
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';

	global $cell_column_nr;
	$cell_column_nr=0;

?><tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'GLOBAL_USER','raw'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='GLOBAL_USER' ?><?php $attr_raw='' ?><?php
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
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/radio.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('readonly'=>'','name'=>'type','value'=>'user','default'=>'') ?><?php $attr_readonly='' ?><?php $attr_name='type' ?><?php $attr_value='user' ?><?php $attr_default='' ?><?php
?><input type="radio" name="<?php echo $attr_prefix.$attr_name ?><?php if ( $attr_readonly ) echo ' disabled="disabled"' ?> value="<?php echo $attr_value ?>" <?php if( $attr_default ) echo 'checked="checked"' ?> />
<?php unset($attr) ?><?php unset($attr_readonly) ?><?php unset($attr_name) ?><?php unset($attr_value) ?><?php unset($attr_default) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/selectbox.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('list'=>'users','name'=>'userid','default'=>'') ?><?php $attr_list='users' ?><?php $attr_name='userid' ?><?php $attr_default='' ?><select size="1" name="<?php echo $attr_name ?>" <?php
if (count($$attr_list)==1) echo ' disabled="disabled"'
?>><?php
		foreach( $$attr_list as $box_key=>$box_value )
		{
			echo '<option value="'.$box_key.'"';
			if ($box_key == $$attr_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr_list)==1) echo '<input type="hidden" name="'.$attr_name.'" value="'.$box_key.'" />'
?>
<?php unset($attr) ?><?php unset($attr_list) ?><?php unset($attr_name) ?><?php unset($attr_default) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/if.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('var'=>'','value'=>'','invert'=>'true','empty'=>'groups','present'=>'','contains'=>'','true'=>'','false'=>'') ?><?php $attr_var='' ?><?php $attr_value='' ?><?php $attr_invert='true' ?><?php $attr_empty='groups' ?><?php $attr_present='' ?><?php $attr_contains='' ?><?php $attr_true='' ?><?php $attr_false='' ?><?php

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
<?php unset($attr) ?><?php unset($attr_var) ?><?php unset($attr_value) ?><?php unset($attr_invert) ?><?php unset($attr_empty) ?><?php unset($attr_present) ?><?php unset($attr_contains) ?><?php unset($attr_true) ?><?php unset($attr_false) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';

	global $cell_column_nr;
	$cell_column_nr=0;

?><tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'GLOBAL_GROUP','raw'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='GLOBAL_GROUP' ?><?php $attr_raw='' ?><?php
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
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/input.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('default'=>'','type'=>'radio','index'=>'','name'=>'type','prefix'=>'','value'=>'group','size'=>'','maxlength'=>'','onchange'=>'') ?><?php $attr_default='' ?><?php $attr_type='radio' ?><?php $attr_index='' ?><?php $attr_name='type' ?><?php $attr_prefix='' ?><?php $attr_value='group' ?><?php $attr_size='' ?><?php $attr_maxlength='' ?><?php $attr_onchange='' ?><input <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?> value="<?php echo $$attr_name ?>" />
<?php unset($attr) ?><?php unset($attr_default) ?><?php unset($attr_type) ?><?php unset($attr_index) ?><?php unset($attr_name) ?><?php unset($attr_prefix) ?><?php unset($attr_value) ?><?php unset($attr_size) ?><?php unset($attr_maxlength) ?><?php unset($attr_onchange) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/selectbox.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('list'=>'groups','name'=>'groupid','default'=>'') ?><?php $attr_list='groups' ?><?php $attr_name='groupid' ?><?php $attr_default='' ?><select size="1" name="<?php echo $attr_name ?>" <?php
if (count($$attr_list)==1) echo ' disabled="disabled"'
?>><?php
		foreach( $$attr_list as $box_key=>$box_value )
		{
			echo '<option value="'.$box_key.'"';
			if ($box_key == $$attr_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr_list)==1) echo '<input type="hidden" name="'.$attr_name.'" value="'.$box_key.'" />'
?>
<?php unset($attr) ?><?php unset($attr_list) ?><?php unset($attr_name) ?><?php unset($attr_default) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/if-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?><?php
	}
?>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';

	global $cell_column_nr;
	$cell_column_nr=0;

?><tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'help','colspan'=>'3') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='help' ?><?php $attr_colspan='3' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>'_') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw='_' ?><?php
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
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';

	global $cell_column_nr;
	$cell_column_nr=0;

?><tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'GLOBAL_LANGUAGE','raw'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='GLOBAL_LANGUAGE' ?><?php $attr_raw='' ?><?php
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
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>'_') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw='_' ?><?php
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
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'fx','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='fx' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/selectbox.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('list'=>'languages','name'=>'languageid','default'=>'') ?><?php $attr_list='languages' ?><?php $attr_name='languageid' ?><?php $attr_default='' ?><select size="1" name="<?php echo $attr_name ?>" <?php
if (count($$attr_list)==1) echo ' disabled="disabled"'
?>><?php
		foreach( $$attr_list as $box_key=>$box_value )
		{
			echo '<option value="'.$box_key.'"';
			if ($box_key == $$attr_default)
				echo ' selected="selected"';
			echo '>'.$box_value.'</option>';
		}
?></select><?php
if (count($$attr_list)==1) echo '<input type="hidden" name="'.$attr_name.'" value="'.$box_key.'" />'
?>
<?php unset($attr) ?><?php unset($attr_list) ?><?php unset($attr_name) ?><?php unset($attr_default) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';

	global $cell_column_nr;
	$cell_column_nr=0;

?><tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'help','colspan'=>'3') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='help' ?><?php $attr_colspan='3' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>'_') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw='_' ?><?php
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
<?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/list.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('list'=>'show','extract'=>'false','key'=>'list_key','value'=>'t') ?><?php $attr_list='show' ?><?php $attr_extract='false' ?><?php $attr_key='list_key' ?><?php $attr_value='t' ?><?php
	$list_tmp_key   = $attr_key;
	$list_tmp_value = $attr_value;
	$list_extract   = ($attr_extract=='true');


	foreach( $$attr_list as $$list_tmp_key => $$list_tmp_value )
	{
		if	( $list_extract )
			extract($$list_tmp_value);
?>
<?php unset($attr) ?><?php unset($attr_list) ?><?php unset($attr_extract) ?><?php unset($attr_key) ?><?php unset($attr_value) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';

	global $cell_column_nr;
	$cell_column_nr=0;

?><tr>
<?php unset($attr) ?><td class="<?php echo $fx ?>"><?php echo lang('ACL_'.strtoupper($t)) ?></td>
<td class="<?php echo $fx ?>" width="20"><?php echo lang('ACL_'.strtoupper($t).'_ABBREV') ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox($t,($t=='read'),($t!='read'),array('title'=>lang('ACL_'.strtoupper($t) )) ) ?></td>
<?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/list-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?><?php } ?>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/dummy.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?><?php unset($attr) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';

	global $cell_column_nr;
	$cell_column_nr=0;

?><tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'','colspan'=>'') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='' ?><?php $attr_colspan='' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/link.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('title'=>'','target'=>'','url'=>'javascript:mark();') ?><?php $attr_title='' ?><?php $attr_target='' ?><?php $attr_url='javascript:mark();' ?><a href="<?php echo $$attr_url ?>" target="<?php echo $attr_target ?>" title="<?php echo lang($$attr_title) ?>">
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'FOLDER_MARK_ALL','raw'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='FOLDER_MARK_ALL' ?><?php $attr_raw='' ?><?php
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
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/link-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></a>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>'_|_') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw='_|_' ?><?php
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
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/link.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('title'=>'','target'=>'','url'=>'javascript:unmark();') ?><?php $attr_title='' ?><?php $attr_target='' ?><?php $attr_url='javascript:unmark();' ?><a href="<?php echo $$attr_url ?>" target="<?php echo $attr_target ?>" title="<?php echo lang($$attr_title) ?>">
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'FOLDER_UNMARK_ALL','raw'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='FOLDER_UNMARK_ALL' ?><?php $attr_raw='' ?><?php
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
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/link-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:23 +0100 */ ?><?php $attr = array() ?></a>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:13:24 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'','raw'=>'_|_') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='' ?><?php $attr_raw='_|_' ?><?php
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
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/link.inc.php - compile time: Wed, 11 Jan 2006 22:13:24 +0100 */ ?><?php $attr = array('title'=>'','target'=>'','url'=>'javascript:flip();') ?><?php $attr_title='' ?><?php $attr_target='' ?><?php $attr_url='javascript:flip();' ?><a href="<?php echo $$attr_url ?>" target="<?php echo $attr_target ?>" title="<?php echo lang($$attr_title) ?>">
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_target) ?><?php unset($attr_url) ?><?php /* source: ./themes/default/include/html/text.inc.php - compile time: Wed, 11 Jan 2006 22:13:24 +0100 */ ?><?php $attr = array('title'=>'','class'=>'','var'=>'','text'=>'FOLDER_FLIP_MARK','raw'=>'') ?><?php $attr_title='' ?><?php $attr_class='' ?><?php $attr_var='' ?><?php $attr_text='FOLDER_FLIP_MARK' ?><?php $attr_raw='' ?><?php
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
<?php unset($attr) ?><?php unset($attr_title) ?><?php unset($attr_class) ?><?php unset($attr_var) ?><?php unset($attr_text) ?><?php unset($attr_raw) ?><?php /* source: ./themes/default/include/html/link-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:24 +0100 */ ?><?php $attr = array() ?></a>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:24 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:24 +0100 */ ?><?php $attr = array() ?></tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/row.inc.php - compile time: Wed, 11 Jan 2006 22:13:24 +0100 */ ?><?php $attr = array() ?><?php
	global $fx;
	if	( $fx =='f1')
		$fx='f2';
	else $fx='f1';

	global $cell_column_nr;
	$cell_column_nr=0;

?><tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/cell.inc.php - compile time: Wed, 11 Jan 2006 22:13:24 +0100 */ ?><?php $attr = array('width'=>'','style'=>'','class'=>'','colspan'=>'3') ?><?php $attr_width='' ?><?php $attr_style='' ?><?php $attr_class='' ?><?php $attr_colspan='3' ?><?php
	global $fx;
	if (!isset($attr_class)) $attr_class='';
	if ($attr_class=='fx') $attr['class']=$fx;

	global $cell_column_nr;
	$cell_column_nr++;
	if	( isset($column_widths[$cell_column_nr-1]) && !isset($attr_rowspan) )
		$attr['width']=$column_widths[$cell_column_nr-1];

?><td <?php foreach( $attr as $a_name=>$a_value ) echo " $a_name=\"$a_value\"" ?>>
<?php unset($attr) ?><?php unset($attr_width) ?><?php unset($attr_style) ?><?php unset($attr_class) ?><?php unset($attr_colspan) ?><?php /* source: ./themes/default/include/html/button.inc.php - compile time: Wed, 11 Jan 2006 22:13:24 +0100 */ ?><?php $attr = array('type'=>'ok') ?><?php $attr_type='ok' ?><?php
	if ($attr_type=='ok')
	{
		$attr_type  = 'submit';
		$attr_class = 'ok';
		$attr_text  = 'BUTTON_OK';
		$attr_value = 'ok';
	}
?><input type="<?php echo $attr_type ?>" name="<?php echo $attr_value ?>" class="<?php echo $attr_class ?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?php echo lang($attr_text) ?>&nbsp;&nbsp;&nbsp;&nbsp;" />
<?php unset($attr) ?><?php unset($attr_type) ?>
<?php /* source: ./themes/default/include/html/cell-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:24 +0100 */ ?><?php $attr = array() ?></td>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/row-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:24 +0100 */ ?><?php $attr = array() ?></tr>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/window-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:24 +0100 */ ?><?php $attr = array() ?>      </table>
	</td>
  </tr>
</table>

</center>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/form-end.inc.php - compile time: Wed, 11 Jan 2006 22:13:24 +0100 */ ?><?php $attr = array() ?></form>
<?php unset($attr) ?><?php /* source: ./themes/default/include/html/dummy.inc.php - compile time: Wed, 11 Jan 2006 22:13:24 +0100 */ ?><?php $attr = array() ?><?php unset($attr) ?>
<script name="JavaScript">
<!--
function mark()
{
<?php foreach( $show as $t ) { if($t=='read') continue; ?>
document.forms[0].elements['<?php echo $t ?>'].checked=true;
function unmark()
<?php } ?>
}
{
<?php foreach( $show as $t ) { if($t=='read') continue; ?>
document.forms[0].elements['<?php echo $t ?>'].checked=false;
<?php } ?>
}
function flip()
{
<?php foreach( $show as $t ) { if($t=='read') continue; ?>
if	(document.forms[0].elements['<?php echo $t ?>'].checked==false)
document.forms[0].elements['<?php echo $t ?>'].checked=true;
else document.forms[0].elements['<?php echo $t ?>'].checked=false;
<?php } ?>
}
</script>

<?php /* source: ./themes/default/include/html/insert.inc.php - compile time: Wed, 11 Jan 2006 22:13:24 +0100 */ ?><?php $attr = array('file'=>'footer') ?><?php $attr_file='footer' ?><?php include( $tpl_dir.$attr_file.'.tpl.php') ?>
<?php unset($attr) ?><?php unset($attr_file) ?>