<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<form action="<?php echo $self ?>" method="post" target="_self">
<input type="hidden" name="subaction" value="saveprofile">

<?php $table_title = lang('user'); include( $tpl_dir.'table_open.tpl.php') ?>

<tr>
<td width="50%" class="f1"><?php echo lang('user_username') ?></a></td>
<td width="50%" class="f1"><strong><?php echo $name ?></strong></td>
</tr>

<?php foreach( array('fullname','tel','mail','desc') as $z)
      {
      	if	( isset($$z) )
      	{ ?>
<tr>
<td width="50%" class="f1"><?php echo lang('USER_'.$z) ?></a></td>
<td width="50%" class="f1"><input type="text" name="<?php echo $z ?>" size="40" maxlength="128" value="<?php echo $$z ?>"></td>
</tr>
<?php 	}
      } ?>

<?php if	( count($allstyles) > 1 )
    	 { ?>
<tr>
<td width="50%" class="f1"><?php echo lang('style') ?></a></td>
<td width="50%" class="f1"><?php echo Html::selectBox('style',$allstyles,$style) ?></td>
</tr>
  <tr>
    <td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('SAVE') ?>"></td>
  </tr>
<?php } ?>

<?php if (!isset($use_ldap))
      { ?>

<?php include( $tpl_dir.'table_close.tpl.php'); ?>

</form>

<form action="<?php echo $self ?>" method="post" target="_self">
<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="useraction" value="pwchange">


<?php $table_title = lang('password');
      include( $tpl_dir.'table_open.tpl.php'); ?>

<tr>
<td width="50%" class="f2"><?php echo lang('act_password') ?></a></td>
<td width="50%" class="f2"><input type="password" name="act_password"></td>
</tr>
<tr>
<td width="50%" class="f1"><?php echo lang('new_password') ?></a></td>
<td width="50%" class="f1"><input type="password" name="password1"></td>
</tr>
<tr>
<td width="50%" class="f2"><?php echo lang('new_password_repeat') ?></a></td>
<td width="50%" class="f2"><input type="password" name="password2"></td>
</tr>
<?php } ?>
  <tr>
    <td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('SAVE') ?>"></td>
  </tr>

<?php include( $tpl_dir.'table_close.tpl.php') ?>

</form>

</center>

<script name="JavaScript" type="text/javascript"><!--
document.forms[0].fullname.focus();
//--></script>

<?php include( $tpl_dir.'footer.tpl.php') ?>