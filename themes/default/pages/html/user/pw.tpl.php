<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<?php echo Html::form('user','pwchange',$userid) ?>

<?php windowOpen( 'USER_PASSWORD') ?>

<tr>
<td width="50%" class="f1"><?php echo lang('USER_new_password') ?></a></td>
<td width="50%" class="f1"><input type="password" name="password1"></td>
</tr>
<tr>
<td width="50%" class="f2"><?php echo lang('USER_new_password_repeat') ?></a></td>
<td width="50%" class="f2"><input type="password" name="password2"></td>
</tr>
<?php if (!empty($mail)) { ?>
<tr>
<td width="50%" class="f2"><?php echo lang('user_mail_new_password') ?></a></td>
<td width="50%" class="f2"><?php echo Html::checkBox('mail',false,true) ?></td>
</tr>
<tr>
<td width="50%" class="f2"><?php echo lang('user_random_password') ?></a></td>
<td width="50%" class="f2"><?php echo Html::checkBox('random',false,true) ?></td>
</tr>
<?php } ?>
<tr>
<td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>"></td>
</tr>
<?php windowClose() ?>
</form>

</center>

<script name="JavaScript" type="text/javascript"><!--
document.forms[0].password1.focus();
//--></script>

<?php include( $tpl_dir.'footer.tpl.php') ?>