<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

  <tr>
    <th colspan="3"><?php echo lang('TEMPLATE_ELEMENTS') ?></th>
  </tr>

<?php if ( count($el) > 0 )
      { ?>
  <tr>
    <td class="help"><?php echo lang('PAGE_ELEMENT_NAME') ?></td>
    <td class="help"><?php echo lang('PAGE_ELEMENT_VALUE') ?></td>
    <td class="help"><?php echo lang('GLOBAL_ARCHIVE') ?></td>
  </tr>

<?php $f1=true;
      foreach( $el as $id=>$e )
      {
      	$fx = fx($f1);
      	?>
  <tr>
    <td width="25%" class="<?php echo $fx ?>"><a href="<?php echo $e['url'] ?>" title="<?php echo $e['desc'] ?>"><img src="<?php echo $image_dir.'icon_el_'.$e['type'].IMG_EXT ?>" border="0" align="left"><?php echo $e['name'] ?></a></td>
    <td width="40%" class="<?php echo $fx ?>"><?php echo $e['value'] ?>&nbsp;</td>
    <td width="15%" class="<?php echo $fx ?>"><a href="<?php echo $e['archive_url'] ?>"><?php echo lang('GLOBAL_ARCHIVE') ?></a> (<?php echo $e['archive_count'] ?>)</td>
  </tr>
<?php } ?>
  <tr>
    <td class="help" colspan="3"><?php echo lang('PAGE_ELEMENTS_DESC') ?></td>
  </tr>
<?php }
      else
      { ?>
  <tr>
    <td colspan="3" class="f1"><strong><?php echo lang('GLOBAL_NOT_FOUND') ?></strong></td>
  </tr>
<?php } ?>

</table>

</center>

<?php include( $tpl_dir.'footer.tpl.php') ?>