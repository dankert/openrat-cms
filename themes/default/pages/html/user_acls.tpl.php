<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<br><br><br>
<center>

<form action="<?php echo $action ?>" method="post" target="_self">
<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="useraction" value="save">

<table width="80%">

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
<td class="f2" colspan="2"><input type="submit" value="<?php echo lang('SAVE') ?>"></td>
</tr>

</table>

</form>


<form action="<?php echo $action ?>" method="post" target="_self">
<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="useraction" value="pwchange">

<table width="80%">
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
<td class="f2" colspan="2"><input type="submit" value="<?php echo lang('SAVE') ?>"></td>
</tr>
</table>

</form>


<table width="80%">
<tr>
  <th colspan="2"><?php echo lang('MEMBERSHIPS') ?></th>
</tr>
<?php $f1=true;
      foreach( $memberships as $id=>$name )
      { ?>
<tr>
<td width="50%" class="<?php if($f1==true) {echo'f1';          }else{echo'f2';         }?>"><?php echo $name ?></td>
<td width="50%" class="<?php if($f1==true) {echo'f1';$f1=false;}else{echo'f2';$f1=true;}?>"><a href="<?php echo sid($action.'?useraction=delgroup&usergroupid='.$id) ?>"><?php echo lang('DELETE') ?></a></td>
</tr>
<?php } ?>
</table>
<br>

<form action="<?php echo $action ?>" method="post" target="_self">
<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="useraction" value="addgroup">

<table width="80%">
<tr>
  <th colspan="2"><?php echo lang('ADD') ?></th>
</tr>
<tr>
  <td width="50%" class="f1"><?php html_form_select('groupid','',$groups,'') ?></a></td>
  <td width="50%" class="f1"><input type="submit" value="<?php echo lang('ADD') ?>"></td>
</tr>
</table>

</form>



<table width="80%">
<tr>
  <th colspan="2"><?php echo lang('RIGHTS') ?></th>
</tr>
<?php $f1=true;
      foreach( $acls as $id=>$name )
      { ?>
<tr>
<td width="50%" class="<?php if($f1==true) {echo'f1';          }else{echo'f2';         }?>"><?php echo $name ?></td>
<td width="50%" class="<?php if($f1==true) {echo'f1';$f1=false;}else{echo'f2';$f1=true;}?>"><a href="<?php echo sid($action.'?useraction=delacl&aclid='.$id) ?>"><?php echo lang('DELETE') ?></a></td>
</tr>
<?php } ?>
</table>
<br>

<form action="<?php echo $action ?>" method="post" target="_self">
<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="useraction" value="addacl">

<table width="80%">
<tr>
  <th colspan="2"><?php echo lang('ADD') ?></th>
</tr>
<tr>
  <td width="50%" class="f1"><?php html_form_select('pageid','',$pages,'') ?></a></td>
  <td width="50%" class="f1"><input type="submit" value="<?php echo lang('ADD') ?>"></td>
</tr>
</table>

</form>

</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>