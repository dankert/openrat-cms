<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('SEARCH_RESULT').' ('.count($result).')' ?></th>
</tr>

<?php $f1=true;
      foreach( $result as $e )
      { ?>
<tr>
<td width="50%" class="<?php echo fx() ?>"><a href="<?php echo $e['url'] ?>" target="cms_main"><img src="<?php echo $image_dir.'icon_'.$e['type'] ?>" border="0" /><?php echo $e['name'] ?></a></td>
<td width="50%" class="<?php echo fx() ?>"><?php echo $e['desc'] ?></td>
</tr>
<?php } ?>

<?php if (count($result)==0)
      { ?>
<tr>
<td class="<?php echo fx() ?>"><?php echo lang('GLOBAL_NOT_FOUND') ?></td>
</tr>
<?php } ?>

</table>

</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>