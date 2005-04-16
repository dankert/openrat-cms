<?php include($tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<table cellpadding="5" cellspacing="0" width="100%" height="100%" border="0">
  <tr>
    <td class="menu">
      <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
          </td>
            <?php
      		if   ( isset($folder) && is_array($folder) )
      		{
      			foreach( $folder as $id=>$ftext )
      			{
          			echo '<td width="2%" nowrap>';
      				echo '<a href="'.Html::url('main','folder',$id).'" target="cms_main" class="mainmenu">';
      				echo '<img src="'.$image_dir.'icon_folder'.IMG_EXT.'" align="left" alt="" border="0" />';
      				echo Text::maxLength($ftext,20,'..',STR_PAD_BOTH);
      				echo '</a><strong>'.FILE_SEP.'</strong>&nbsp;';
          			echo '</td>';
      			}
		      }
          ?>
          <td><span class="mainmenu_name">&nbsp;<?php if (isset($text)) { ?><img src="<?php echo $image_dir.'icon_'.$type.IMG_EXT ?>" align="left" title="<?php echo $type ?>" alt="" /><?php echo Text::maxLength($text,30) ?><?php } ?></span>
          </td>

		  <?php if (isset($otherObjects) && count($otherObjects)>1 ) { ?>
          <td align="right"><!--<img src="<?php echo $image_dir.'icon_'.$type.IMG_EXT ?>" align="left" title="<?php echo $type ?>" alt="" />--><form><?php echo Html::selectBox('objectid',$otherObjects,$nr,array('onclick'=>'submit();')) ?></form>
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
			echo '<a href="'.Html::url($action,$act,$actionid).'"'.$attrAccesskey.' target="cms_main_main" title="'.$title.'">'.$text.'</a>';
		}
    ?></td>
  </tr>
</table>

<?php include($tpl_dir.'footer.tpl.php') ?>