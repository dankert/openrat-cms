<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->


<center>

<form name="login" action="<?php echo $self ?>" method="post" target="_top">
<input type="hidden" name="action"    value="index">
<input type="hidden" name="subaction" value="login">

<table class="main" width="400" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('LOGIN') ?></th>
</tr>

<tr>
<td colspan="2"><img src="<?php echo $image_dir ?>/logo.jpg"></td>
</tr>

<?php if ($loginmessage!='')
      { ?>
<tr>
<td colspan="2" class="f1"><strong><?php echo $loginmessage ?></strong></td>
</tr>
<?php } ?>

<tr>
<td class="f1" width="50%"><?php echo lang('USER_USERNAME') ?></td>
<td class="f1" width="50%"><input name="login_name" type="text" value="<?php #echo $login ?>" width="20"></td>
<tr>
<td class="f2" width="50%"><?php echo lang('PASSWORD') ?></td>
<td class="f2" width="50%"><input name="login_password" type="password" value="<?php echo #$password ?>" width="20"></td>
<tr>

<?php if (count($dbids)>1)
      { ?>
<tr>
<td class="f1" width="50%"><?php echo lang('DATABASE') ?></td>
<td class="f1" width="50%"><?php echo Html::selectBox('dbid',$dbids,$actdbid) ?></td>
</tr>
<?php } ?>

<tr>
<td class="act" colspan="2">
<?php if (count($dbids)==1)
      { ?>
<input type="hidden" name="dbid" value="<?php echo key($dbids) ?>">
<?php } ?>

<input type="submit" class="submit" value="<?php echo lang('LOGIN') ?>">
</td>
</tr>
</table>

</form>

<?php include( $tpl_dir.'copyright.tpl.php') ?>

</center>

<script name="JavaScript">
<!--
window.document.login.login_name.focus();
//-->
</script>

<?php include( $tpl_dir.'footer.tpl.php') ?>