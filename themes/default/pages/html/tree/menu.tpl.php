<?php include($tpl_dir.'header.tpl.'.$conf_php) ?>

<!-- $Id$ -->

<table cellpadding="5" cellspacing="0" width="100%" height="100%">
<tr>
    <td class="menu">

      <form style="margin:0px;" action="<?php echo $self ?>" method="get" target="cms_tree">
      <table>
      <tr>
      <td>
        <input type="hidden" name="action" value="tree">
        <input type="hidden" name="subaction" value="reload">
        <?php echo Html::selectBox( 'projectid',$projects,$act_projectid,array('onchange'=>'submit();') ) ?></td><td><noscript>&nbsp;<input type="submit" class="submit" value="&raquo;"></noscript>
      </td>
      </tr>
      </table>
      </form>
    </td>
  </tr>
  <tr>
    <td class="submenu" height="20"><a accesskey="r" href="<?php echo $reload_url ?>" target="cms_tree"><?php echo lang('REFRESH') ?></a> | <a href="<?php echo $openall_url ?>" target="cms_tree">++</a></td>
  </tr>
</table>


<?php include($tpl_dir.'footer.tpl.'.$conf_php) ?>