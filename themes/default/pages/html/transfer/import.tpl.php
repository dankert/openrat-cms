<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<?php if (isset($fileLog))
      { ?>
<table class="main" width="90%" cellspacing="0" cellpadding="4">
  <tr>
    <th><?php echo lang('LOG') ?></th>
  </tr>
  <tr>
    <td class="f1"><pre><?php echo $fileLog ?></pre></td>
  </tr>
</table>
<?php } ?>


<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="transferaction" value="import">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('IMPORT') ?></th>
</tr>

<tr>
<td colspan="2" class="help"><?php echo lang('HELP_IMPORT') ?></td>
</tr>

<tr>
<td width="50%" class="f1"><?php echo lang('SOURCE') ?></a></td>
<td width="50%" class="f1"><input type="text" name="local_folder" class="filename" size="50" value=""></td>
</tr>

<tr>
<td width="50%" class="f1"><?php echo lang('TARGET') ?></a></td>
<td width="50%" class="f1"><?php echo Html::selectBox('objectid',$folders,0) ?></td>
</tr>

<tr>
<td class="act" colspan="2"><input type="submit"  class="submit" value="<?php echo lang('IMPORT') ?>"></td>
</tr>

</table>

</form>

</center>

<?php include( $tpl_dir.'footer.tpl.php') ?>