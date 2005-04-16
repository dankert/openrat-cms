<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->

<?php windowOpen('GLOBAL_PROJECTS',1,'',array('width'=>'55%')) ?>

<?php $f1=true;
      foreach( $el as $id=>$e )
      { ?>
<tr>
<td class="<?php if($f1==true) {echo'f1';          } else{echo'f2';         }?>"><a href="<?php echo $e['url'] ?>" target="_top"><img src="<?php echo $image_dir ?>icon_project<?php echo IMG_EXT ?>" border="0" align="left"><?php echo $e['name'] ?></a></td>
</tr>
<?php } ?>


<?php windowClose() ?>

<?php include( $tpl_dir.'footer.tpl.php') ?>