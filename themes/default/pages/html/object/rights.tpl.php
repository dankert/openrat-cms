<?php include( $tpl_dir.'header.tpl.php') ?>


<center>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="15"><?php echo lang('ACL') ?></th>
</tr>
  <tr>
    <td class="help"><?php echo lang('GLOBAL_NAME')     ?></td>
    <td class="help"><?php echo lang('GLOBAL_LANGUAGE') ?></td>
    <?php foreach( $show as $t ) { ?>
    <td class="help"><span title="<?php echo lang('ACL_'.strtoupper($t)) ?>"><strong><?php echo lang('ACL_'.strtoupper($t).'_ABBREV') ?></strong></span></td>
    <?php } ?>
  </tr>





<?php $fx = '';
      foreach( $acls as $aclid=>$z )
      { $fx = fx($fx); ?>
<tr>
<?php 	if ( $z['username'] != '' )
      	{ ?>
<td width="50%" class="<?php echo $fx ?>"><img src="<?php echo $image_dir.'icon_user'.IMG_EXT ?>" align="left"><?php echo $z['username'] ?></td>
<?php 	}
      	elseif ( $z['groupname'] != '' )
      	{ ?>
<td width="50%" class="<?php echo $fx ?>"><img src="<?php echo $image_dir.'icon_group'.IMG_EXT ?>" align="left"><?php echo $z['groupname'] ?></td>
<?php 	}
      	else
      	{ ?>
<td width="50%" class="<?php echo $fx ?>"><img src="<?php echo $image_dir.'icon_group'.IMG_EXT ?>" align="left"><?php echo lang('GLOBAL_ALL') ?></td>
<?php 	} ?>
<td class="<?php echo $fx ?>"><?php echo $z['languagename'] ?></td>

<?php foreach( $show as $t ) { ?>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('',$z[$t],false,array('title'=>lang('ACL_'.strtoupper($t))) ) ?></td>
<?php } ?>

<?php if (isset($z['delete_url']))
      { ?>
<td class="<?php echo $fx ?>"><a href="<?php echo $z['delete_url'] ?>"><?php echo lang('GLOBAL_DELETE') ?></a></td>
<?php }
      else
      { ?>

<td class="<?php echo $fx ?>"><?php echo lang('ACL_INHERITED') ?></td>
<?php } ?>
</tr>
<?php }
      $fx = fx($fx); ?>

</table>



<br/><br/><br/>
<?php echo Html::form( $action,'addacl',$objectid ) ?>

<table class="main" width="90%" cellspacing="0" cellpadding="4">
<tr>
  <th colspan="3"><?php echo lang('GLOBAL_ADD') ?></th>
</tr>
<tr>
<td class="<?php echo $fx ?>" colspan="2"><?php echo lang('GLOBAL_ALL') ?></td>
<td class="<?php echo $fx ?>"><input type="radio" name="type" value="all" checked="checked" /></td>
</tr>
<tr>
<td class="<?php echo $fx ?>" colspan="2"><?php echo lang('GLOBAL_USER') ?></td>
<td class="<?php echo $fx ?>"><input type="radio" name="type" value="user" />&nbsp;<?php echo Html::selectBox( 'userid',$users,0,array('onfocus'=>'document.forms[0].type[1].checked=true')); ?></td>
</tr>

<?php if (count($groups)>0)
      { ?>
<tr>
<td class="<?php echo $fx ?>" colspan="2"><?php echo lang('GLOBAL_GROUP') ?></td>
<td class="<?php echo $fx ?>"><input type="radio" name="type" value="group" />&nbsp;<?php echo Html::selectBox( 'groupid',$groups,0,array('onfocus'=>'document.forms[0].type[2].checked=true')); ?></td>
</tr>
<?php } ?>

<tr>
<td class="<?php echo $fx ?>" colspan="2"><?php echo lang('GLOBAL_LANGUAGE') ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::selectBox( 'languageid',$languages); ?></td>
</tr>
<tr>
  <td colspan="3" class="help">&nbsp;</td>
</tr>

<?php foreach( $show as $t ) { ?>
<tr>
<td class="<?php echo $fx ?>"><?php echo lang('ACL_'.strtoupper($t)) ?></td>
<td class="<?php echo $fx ?>" width="20"><?php echo lang('ACL_'.strtoupper($t).'_ABBREV') ?></td>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox($t,($t=='read'),($t!='read'),array('title'=>lang('ACL_'.strtoupper($t) )) ) ?></td>
</tr>
<?php } ?>
<tr>
<td class="act" colspan="3"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_ADD') ?>"></td>
</tr>

</table>

</form>



</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>