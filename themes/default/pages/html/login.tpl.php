<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->


<center>

<?php echo Html::form( 'index','login','',array('target'=>'_top') ) ?>

<table class="main" width="400" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('GLOBAL_LOGIN') ?></th>
</tr>

<?php if ( $logo != '' ) { ?>
<tr>
  <td colspan="2"><?php if ( $logo_url != '' ) { ?><a href="<?php echo $logo_url ?>" target="_top"><?php } ?><img src="<?php echo $logo ?>" border="0" /><?php if ( $logo_url != '' ) { ?></a><?php } ?></td>
</tr>
<?php } ?>

<?php if ( $motd != '' ) { ?>
<tr>
  <td colspan="2" class="f1"><strong><?php echo $motd ?></strong></td>
</tr>
<?php } ?>

<?php if ( $nologin ) { ?>
<tr>
  <td colspan="2" class="help"><?php echo lang('LOGIN_NOLOGIN_DESC') ?></td>
</tr>
<?php }
      elseif ( $readonly ) { ?>
<tr>
  <td colspan="2" class="help"><?php echo lang('GLOBAL_READONLY_DESC') ?></td>
</tr>
<?php }
      elseif ( $nopublish ) { ?>
<tr>
  <td colspan="2" class="help"><?php echo lang('GLOBAL_NOPUBLISH_DESC') ?></td>
</tr>
<?php } ?>

<?php if ($loginmessage!='')
      { ?>
<tr>
<td colspan="2" class="f1"><strong><?php echo $loginmessage ?></strong></td>
</tr>
<?php } ?>

<?php if ( !$nologin ) { ?>

<tr>
  <td class="f1" width="50%"><?php echo lang('USER_USERNAME') ?></td>
  <td class="f1" width="50%"><input name="login_name"     type="text"     value="" width="25" /></td>
<tr>
  <td class="f2" width="50%"><?php echo lang('USER_PASSWORD') ?></td>
  <td class="f2" width="50%"><input name="login_password" type="password" value="" width="25" /></td>
<tr>

<?php if (count($dbids)>1)
      { ?>
<tr>
  <td class="f1" width="50%"><?php echo lang('GLOBAL_DATABASE') ?></td>
  <td class="f1" width="50%"><?php echo Html::selectBox('dbid',$dbids,$actdbid) ?></td>
</tr>
<?php } ?>

<tr>
  <td class="act" colspan="2">
<?php if (count($dbids)==1)
      { ?>
  <input type="hidden" name="dbid" value="<?php echo key($dbids) ?>" />
<?php } ?>
  <input type="submit" class="submit" value="<?php echo lang('GLOBAL_LOGIN') ?>" />
  </td>
</tr>
<?php } ?>

</table>

</form>

<!-- The GPL licence requires this text, so NEVER remove nor change it. -->

<br><br>
<p class="copyright"><a href="http://www.gnu.org/copyleft/gpl.html" target="_top"><?php echo lang('GLOBAL_GPL') ?></a></p>

</center>

<?php Html::focusField('login_name') ?>

<?php include( $tpl_dir.'footer.tpl.php') ?>