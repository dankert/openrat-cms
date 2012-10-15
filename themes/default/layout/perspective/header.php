<?php

function view_header( $name )
{
	global $viewconfig;
	global $conf;
	$v = $viewconfig[$name];
	
?>


<div id="<?php echo $name ?>" data-action="<?php echo $v['action'] ?>" class="frame<?php echo ($v['refreshable']?' refreshable':'') ?><?php echo (@$v['modal']?' modal':'') ?>">
<div class="window">

<div class="menu">

<div class="views">
<!-- 
<div class="backward_link"><img src="<?php echo OR_THEMES_EXT_DIR ?>default/images/icon/backward_nav.gif"/></div>
<div class="forward_link"><img src="<?php echo OR_THEMES_EXT_DIR ?>default/images/icon/forward_nav.gif"/></div>
 -->
<ul class="views">
<?php

	$viewlist = explode(',',$v['views']);
	if ( empty($viewlist[0])) $viewlist = array();

	// Tabreiter pro View erzeugen
    foreach( $viewlist as $vn )
          {
          	$tmp_text = langHtml('menu_'.$vn);
			$liClass  = 'action'.($vn==$v['default']?' active':'');
			$icon_url = OR_THEMES_EXT_DIR.'default/images/icon/'.$vn.'.png';
			
			?><li title="<?php echo $tmp_text ?>" data-method="<?php echo $vn ?>" class="<?php echo $liClass?>" title="<?php echo langHtml('menu_'.$vn.'_desc'); ?>"><?php
          		?><img class="icon" src="<?php echo $icon_url ?>" /><div class="tabname"><?php echo $tmp_text ?></div><?php
          	?></li><?php
          }
          if ( /* Deaktiviert */ false && @$conf['help']['enabled'] )
          	{
             ?><a class="help" href="javascript:help(this,'<?php echo $conf['help']['url'] ?>','<?php echo @$conf['help']['suffix'] ?> " title="<?php echo langHtml('MENU_HELP_DESC') ?>"><img src="<?php echo $image_dir.'icon/help.png' ?>" /><?php echo @$conf['help']['only_question_mark']?'?':langHtml('MENU_HELP') ?></a><?php
          	}
          	?><?php
	
	
	
		?>
</ul>
<div class="icons">
<div class="icon">

<?php if (!empty($viewlist)) { /* Fenster-Menü anzeigen (sofern Views vorhanden) */ ?>
<img class="icon" src="<?php echo OR_THEMES_EXT_DIR.'default/images/icon/menu.gif' ?>" />
<div class="dropdown dropdownalignright">
<div class="entry"><a href="javascript:void(0);" class="fullscreen" onClick="javascript:fullscreen( this );"><img src="<?php echo OR_THEMES_EXT_DIR.'default/images/icon/window/maximize.gif' ?>" title="<?php echo langHtml('window_fullscreen') ?>" /><?php echo langHtml('window_fullscreen') ?></a></div>
<?php 
          if ( @$conf['help']['enabled'] )
          	{
             ?><div class="entry"><a onclick="help(this,'<?php echo $conf['help']['url'] ?>','<?php echo @$conf['help']['suffix'] ?>');" title="<?php echo langHtml('MENU_HELP_DESC') ?>"><img src="<?php echo OR_THEMES_EXT_DIR.'default/images/icon/help.png' ?>" /><?php echo langHtml('MENU_HELP') ?></a></div><?php
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
	<div class="empty" />
</div>

<!-- 
<div class="bottom">
	<div class="status">
	</div>
	<div class="command">
	
	<input type="button" class="submit" value="<?php echo lang('BUTTON_OK') ?>" onclick="$(this).closest('div.window').find('form').submit();" />
	<!- 
	<input type="button" value="<?php echo lang('CANCEL') ?>" />
	->
	</div>
</div>
 -->

</div>
</div>

<?php } ?>