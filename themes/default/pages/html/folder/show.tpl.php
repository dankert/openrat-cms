<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<?php echo Html::form('folder','multiple') ?>

<?php $table_title_text    = lang('GLOBAL_FOLDER');
      $table_title_colspan = 7;
      include( $tpl_dir.'table_open.tpl.php');
      
      $writable = isset($folder);
?>
<tr>
<td colspan="7" class="help"><?php echo lang('GLOBAL_FOLDER_DESC') ?></td>
</tr>


<?php if  ( isset($up_url) )
      { ?>
<tr>
<td width="50%" colspan="8" class="<?php if($f1==true) {echo'f1';          } else{echo'f2';         }?>"><a href="<?php echo $up_url ?>" target="cms_main"><img src="<?php echo $image_dir.'icon_folder'.IMG_EXT ?>" align="left" border="0"><strong>..</strong></a></td>
</tr>
<?php }

      if   ( count( $object) > 0 )
      {
      	$sortable = (count($object)>1 && $writable);
      ?>
<tr>
<td width="5%"  class="help"            >&nbsp;</td>
<td width="60%" class="help"            ><?php if ($sortable) { ?><a href="<?php echo $orderbytype_url       ?>" title="<?php echo lang('FOLDER_ORDERBYTYPE'      ) ?>"><?php } ?><?php echo lang('GLOBAL_TYPE'      )  ?><?php if ($sortable) { ?></a><?php } ?> / <?php if ($sortable) { ?><a href="<?php echo $orderbyname_url ?>" title="<?php echo lang('FOLDER_ORDERBYNAME') ?>"><?php } ?><?php echo lang('GLOBAL_NAME') ?><?php if ($sortable) { ?></a><?php } ?></td>
<td width="20%" class="help"            ><?php if ($sortable) { ?><a href="<?php echo $orderbylastchange_url ?>" title="<?php echo lang('FOLDER_ORDERBYLASTCHANGE') ?>"><?php } ?><?php echo lang('GLOBAL_LASTCHANGE')  ?><?php if ($sortable) { ?></a><?php } ?></td>
<td width="30%" class="help" colspan="4"><?php if ($sortable) { ?><a href="<?php echo $flip_url              ?>" title="<?php echo lang('FOLDER_FLIP')              ?>"><?php } ?><?php echo lang('FOLDER_ORDER'     ) ?><?php if ($sortable) { ?></a><?php } ?></td>
</tr>

<?php   $f1=true;
        foreach( $object as $id=>$z )
        {
          $fx = fx($f1);
      	?>
<tr>
<td width="5%"  class="<?php echo $fx; ?>"><?php if($writable) { ?><input type="checkbox" name="obj<?php echo $id ?>" value="1" /><?php } ?></td>
<td width="40%" class="<?php echo $fx; ?>"><a href="<?php echo $z['url'] ?>" target="cms_main" title="<?php echo $z['desc'] ?>"><img src="<?php echo $image_dir.'icon_'.$z['icon'].IMG_EXT ?>" align="left" border="0"><?php echo $z['name'] ?></a>&nbsp;</td>
<td width="18%" class="<?php echo $fx; ?>"><span title="<?php echo lang('USER').': '.$z['user'] ?>"><?php echo $z['date'] ?></span></td>
<td width="3%"  class="<?php echo $fx; ?>"><?php if (isset($z['upurl'    ])) { ?><a href="<?php echo $z['upurl'    ]  ?>"><img src="<?php echo $image_dir ?>arrow_up<?php echo IMG_EXT ?>"     title="<?php echo lang('UP'    ) ?>" border="0"></a><?php } else echo '&nbsp;' ?></td>
<td width="3%"  class="<?php echo $fx; ?>"><?php if (isset($z['topurl'   ])) { ?><a href="<?php echo $z['topurl'   ]  ?>"><img src="<?php echo $image_dir ?>arrow_top<?php echo IMG_EXT ?>"    title="<?php echo lang('TOP'   ) ?>" border="0"></a><?php } else echo '&nbsp;' ?></td>
<td width="3%"  class="<?php echo $fx; ?>"><?php if (isset($z['bottomurl'])) { ?><a href="<?php echo $z['bottomurl']  ?>"><img src="<?php echo $image_dir ?>arrow_bottom<?php echo IMG_EXT ?>" title="<?php echo lang('BOTTOM') ?>" border="0"></a><?php } else echo '&nbsp;' ?></td>
<td width="3%"  class="<?php echo $fx; ?>"><?php if (isset($z['downurl'  ])) { ?><a href="<?php echo $z['downurl'  ]  ?>"><img src="<?php echo $image_dir ?>arrow_down<?php echo IMG_EXT ?>"   title="<?php echo lang('DOWN'  ) ?>" border="0"></a><?php } else echo '&nbsp;' ?></td>
</tr>
<?php   } ?>

<?php   if($writable) { ?>
<tr>
<td colspan="7" class="<?php echo $fx; ?>">
  <img src="<?php echo $image_dir ?>tree_none_end.gif" align="left" />&nbsp;
  <a href="javascript:mark();"><?php echo lang('FOLDER_MARK_ALL') ?></a> | <a href="javascript:unmark();"><?php echo lang('FOLDER_UNMARK_ALL') ?></a> | <a href="javascript:flip();"><?php echo lang('FOLDER_FLIP_MARK') ?></a>
</td>
</tr>
<tr>
<td></td>
<td colspan="1" class="<?php echo $fx; ?>">
  <table>
  <tr>
  <td>
  <input type="radio" name="type" value="move" />
  <?php echo lang('GLOBAL_MOVE') ?> <?php echo lang('GLOBAL_TO') ?>
  <br/>
  <input type="radio" name="type" value="copy" />
  <?php echo lang('GLOBAL_COPY') ?> <?php echo lang('GLOBAL_TO') ?>
  <br/>
  <input type="radio" name="type" value="link" />
  <?php echo lang('GLOBAL_LINK') ?> <?php echo lang('GLOBAL_TO') ?>
  <br/>
  <input type="radio" name="type" value="delete" />
  <?php echo lang('GLOBAL_DELETE') ?>
  </td><td>
  <?php echo Html::selectBox('targetobjectid',$folder,$act_objectid) ?>
  </td><td>
  </td></tr>
  </table> 
</td>
<td class="act" colspan="5">
  <input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>" />
</td>
</tr>
<?php   } ?>
<?php }
      else
      { ?>
<tr>
<td colspan="2" class="<?php if($f1==true) {echo'f1';          } else{echo'f2';         }?>"><?php echo lang('GLOBAL_NOT_FOUND') ?></td>
</tr>
<?php } ?>

</table>
</form>

</center>

<script name="JavaScript">
<!--
function mark()
{
<?php foreach( $object as $id=>$z ) { ?>
document.forms[0].obj<?php echo $id ?>.checked=true;
<?php } ?>
}
function unmark()
{
<?php foreach( $object as $id=>$z ) { ?>
document.forms[0].obj<?php echo $id ?>.checked=false;
<?php } ?>
}
function flip()
{
<?php foreach( $object as $id=>$z ) { ?>
if	(document.forms[0].obj<?php echo $id ?>.checked==false)
 document.forms[0].obj<?php echo $id ?>.checked=true;
else document.forms[0].obj<?php echo $id ?>.checked=false;
<?php } ?>
}
//-->
</script>
<?php include( $tpl_dir.'footer.tpl.php') ?>