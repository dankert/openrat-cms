<?php

function view_header( $name )
{
	global $preselectobject;
		
	global $viewconfig;
	global $conf;
	$v = $viewconfig[$name];
	
?>


<div id="<?php echo $name ?>" class="frame<?php echo (@$v['modal']?' modal':'') ?>">
<div class="window">

<div class="menu">

<div class="views">
<ul class="views">
<?php

	$viewlist = explode(',',$v['views']);
	if ( empty($viewlist[0])) $viewlist = array();
	

	// Tabreiter pro View erzeugen
    foreach( $viewlist as $vn )
          {
          	$tmp_text = langHtml('menu_'.$vn);
			$liClass  = 'action'.($vn==$v['default']?' active':'').(@$v['refreshable']?' dependent':' static');
			$icon_url = OR_THEMES_EXT_DIR.'default/images/icon/'.$vn.'.png';
			
			?><li data-action="<?php echo @$v['action'] ?>" data-method="<?php echo $vn ?>" class="<?php echo $liClass?>" title="<?php echo langHtml('menu_'.$vn.'_desc'); ?>"><?php
          		?><img class="icon" src="<?php echo $icon_url ?>" /><div class="tabname"><?php echo $tmp_text ?></div><?php
          	?></li><?php
          }
          
          global $preselectobject;
          if	( false && $name=='content' && is_object($preselectobject) )
          {
          	$tmp_text = $preselectobject->name;
          	$liClass  = 'action active';
          	$icon_url = OR_THEMES_EXT_DIR.'default/images/icon_'.$preselectobject->getType().'.png';
          		
          	?><li data-id="<?php echo $preselectobject->objectid ?>" data-method="edit" data-u="<?php echo $preselectobject->getType() ?>" class="<?php echo $liClass?>" title="<?php echo $preselectobject->description ?>"><?php
          	          		?><img class="icon" src="<?php echo $icon_url ?>" /><div class="tabname"><?php echo $tmp_text ?></div><?php
          	          	?></li><?php
          }
          
          if ( /* Deaktiviert */ false && @$conf['help']['enabled'] )
          	{
             ?><a class="help" data-url="<?php echo $conf['help']['url'] ?>" data-suffix="<?php echo @$conf['help']['suffix'] ?>" title="<?php echo langHtml('MENU_HELP_DESC') ?>"><img src="<?php echo $image_dir.'icon/help.png' ?>" /><?php echo @$conf['help']['only_question_mark']?'?':langHtml('MENU_HELP') ?></a><?php
          	}
          	?><?php
	
	
	
		?>
</ul>

<script name="javascript" type="text/javascript">
<!--
<?php 
if	( $name=='content' && count(@$preselectedobjects)>0 )
{
	global $preselectedobjects;
	$object = $preselectedobjects[ count($preselectedobjects)-1];
?>
setTimeout( function() { openNewAction( '<?php echo $object->name; ?>','<?php echo $object->getType() ?>','<?php echo $object->objectid ?>',0 );} ,500);
<?php
}
?>
//-->
</script>
<div class="icons">
<div class="icon">

<?php if (!empty($viewlist) || $name=='content') { /* Fenster-Menü anzeigen (sofern Views vorhanden) */ ?>
<img class="icon" src="<?php echo OR_THEMES_EXT_DIR.'default/images/icon/menu.gif' ?>" />
<div class="dropdown dropdownalignright">
<div class="entry clickable"><a href="javascript:void(0);" class="fullscreen" data-type="fullscreen"><img src="<?php echo OR_THEMES_EXT_DIR.'default/images/icon/window/maximize.gif' ?>" title="<?php echo langHtml('window_fullscreen') ?>" /><?php echo langHtml('window_fullscreen') ?></a></div>
<?php 
          if ( @$conf['help']['enabled'] )
          	{
             ?><div class="entry clickable"><a href="javascript:void(0);" data-type="help" data-url="<?php echo $conf['help']['url'] ?>" data-suffix="<?php echo @$conf['help']['suffix'] ?>" title="<?php echo langHtml('MENU_HELP_DESC') ?>"><img src="<?php echo OR_THEMES_EXT_DIR.'default/images/icon/help.png' ?>" /><?php echo langHtml('MENU_HELP') ?></a></div><?php
          	}
          	?>
</div>
<?php } ?>
</div>
</div>
</div>
 
</div>

<?php /*echo langHtml( $v['title'] )*/ ?>
		

<!-- Hinweis-Meldungen -->

<div class="content">
	<div class="empty"></div>
</div>

</div>
</div>

<?php } ?>