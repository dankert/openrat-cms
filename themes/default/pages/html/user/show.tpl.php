<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<br><br><br>
<center>

<form action="<?php echo $action ?>" method="post" target="_self">
<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="useraction" value="save">

<table width="80%">

<tr>
  <th colspan="2"><?php echo lang('USER') ?> <a href="<?php echo sid($action.'?useraction=edit') ?>"><?php echo lang('EDIT') ?></a></th>
</tr>

<tr>
<td width="50%" class="f1"><?php echo lang('username') ?></a></td>
<td width="50%" class="f1"><?php echo $name ?></td>
</tr>
<tr>
<td width="50%" class="f1"><?php echo lang('name') ?></a></td>
<td width="50%" class="f1"><?php echo $fullname ?></td>
</tr>
<tr>
<td width="50%" class="f1"><?php echo lang('mail') ?></a></td>
<td width="50%" class="f1"><?php echo $mail ?></td>
</tr>
<tr>
<td width="50%" class="f1"><?php echo lang('ldap') ?></a></td>
<td width="50%" class="f1"><?php echo $ldap ?></td>
</tr>
<tr>
<td width="50%" class="f1"><?php echo lang('language') ?></a></td>
<td width="50%" class="f1"><?php echo $lang ?></td>
</tr>
<tr>
<td width="50%" class="f1"><?php echo lang('style') ?></a></td>
<td width="50%" class="f1"><?php echo $style ?></td>
</tr>
<tr>
<td width="50%" class="f1"><?php echo lang('admin') ?></a></td>
<td width="50%" class="f1"><?php if ($is_admin==1) echo lang('YES'); else echo lang('NO') ?></td>
</tr>

</table>

</form>


<table width="80%">
<tr>
  <th colspan="2"><?php echo lang('MEMBERSHIPS') ?><a href="<?php echo sid($action.'?useraction=groups') ?>"><?php echo lang('EDIT') ?></a></th>
</tr>
<?php $f1=true;
      foreach( $memberships as $id=>$name )
      { ?>
<tr>
<td width="50%" class="<?php if($f1==true) {echo'f1';          }else{echo'f2';         }?>"><?php echo $name ?></td>
<td width="50%" class="<?php if($f1==true) {echo'f1';$f1=false;}else{echo'f2';$f1=true;}?>"></td>
</tr>
<?php } ?>
</table>
<br>


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

</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>