<?php include( $tpl_dir.'header.tpl.php') ?>


<center>

<?php foreach($projects as $projectid=>$projectname) { ?>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="15"><?php echo lang('GLOBAL_PROJECT') ?>: <?php echo $projectname ?></th>
  </tr>
  <tr>
    <td class="help"><?php echo lang('GLOBAL_FILENAME')     ?></td>
    <td class="help"><?php echo lang('GLOBAL_LANGUAGE')     ?></td>
    <?php foreach( $show as $t ) { ?>
    <td class="help"><span title="<?php echo lang('ACL_'.strtoupper($t)) ?>"><strong><?php echo lang('ACL_'.strtoupper($t).'_ABBREV') ?></strong></span></td>
    <?php } ?>
  </tr>





<?php $fx = '';
      foreach( $rights[$projectid] as $oid=>$z )
      { $fx = fx($fx); ?>
  <tr>
<?php $objectUrl = Html::url( 'index','object',$oid ) ?>
    <td class="<?php echo $fx ?>"><a href="<?php echo $objectUrl ?>" target="_top"><img src="<?php echo $image_dir.'icon_'.$objects[$oid]['type'].IMG_EXT ?>" border="0" align="left"><?php echo $objects[$oid]['filename'] ?></a></td>
    <td class="<?php echo $fx ?>"><?php echo $z['languagename'] ?></td>

<?php foreach( $show as $t ) { ?>
    <td class="<?php echo $fx ?>"><?php echo Html::checkBox('',$z[$t],false,array('title'=>lang('ACL_'.strtoupper($t))) ) ?></td>
<?php } ?>

  </tr>
<?php }
      $fx = fx($fx); ?>

</table>

<?php } ?>




</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>