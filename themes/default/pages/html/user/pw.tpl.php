<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="action"    value="user"    />
<input type="hidden" name="subaction" value="pwchange"/>

<table class="main" width="90%" cellspacing="0" cellpadding="4">
<tr>
  <th colspan="2"><?php echo lang('USER_PASSWORD') ?></th>
</tr>
<tr>
<td width="50%" class="f1"><?php echo lang('USER_new_password') ?></a></td>
<td width="50%" class="f1"><input type="password" name="password1"></td>
</tr>
<tr>
<td width="50%" class="f2"><?php echo lang('USER_new_password_repeat') ?></a></td>
<td width="50%" class="f2"><input type="password" name="password2"></td>
</tr>
<tr>
<td width="50%" class="f2"><?php echo lang('user_mail_new_password') ?></a></td>
<td width="50%" class="f2"><?php echo Html::checkBox('mail',false,true) ?></td>
</tr>
<tr>
<td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>"></td>
</tr>
</table>

</form>

</center>

<script name="JavaScript" type="text/javascript"><!--
document.forms[0].password1.focus();
//--></script>

<?php include( $tpl_dir.'footer.tpl.php') ?>