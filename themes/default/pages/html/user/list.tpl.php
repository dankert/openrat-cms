<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<form action="<?php echo $action ?>" method="post" target="_self">
<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="useraction" value="add">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('USERS') ?></th>
</tr>

<?php $f1=true;
      foreach( $el as $id=>$e )
      { ?>
<tr>
<td width="50%" class="<?php if($f1==true) {echo'f1';          } else{echo'f2';         }?>"><a href="<?php echo sid($e['url']) ?>"><?php echo $e['name'] ?></a></td>
<td width="50%" class="<?php if($f1==true) {echo'f1';$f1=false;} else{echo'f2';$f1=true;}?>"><?php echo $e['type'] ?></td>
</tr>
<?php } ?>

<tr>
<td class="act"><input type="text" name="name" value="">&nbsp;<input type="submit" class="submit" value="<?php echo lang('ADD') ?>"></td>
</tr>

</table>

</form>

</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>