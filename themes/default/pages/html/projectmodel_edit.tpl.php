<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<form action="<?php echo $form_action ?>" method="post" target="_self">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('VARIANT') ?></a></th>
</tr>

<tr>
<td width="50%" class="f1"><?php echo lang('NAME') ?></a></td>
<td width="50%" class="f1"><?php echo $name ?></td>
</tr>
<tr>
<td width="50%" class="f2"><?php echo lang('DELETE') ?></a></td>
<td width="50%" class="f2"><input type="checkbox" value="1"></td>
</tr>
<tr>
<td colspan="2" class="act"><input type="submit" class="submit" value="<?php echo lang('SAVE') ?>"></a></td>
</tr>

</table>

</form>

</center>

<?php include( $tpl_dir.'footer.tpl.php') ?>