<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<form action="<?php echo $action ?>" method="post" target="_self">
<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="useraction" value="save">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('USER') ?></th>
</tr>

<tr>
<td width="50%" class="f1"><?php echo lang('username') ?></a></td>
<td width="50%" class="f1"><input type="text" name="name" value="<?php echo $name ?>"></td>
</tr>
<tr>
<td width="50%" class="f1"><?php echo lang('name') ?></a></td>
<td width="50%" class="f1"><input type="text" name="fullname" value="<?php echo $fullname ?>"></td>
</tr>
<tr>
<td width="50%" class="f1"><?php echo lang('mail') ?></a></td>
<td width="50%" class="f1"><input type="text" name="mail" value="<?php echo $mail ?>"></td>
</tr>
<tr>
<td width="50%" class="f1"><?php echo lang('ldap') ?></a></td>
<td width="50%" class="f1"><input type="text" name="ldap" value="<?php echo $ldap ?>"></td>
</tr>
<tr>
<td width="50%" class="f1"><?php echo lang('language') ?></a></td>
<td width="50%" class="f1"><?php html_form_select('lang','',$alllanguages,$lang) ?></td>
</tr>
<tr>
<td width="50%" class="f1"><?php echo lang('style') ?></a></td>
<td width="50%" class="f1"><?php html_form_select('style','',$allstyles,$style) ?></td>
</tr>
<tr>
<td width="50%" class="f1"><?php echo lang('admin') ?></a></td>
<td width="50%" class="f1"><input type="checkbox" name="is_admin" value="1"<?php if ($is_admin==1) echo ' checked="checked"' ?>></td>
</tr>
<tr>
<td class="act" colspan="2"><input type="submit" value="<?php echo lang('SAVE') ?>"></td>
</tr>

</table>

</form>

</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>