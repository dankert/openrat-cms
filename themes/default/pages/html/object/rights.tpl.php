<?php include( $tpl_dir.'header.tpl.php') ?>


<center>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="15"><?php echo lang('ACL') ?></th>
</tr>
  <tr>
    <td class="help"><?php echo lang('NAME') ?></td>
    <td class="help"><?php echo lang('LANGUAGE') ?></td>
    <td class="help"><span title="<?php echo lang('ACL_READ'         ) ?>"><strong>R</strong></span></td>
    <td class="help"><span title="<?php echo lang('ACL_WRITE'        ) ?>"><strong>W</strong></span></td>
    <td class="help"><span title="<?php echo lang('ACL_PROP'         ) ?>"><strong>P</strong></span></td>
    <td class="help"><span title="<?php echo lang('ACL_DELETE'       ) ?>"><strong>E</strong></span></td>
    <td class="help"><span title="<?php echo lang('ACL_RELEASE'      ) ?>"><strong>RE</strong></span></td>
    <td class="help"><span title="<?php echo lang('ACL_PUBLISH'      ) ?>"><strong>W</strong></span></td>
    <td class="help"><span title="<?php echo lang('ACL_CREATE_FOLDER') ?>"><strong>CD</strong></span></td>
    <td class="help"><span title="<?php echo lang('ACL_CREATE_FILE'  ) ?>"><strong>CF</strong></span></td>
    <td class="help"><span title="<?php echo lang('ACL_CREATE_LINK'  ) ?>"><strong>CL</strong></span></td>
    <td class="help"><span title="<?php echo lang('ACL_CREATE_PAGE'  ) ?>"><strong>CP</strong></span></td>
    <td class="help"><span title="<?php echo lang('ACL_GRANT'        ) ?>"><strong>G</strong></span></td>
    <td class="help"><span title="<?php echo lang('ACL_TRANSMIT'     ) ?>"><strong>T</strong></span></td>
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
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('',$z['release'      ],false) ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('',$z['publish'      ],false) ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('',$z['create_folder'],false) ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('',$z['create_file'  ],false) ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('',$z['create_link'  ],false) ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('',$z['create_page'  ],false) ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('',$z['grant'        ],false) ?></td>
<?php if (isset($z['delete_url']))
      { ?>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('',$z['transmit'],false) ?></td>
<td class="<?php echo $fx ?>"><a href="<?php echo $z['delete_url'] ?>"><?php echo lang('DELETE') ?></a></td>
<?php }
      else
      { ?>
<td class="<?php echo $fx ?>">&nbsp;</td>
<td class="<?php echo $fx ?>"><?php echo lang('inherited') ?></td>
<?php } ?>
</tr>
<?php }
      $fx = fx($fx); ?>

</table>






<br/><br/><br/>
<form action="<?php echo $self ?>" method="post" target="_self">
<input type="hidden" name="subaction" value="addACL">

<table class="main" width="90%" cellspacing="0" cellpadding="4">
<tr>
  <th colspan="2"><?php echo lang('ADD') ?></th>
</tr>
<tr>
<td class="<?php echo $fx ?>"><?php echo lang('USER') ?></td>
<td class="<?php echo $fx ?>"><input type="radio" name="type" value="user" checked>&nbsp;<?php echo Html::selectBox( 'userid',$users); ?></td>

</tr>

<?php if (count($groups)>0)
      { ?>
<tr>
<td class="<?php echo $fx ?>"><?php echo lang('OR').' '.lang('GROUP') ?></td>
<td class="<?php echo $fx ?>"><input type="radio" name="type" value="group">&nbsp;<?php echo Html::selectBox( 'groupid',$groups); ?></td>
</tr>
  <?php } ?>

<tr>
<td class="<?php echo $fx ?>"><?php echo lang('LANGUAGE') ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::selectBox( 'languageid',$languages); ?></td>
</tr>
<tr>
  <td colspan="2" class="help">&nbsp;</td>
</tr>

<tr>
<td class="<?php echo $fx ?>"><?php echo lang('ACL_READ') ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox(''             ,true ,false) ?></td>
</tr>
<tr>
<td class="<?php echo $fx ?>"><?php echo lang('ACL_WRITE') ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('write'        ,false,true,array('title'=>lang('ACL_WRITE'        )) ) ?></td>
</tr>
<tr>
<td class="<?php echo $fx ?>"><?php echo lang('ACL_PROP') ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('prop'         ,false,true,array('title'=>lang('ACL_PROP'         )) ) ?></td>
</tr>
<tr>
<td class="<?php echo $fx ?>"><?php echo lang('ACL_DELETE') ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('delete'       ,false,true,array('title'=>lang('ACL_DELETE'       )) ) ?></td>
</tr>
<tr>
<td class="<?php echo $fx ?>"><?php echo lang('ACL_RELEASE') ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('release'      ,false,true,array('title'=>lang('ACL_RELEASE'      )) ) ?></td>
</tr>
<tr>
<td class="<?php echo $fx ?>"><?php echo lang('ACL_PUBLISH') ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('publish'      ,false,true,array('title'=>lang('ACL_PUBLISH'      )) ) ?></td>
</tr>
<tr>
<td class="<?php echo $fx ?>"><?php echo lang('ACL_CREATE_FOLDER') ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('create_folder',false,true,array('title'=>lang('ACL_CREATE_FOLDER')) ) ?></td>
</tr>
<tr>
<td class="<?php echo $fx ?>"><?php echo lang('ACL_CREATE_FILE') ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('create_file'  ,false,true,array('title'=>lang('ACL_CREATE_FILE'  )) ) ?></td>
</tr>
<tr>
<td class="<?php echo $fx ?>"><?php echo lang('ACL_CREATE_LINK') ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('create_link'  ,false,true,array('title'=>lang('ACL_CREATE_LINK'  )) ) ?></td>
</tr>
<tr>
<td class="<?php echo $fx ?>"><?php echo lang('ACL_CREATE_PAGE') ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('create_page'  ,false,true,array('title'=>lang('ACL_CREATE_PAGE'  )) ) ?></td>
</tr>
<tr>
<td class="<?php echo $fx ?>"><?php echo lang('ACL_GRANT') ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('grant'        ,false,true,array('title'=>lang('ACL_GRANT'        )) ) ?></td>
</tr>
<tr>
<td class="<?php echo $fx ?>"><?php echo lang('ACL_TRANSMIT') ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('transmit'     ,false,true,array('title'=>lang('ACL_TRANSMIT'     )) ) ?></td>
</tr>
<tr>
<td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('ADD') ?>"></td>
</tr>

</table>

</form>



</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>