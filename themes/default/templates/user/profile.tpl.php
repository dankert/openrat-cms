<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<?php echo Html::form('profile','saveprofile',$userid) ?>

<?php windowOpen( 'GLOBAL_USER' ) ?>

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
<td width="50%" class="f1"><?php echo lang('USER_style') ?></a></td>
<td width="50%" class="f1"><?php echo Html::selectBox('style',$allstyles,$style) ?></td>
</tr>
  <tr>
    <td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>"></td>
  </tr>
<?php } ?>

<?php windowClose() ?>

</form>


<?php if ( empty($ldap_dn) ) { ?>
<?php echo Html::form('profile','pwchange',$userid) ?>

<?php windowOpen( 'USER_PASSWORD') ?>

<tr>
<td width="50%" class="f2"><?php echo lang('user_password') ?></a></td>
<td width="50%" class="f2"><input type="password" name="act_password"></td>
</tr>
<tr>
<td width="50%" class="f1"><?php echo lang('user_new_password') ?></a></td>
<td width="50%" class="f1"><input type="password" name="password1"></td>
</tr>
<tr>
<td width="50%" class="f2"><?php echo lang('user_new_password_repeat') ?></a></td>
<td width="50%" class="f2"><input type="password" name="password2"></td>
</tr>
<tr>
  <td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>"></td>
</tr>

<?php windowClose() ?>

</form>

<?php } ?>
</center>

<?php Html::focusField('fullname') ?>

<?php include( $tpl_dir.'footer.tpl.php') ?>