<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<?php echo Html::form('user','add') ?>

<table class="main" width="80%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('GLOBAL_USERS') ?></th>
</tr>

<?php $f1=true;
      foreach( $el as $u )
      {
      	extract($u) ?>
<tr>
  <td class="<?php if($f1==true) {echo'f1';          } else{echo'f2';         }?>"><a href="<?php echo $url ?>" target="cms_main" title="<?php echo $desc ?>"><img src="<?php echo $image_dir ?>icon_user<?php echo IMG_EXT ?>" border="0" align="left"><?php echo $name ?></a></td>
  <td class="<?php if($f1==true) {echo'f1';          } else{echo'f2';         }?>"><?php echo $fullname ?> <?php if($isAdmin) echo '('.lang('USER_ADMIN').')' ?></td>
</tr>
<?php } ?>

<tr>
<td class="act" colspan="2"><input type="text" name="name" value="">&nbsp;<input type="submit" class="submit" value="<?php echo lang('GLOBAL_ADD') ?>"></td>
</tr>

</table>

</form>

</center>

<script name="JavaScript" type="text/javascript">
<!--
window.document.forms[0].name.focus();
//-->
</script>

<?php include( $tpl_dir.'footer.tpl.php') ?>