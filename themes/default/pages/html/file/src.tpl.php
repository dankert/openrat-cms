<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="action"    value="file">
<input type="hidden" name="subaction" value="savevalue">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('SRC') ?></th>
</tr>

<tr>
<td class="f2"><?php echo lang('value') ?></a></td>
<td class="f2"><textarea cols="60" rows="35" name="value"><?php echo htmlentities($value) ?></textarea></td>
</tr>
<tr>
<td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('SAVE') ?>"></td>
</tr>

</table>

</form>

</center>

<?php include( $tpl_dir.'footer.tpl.php') ?>