<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<?php echo Html::form('group','adduser',$groupid) ?>

<table class="main" width="60%" cellspacing="0" cellpadding="4">
<tr>
  <th colspan="2"><?php echo lang('GROUP_MEMBERSHIPS') ?></th>
</tr>
<?php $f1=true;
      foreach( $memberships as $id=>$name )
      { ?>
<tr>
<td width="50%" class="<?php if($f1==true) {echo'f1';          }else{echo'f2';         }?>"><?php echo $name ?></td>
<td width="10%" class="<?php if($f1==true) {echo'f1';$f1=false;}else{echo'f2';$f1=true;}?>"><a href="<?php echo Html::url('group','deluser',$groupid,array('userid'=>$id)) ?>"><?php echo lang('GLOBAL_DELETE') ?></a></td>
</tr>
<?php }
      if   ( count($memberships)==0 )
      { ?>
<tr>
<td colspan="2" class="f1"><?php echo lang('GLOBAL_NOT_FOUND') ?></td>
</tr>
<?php } ?>

<?php if   ( count($users)>0 )
      { ?>
<tr>
  <td colspan="2" class="act"><?php echo Html::selectBox('userid',$users) ?></a>&nbsp;<input type="submit" class="submit" value="<?php echo lang('GLOBAL_ADD') ?>"></td>
</tr>
<?php } ?>

</table>

</form>


</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>