<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<br><br><br>
<center>


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


</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>