<?php include($tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<table cellpadding="5" cellspacing="0" width="100%" height="100%" border="0">
  <tr>
    <td class="menu">
      <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td rowspan="2" width="20">
            <img src="<?php echo $image_dir.'action_'.$type.'.png' ?>">
          </td>
          <td><span class="mainmenu_headline"><?php echo lang($type) ?></span></td>
          <?php $cols = 1;
                if   (isset($language_name) || isset($nr))
                {
                     $cols=3;
                     ?>
          <td class="mainmenu_headline" width="20"><?php echo lang('id') ?>:&nbsp;</td>
          <td class="mainmenu_val" width="50"><strong><?php echo $nr ?></strong></td>
          <td class="mainmenu_headline" width="50"><?php echo lang('LANGUAGE') ?>:&nbsp;</td>
          <td class="mainmenu_val" width="50"><?php echo $language_name ?></td>
          <?php }   ?>
        </tr>
        <tr>
          <td class="menu" colspan="3"><?php
      		if   ( isset($folder) && is_array($folder) )
      		{
      			foreach( $folder as $id=>$ftext )
      			{
      				echo '<a href="'.Html::url(array('action'=>'main','callAction'=>'folder','objectid'=>$id,'callSubaction'=>'show')).'" target="cms_main" class="mainmenu">'.$ftext.'</a>&nbsp;<strong>&raquo;</strong>&nbsp;';
      			}
		      }
          ?><span class="mainmenu_name"><?php if (isset($text)) echo $text ?></span></td>          

          <?php if (isset($projectmodel_name))
                {   $cols=3;
                	?>
          <td width="50" class="mainmenu_headline"><?php echo lang('MODEL') ?>:&nbsp;</td>
          <td width="50" class="mainmenu_val"><?php echo $projectmodel_name ?></td>
          <?php }   ?>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="submenu" height="20"><?php
		$i = 0;
		foreach( $subaction as $act=>$text )
		{
			switch( $act )
			{
				case 'prop'   : $accesskey = 'p'; break;
				case 'show'   : $accesskey = 'v'; break;
				case 'pub'    : $accesskey = 'w'; break;
				case 'edit'   : $accesskey = 'e'; break;
				case 'el'     : $accesskey = 'l'; break;
				case 'rights' : $accesskey = 'a'; break;
				case 'new'    : $accesskey = 'n'; break;
				case 'src'    : $accesskey = 's'; break;
				default:        $accesskey = '' ;
			}

			if	( $accesskey != '')
				$title = 'ALT+'.strtoupper( $accesskey );
			else $title = '';

			if   ( ++$i > 1 ) echo ' | ';
			echo '<a href="'.Html::url(array('action'=>$action,'subaction'=>$act,$param=>$this->getSessionVar($param))).'" accesskey="'.$accesskey.'" target="cms_main_main" title="'.$title.'">'.$text.'</a>';
		}
    ?></td>
  </tr>
</table>

<?php include($tpl_dir.'footer.tpl.php') ?>