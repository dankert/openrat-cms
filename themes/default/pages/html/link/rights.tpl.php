<?php include( $tpl_dir.'header.tpl.php') ?>

<center>

<form action="<?php echo $self ?>" method="post" target="_self">
<input type="hidden" name="action"    value="link">
<input type="hidden" name="subaction" value="addACL">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="14"><?php echo lang('ACL') ?></th>
</tr>


  <tr>
    <td class="help"><?php echo lang('NAME') ?></td>
    <td class="help"><?php echo lang('LANGUAGE') ?></td>
    <td class="help"><span title="<?php echo lang('ACL_READ'         ) ?>"><strong>R</strong></span></td>
    <td class="help"><span title="<?php echo lang('ACL_WRITE'        ) ?>"><strong>W</strong></span></td>
    <td class="help"><span title="<?php echo lang('ACL_PROP'         ) ?>"><strong>P</strong></span></td>
    <td class="help"><span title="<?php echo lang('ACL_DELETE'       ) ?>"><strong>E</strong></span></td>
    <td class="help"><span title="<?php echo lang('ACL_GRANT'        ) ?>"><strong>G</strong></span></td>
  </tr>





<?php $fx = '';
      foreach( $acls as $aclid=>$z )
      { $fx = fx($fx); ?>
<tr>
<?php 	if ( $z['username'] != '' )
      	{ ?>
<td width="50%" class="<?php echo $fx ?>"><img src="<?php echo $image_dir.'icon_user.png' ?>" align="left"><?php echo $z['username'] ?></a></td>
<?php 	}
      	else
      	{ ?>
<td width="50%" class="<?php echo $fx ?>"><img src="<?php echo $image_dir.'icon_group.png' ?>" align="left"><?php echo $z['groupname'] ?></a></td>
<?php 	} ?>
<td class="<?php echo $fx ?>"><?php echo $z['languagename'] ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('',true               ,false,array('title'=>lang('read')) ) ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('',$z['write'        ],false) ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('',$z['prop'         ],false) ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('',$z['delete'       ],false) ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('',$z['grant'        ],false) ?></td>
<?php if (isset($z['delete_url']))
      { ?>
<td class="<?php echo $fx ?>"><a href="<?php echo $z['delete_url'] ?>"><?php echo lang('DELETE') ?></a></td>
<?php }
      else
      { ?>
<td class="<?php echo $fx ?>"><?php echo lang('inherited') ?></td>
<?php } ?>
</tr>
<?php }
      $fx = fx($fx); ?>


<tr>
<td class="act" style="white-space:nowrap;">
  <input type="radio" name="type" value="user" checked>&nbsp;<?php echo Html::selectBox( 'userid',$users); ?><br><br>
  <?php if (count($groups)>0)
        { ?>
  <input type="radio" name="type" value="group">&nbsp;<?php echo Html::selectBox( 'groupid',$groups); ?></td>
  <?php } ?>
<td class="act" style="white-space:nowrap;"><?php echo Html::selectBox( 'languageid',$languages); ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox(''             ,true ,false) ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('write'        ,false,true,array('title'=>lang('ACL_WRITE'        )) ) ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('prop'         ,false,true,array('title'=>lang('ACL_PROP'         )) ) ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('delete'       ,false,true,array('title'=>lang('ACL_DELETE'       )) ) ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('grant'        ,false,true,array('title'=>lang('ACL_GRANT'        )) ) ?></td>
<td class="act"><input type="submit" class="submit" value="<?php echo lang('ADD') ?>"></td>
</tr>

</table>

</form>





</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>