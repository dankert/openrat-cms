<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<?php $table_title_text    = lang('FOLDER');
      $table_title_colspan = 7;
      include( $tpl_dir.'table_open.tpl.php');
?>
<tr>
<td colspan="7" class="help"><?php echo lang('HELP_FOLDER') ?></td>
</tr>


<?php if  ( isset($up_url) )
      { ?>
<tr>
<td width="50%" colspan="7" class="<?php if($f1==true) {echo'f1';          } else{echo'f2';         }?>"><a href="<?php echo $up_url ?>" target="cms_main"><img src="<?php echo $image_dir.'icon_folder.png' ?>" align="left" border="0"><strong>..</strong></a></td>
<!--<td width="50%" colspan="3" class="<?php if($f1==true) {echo'f1';$f1=false;} else{echo'f2';$f1=true;}?>">&nbsp;</td>-->
</tr>
<?php }

      if   ( count( $object) > 0 )
      {
      ?>
<tr>
<td width="40%" class="help"            ><?php echo lang('name'      )                  ?></td>
<td width="20%" class="help"            ><?php echo lang('lastchange')                  ?></td>
<td width="10%" class="help" colspan="4"><?php if (count( $object)>1) echo lang('move') ?></td>
<td width="10%" class="help"            >&nbsp;</a></td>
</tr>

<?php   $f1=true;
        foreach( $object as $id=>$z )
        {
          $fx = fx($f1);
      	?>
<tr>
<td width="40%" class="<?php echo $fx; ?>"><a href="<?php echo $z['url'] ?>" target="cms_main" title="<?php echo $z['desc'] ?>"><img src="<?php echo $image_dir.'icon_'.$z['icon'].'.png' ?>" align="left" border="0"><?php echo $z['name'] ?></a>&nbsp;</td>
<td width="18%" class="<?php echo $fx; ?>"><span title="<?php echo lang('USER').': '.$z['user'] ?>"><?php echo $z['date'] ?></span></td>
<td width="3%"  class="<?php echo $fx; ?>"><?php if (isset($z['upurl'    ])) { ?><a href="<?php echo $z['upurl'    ]  ?>"><img src="<?php echo $image_dir ?>up.gif"     title="<?php echo lang('UP'    ) ?>" border="0"></a><?php } else echo '&nbsp;' ?></td>
<td width="3%"  class="<?php echo $fx; ?>"><?php if (isset($z['downurl'  ])) { ?><a href="<?php echo $z['downurl'  ]  ?>"><img src="<?php echo $image_dir ?>down.gif"   title="<?php echo lang('DOWN'  ) ?>" border="0"></a><?php } else echo '&nbsp;' ?></td>
<td width="3%"  class="<?php echo $fx; ?>"><?php if (isset($z['topurl'   ])) { ?><a href="<?php echo $z['topurl'   ]  ?>"><img src="<?php echo $image_dir ?>top.gif"    title="<?php echo lang('TOP'   ) ?>" border="0"></a><?php } else echo '&nbsp;' ?></td>
<td width="3%"  class="<?php echo $fx; ?>"><?php if (isset($z['bottomurl'])) { ?><a href="<?php echo $z['bottomurl']  ?>"><img src="<?php echo $image_dir ?>bottom.gif" title="<?php echo lang('BOTTOM') ?>" border="0"></a><?php } else echo '&nbsp;' ?></td>
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