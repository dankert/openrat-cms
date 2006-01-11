page

	window title:ACL name:x

		if empty:acls
			row
				cell class:fx
					text text:GLOBAL_NOT_FOUND
		if empty:acls invert:y
			row
				cell class:help
					text text:GLOBAL_NAME
				cell class:help
					text text:GLOBAL_LANGUAGE
				//cell
RAW
<?php foreach( $show as $t ) { ?>
<td class="help"><span title="<?php echo lang('ACL_'.strtoupper($t)) ?>"><strong><?php echo lang('ACL_'.strtoupper($t).'_ABBREV') ?></strong></span></td>
<?php } ?>
END
				cell class:help
					text text:global_delete

		list list:acls key:aclid value:z extract:true
			row
				//cell
RAW
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
END
				cell
					text var:languagename


RAW
<?php foreach( $show as $t ) { ?>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('',$z[$t],false,array('title'=>lang('ACL_'.strtoupper($t))) ) ?></td>
<?php } ?>
END


RAW
<?php if (isset($z['delete_url']))
      { ?>
<td class="<?php echo $fx ?>"><a href="<?php echo $z['delete_url'] ?>"><?php echo lang('GLOBAL_DELETE') ?></a></td>
<?php }
      else
      { ?>

<td class="<?php echo $fx ?>"><?php echo lang('ACL_INHERITED') ?></td>
<?php } ?>
END

insert file:footer