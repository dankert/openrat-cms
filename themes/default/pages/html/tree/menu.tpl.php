<?php include($tpl_dir.'header.tpl.'.$conf_php) ?>

<!-- $Id$ -->

<table cellpadding="5" cellspacing="0" width="100%" height="100%">
  <tr>
    <td class="menu">

    <?php if (isset($act_projectid))
	      { ?>
      <?php if (count($projects)>1)
            { ?>
      <?php echo Html::form( array('action'=>'index','subaction'=>'show','target'=>'_parent','method'=>'get','name'=>'') ) ?>
      <table>
      <tr>
      <td>
        <input type="hidden" name="action"    value="index">
        <input type="hidden" name="subaction" value="show">
        <?php echo Html::selectBox( 'projectid',$projects,$act_projectid,array('onchange'=>'submit();') ) ?></td><td><noscript>&nbsp;<input type="submit" class="submit" value="&raquo;"></noscript>
      </td>
      </tr>
      </table>
      </form>
      <?php } else
            { ?>
      <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td><span class="mainmenu_headline"><?php echo lang('GLOBAL_PROJECT') ?></span></td>
        </tr>
        <tr>
          <td class="menu" colspan="3"><span class="mainmenu_name"><?php echo $projects[$act_projectid] ?></span></td>          
        </tr>
      </table>
	<?php } ?>
	<?php } else
	      { ?>
	      &nbsp;
	<?php } ?>
    </td>
  </tr>
  <tr>
    <td class="submenu" height="20">
      <?php echo lang('LANGUAGE') ?>:&nbsp;<a href="<?php echo $language_url     ?>" target="cms_main"><?php echo $language_name     ?></a> | 
      <?php echo lang('MODEL')    ?>:&nbsp;<a href="<?php echo $projectmodel_url ?>" target="cms_main"><?php echo $projectmodel_name ?></a>
    </td>
  </tr>
</table>


<?php include($tpl_dir.'footer.tpl.'.$conf_php) ?>