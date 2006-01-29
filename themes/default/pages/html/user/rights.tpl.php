<?php include( $tpl_dir.'header.tpl.php') ?>
<center>
<?php foreach($projects as $projectid=>$projectname) { ?>
<?php windowOpen( lang('GLOBAL_PROJECT').': '.$projectname,15) ?>
<tr>
<td class="help"><?php echo lang('GLOBAL_FILENAME')     ?></td>
<td class="help"><?php echo lang('GLOBAL_LANGUAGE')     ?></td>
<?php foreach( $show as $t ) { ?>
<td class="help"><span title="<?php echo lang('ACL_'.strtoupper($t)) ?>"><strong><?php echo lang('ACL_'.strtoupper($t).'_ABBREV') ?></strong></span></td>
<?php } ?>
</tr>
<?php $fx = '';
if (isset($rights[$projectid]) && is_array($rights[$projectid]))
{
foreach( $rights[$projectid] as $oid=>$z )
{ $fx = fx($fx); ?>
<tr>
<?php $objectUrl = Html::url( 'index','object',$oid ) ?>
<td class="<?php echo $fx ?>"><a href="<?php echo $objectUrl ?>" target="_top"><img src="<?php echo $image_dir.'icon_'.$objects[$oid]['type'].IMG_EXT ?>" border="0" align="left"><?php echo $objects[$oid]['filename'] ?></a></td>
<td class="<?php echo $fx ?>"><?php echo $z['languagename'] ?></td>
<?php foreach( $show as $t )
{ ?>
<td class="<?php echo $fx ?>"><?php echo Html::checkBox('',$z[$t],false,array('title'=>lang('ACL_'.strtoupper($t))) ) ?></td>
<?php } ?>
</tr>
<?php }
$fx = fx($fx); ?>
<?php }
else
{ $fx = fx($fx); ?>
<tr>
<td colspan="14" class="<?php echo $fx ?>"><?php echo lang('GLOBAL_NOT_FOUND') ?></td>
</tr>
<?php } ?>
<?php windowClose() ?>
<?php } ?>
</center>
<?php include( $tpl_dir.'footer.tpl.php') ?>
