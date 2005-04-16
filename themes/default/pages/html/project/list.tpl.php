<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<form action="<?php echo $self ?>" method="post" target="_self">
<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="action"    value="project" />
<input type="hidden" name="subaction" value="add"     />

<?php windowOpen('GLOBAL_PROJECTS',2,'project') ?>

<?php $f1=true;
      foreach( $el as $id=>$e )
      { ?>
<tr>
  <td class="<?php if($f1==true) {echo'f1';          } else{echo'f2';         }?>"><a href="<?php echo $e['url']     ?>" target="cms_main"><img src="<?php echo $image_dir ?>icon_project<?php echo IMG_EXT ?>" border="0" align="left"><?php echo $e['name'] ?></a></td>
  <td class="<?php if($f1==true) {echo'f1';          } else{echo'f2';         }?>"><a href="<?php echo $e['use_url'] ?>" target="_top"    ><?php echo lang('GLOBAL_SELECT') ?></a></td>
</tr>
<?php } ?>

<tr>
  <td class="act" colspan="2">
    <input type="text" name="name" value="">&nbsp;<input type="submit" class="submit" value="<?php echo lang('GLOBAL_ADD') ?>">
  </td>
</tr>

<?php windowClose() ?>

</form>

</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>