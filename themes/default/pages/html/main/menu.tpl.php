<?php include($tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<table cellpadding="5" cellspacing="0" width="100%" height="100%" border="0">
  <tr>
    <td class="menu">
      <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td width="2%"><span class="mainmenu_title"><?php echo lang('GLOBAL_'.$type) ?>&nbsp;&nbsp;</span>
          </td>
          <td width="2%" nowrap>
            <?php
      		if   ( isset($folder) && is_array($folder) )
      		{
      			foreach( $folder as $id=>$ftext )
      			{
      				echo '<a href="'.Html::url(array('action'=>'main','callAction'=>'folder','objectid'=>$id,'callSubaction'=>'show')).'" target="cms_main" class="mainmenu">';
      				echo '<img src="'.$image_dir.'icon_folder.png'.'" align="middle" alt="" border="0" />';
      				echo $ftext;
      				echo '</a><strong>'.FILE_SEP.'</strong>&nbsp;';
      			}
		      }
          ?>
          </td>
          <td><span class="mainmenu_name">&nbsp;<?php if (isset($text)) { ?><img src="<?php echo $image_dir.'icon_'.$type.'.png' ?>" align="middle" title="<?php echo $type ?>" alt="" />&nbsp;<?php echo $text ?><?php } ?></span>
          </td>

          <?php if(isset($nr)) { ?>
          <td class="mainmenu_headline" width="20"><?php echo lang('GLOBAL_ID') ?>:&nbsp;
          </td>

          <td class="mainmenu_val"      width="50"><strong><?php echo $nr ?></strong>
          </td>          
          <?php } ?>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="submenu" height="20"><?php
		$i = 0;
		foreach( $subaction as $act=>$text )
		{
			$title = lang('MENU_'.$act.'_DESC' );

			if	( hasLang('MENU_'.$act.'_KEY' ) )
			{
				$attrAccesskey = ' accesskey="'.lang('MENU_'.$act.'_KEY').'"';
				$title.=' ('.lang('GLOBAL_KEY').': ALT+'.lang('MENU_'.$act.'_KEY').')';
			}
			else
				$attrAccesskey = '';


			if   ( ++$i > 1 ) echo ' | ';
			echo '<a href="'.Html::url(array('action'=>$action,'subaction'=>$act,$param=>$this->getSessionVar($param))).'"'.$attrAccesskey.' target="cms_main_main" title="'.$title.'">'.$text.'</a>';
		}
    ?></td>
  </tr>
</table>

<?php include($tpl_dir.'footer.tpl.php') ?>