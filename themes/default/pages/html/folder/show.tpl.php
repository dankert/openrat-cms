<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="5"><?php echo lang('FOLDER') ?></th>
</tr>

<?php if  ( isset($up_url) )
      { ?>
<tr>
<td width="50%" colspan="5" class="<?php if($f1==true) {echo'f1';          } else{echo'f2';         }?>"><a href="<?php echo $up_url ?>" target="cms_main"><img src="<?php echo $image_dir.'icon_folder.png' ?>" align="left" border="0"><strong>..</strong></a></td>
<!--<td width="50%" colspan="3" class="<?php if($f1==true) {echo'f1';$f1=false;} else{echo'f2';$f1=true;}?>">&nbsp;</td>-->
</tr>
<?php }

      if   ( count( $object) > 0 )
      {
      ?>
<tr>
<td width="40%" class="help"            ><?php echo lang('name'      )                  ?></a></td>
<td width="20%" class="help"            ><?php echo lang('lastchange')                  ?></a></td>
<td width="10%" class="help" colspan="2"><?php if (count( $object)>1) echo lang('move') ?></a></td>
<td width="10%" class="help"            >&nbsp;</a></td>
</tr>

<?php   $f1=true;
        foreach( $object as $id=>$z )
        {
          $fx = fx($f1);
      	?>
<tr>
<td width="40%" class="<?php echo $fx; ?>"><a href="<?php echo $z['url'] ?>" target="cms_main" title="<?php echo $z['desc'] ?>"><img src="<?php echo $image_dir.'icon_'.$z['icon'].'.png' ?>" align="left" border="0"><?php echo $z['name'] ?></a>&nbsp;</td>
<td width="20%" class="<?php echo $fx; ?>"><span title="<?php echo lang('USER').': '.$z['user'] ?>"><?php echo $z['date'] ?></span></td>
<td width="5%"  class="<?php echo $fx; ?>"><?php if (isset($z['upurl'  ])) { ?><a href="<?php echo $z['upurl'  ]  ?>"><img src="<?php echo $image_dir ?>up.gif"   title="<?php echo lang('UP'  ) ?>" border="0"></a><?php } else echo '&nbsp;' ?></td>
<td width="5%"  class="<?php echo $fx; ?>"><?php if (isset($z['downurl'])) { ?><a href="<?php echo $z['downurl']  ?>"><img src="<?php echo $image_dir ?>down.gif" title="<?php echo lang('DOWN') ?>" border="0"></a><?php } else echo '&nbsp;' ?></td>
<td width="10%" class="<?php echo $fx; ?>"><a  target="cms_main" href="<?php echo $z['propurl']  ?>"><?php echo lang('PROP') ?></a></td>
</tr>
<?php   }
      }
      else
      { ?>
<tr>
<td colspan="2" class="<?php if($f1==true) {echo'f1';          } else{echo'f2';         }?>"><?php echo lang('NOT_FOUND') ?></td>
</tr>
<?php } ?>

</table>

</center>

<?php include( $tpl_dir.'footer.tpl.php') ?>