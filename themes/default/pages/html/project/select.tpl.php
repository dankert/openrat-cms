<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<table class="main" width="50%" cellspacing="0" cellpadding="4">

<tr>
	<th><?php echo lang('GLOBAL_PROJECTS') ?></th>
</tr>

<?php $f1=true;
      foreach( $el as $id=>$e )
      { ?>
<tr>
<td class="<?php if($f1==true) {echo'f1';          } else{echo'f2';         }?>"><a href="<?php echo $e['url'] ?>" target="_top"><img src="<?php echo $image_dir ?>icon_project<?php echo IMG_EXT ?>" border="0" align="left"><?php echo $e['name'] ?></a></td>
</tr>
<?php } ?>


</table>

</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>