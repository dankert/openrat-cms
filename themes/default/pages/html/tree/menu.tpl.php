<?php include($tpl_dir.'header.tpl.'.$conf_php) ?>

<!-- $Id$ -->

<table cellpadding="5" cellspacing="0" width="100%" height="100%">
  <tr>
    <td class="menu">

      <?php echo Html::form( array('action'=>'index','subaction'=>'project','target'=>'_parent','method'=>'get','name'=>'') ) ?>
      <table>
      <tr>
      <td>
        <?php
          if	( count($projects) < 2 )
          	$attrDisabled = array('disabled'=>'disabled');
          else
          	$attrDisabled = array();
        ?>
        <?php echo Html::selectBox( 'id',$projects,$act_projectid,array('onchange'=>'submit();','title'=>lang('PROJECT_SELECT_DESC'),'style'=>'margin:0px;padding:0px;')+$attrDisabled ) ?></td><td><noscript>&nbsp;<input type="submit" class="submit" value="&raquo;"></noscript>
      </td>
      </tr>
      </table>
      </form>
    </td>
  </tr>
  <tr>
    <td class="submenu" height="20">
      <?php if (isset($language_name)) { ?>
      <?php echo lang('GLOBAL_LANGUAGE') ?>:&nbsp;<a href="<?php echo $language_url     ?>" target="cms_main"><?php echo $language_name     ?></a> | 
      <?php echo lang('GLOBAL_MODEL')    ?>:&nbsp;<a href="<?php echo $projectmodel_url ?>" target="cms_main"><?php echo $projectmodel_name ?></a>
  	  <?php } else  { ?>&nbsp;
	  <?php } ?>
    </td>
  </tr>
</table>


<?php include($tpl_dir.'footer.tpl.'.$conf_php) ?>