<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<form action="<?php echo $action ?>" method="post" target="_self">
<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="groupaction" value="adduser">

<table class="main" width="90%" cellspacing="0" cellpadding="4">
<tr>
  <th colspan="2"><?php echo lang('MEMBERSHIPS') ?></th>
</tr>
<?php $f1=true;
      foreach( $memberships as $id=>$name )
      { ?>
<tr>
<td width="50%" class="<?php if($f1==true) {echo'f1';          }else{echo'f2';         }?>"><?php echo $name ?></td>
<td width="50%" class="<?php if($f1==true) {echo'f1';$f1=false;}else{echo'f2';$f1=true;}?>"><a href="<?php echo sid($action.'?groupaction=deluser&usergroupid='.$id) ?>"><?php echo lang('DELETE') ?></a></td>
</tr>
<?php }
      if   ( count($memberships)==0 )
      { ?>
<tr>
<td colspan="2" class="f1"><?php echo lang('NOT_FOUND') ?></td>
</tr>
<?php } ?>

<?php if   ( count($users)>0 )
      { ?>
<tr>
  <td colspan="2" class="act"><?php html_form_select('userid','',$users,'') ?></a>&nbsp;<input type="submit" class="submit" value="<?php echo lang('ADD') ?>"></td>
</tr>
<?php } ?>

</table>

</form>


</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>