<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<center>

<?php echo Html::form('user','add') ?>

<table class="main" width="50%" cellspacing="0" cellpadding="4">

<tr>
  <th><?php echo lang('GLOBAL_USERS') ?></th>
</tr>

<?php $f1=true;
      foreach( $el as $id=>$e )
      { ?>
<tr>
<td class="<?php if($f1==true) {echo'f1';          } else{echo'f2';         }?>"><a href="<?php echo $e['url'] ?>" target="cms_main"><img src="<?php echo $image_dir ?>icon_user<?php echo IMG_EXT ?>" border="0" align="left"><?php echo $e['name'] ?></a></td>
</tr>
<?php } ?>

<tr>
<td class="act"><input type="text" name="name" value="">&nbsp;<input type="submit" class="submit" value="<?php echo lang('GLOBAL_ADD') ?>"></td>
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