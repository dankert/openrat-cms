<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<form action="<?php echo $action ?>" method="post" target="_self">
<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="useraction" value="pwchange">

<table class="main" width="90%" cellspacing="0" cellpadding="4">
<tr>
  <th colspan="2"><?php echo lang('PASSWORD') ?></th>
</tr>
<tr>
<td width="50%" class="f1"><?php echo lang('password') ?></a></td>
<td width="50%" class="f1"><input type="password" name="password1"></td>
</tr>
<tr>
<td width="50%" class="f2"><?php echo lang('passwordrepeat') ?></a></td>
<td width="50%" class="f2"><input type="password" name="password2"></td>
</tr>
<tr>
<td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('SAVE') ?>"></td>
</tr>
</table>

</form>

</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>