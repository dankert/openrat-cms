<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<form action="<?php echo $self ?>" method="post" target="_self">
<input type="hidden" name="action"    value="language">
<input type="hidden" name="subaction" value="add">

<table class="main" width="60%" cellspacing="0" cellpadding="4">
<tr>
  <th colspan="3"><?php echo lang('GLOBAL_LANGUAGES') ?></th>
</tr>

<?php $f1=true;
      foreach( $el as $id=>$e )
      { ?>
<tr>
<?php 	if ( isset($e['url']))
		{ ?>
<td width="50%" class="<?php if($f1==true) {echo'f1';          } else{echo'f2';         }?>"><a href="<?php echo $e['url'] ?>"><img src="<?php echo $image_dir.'icon_lang.png' ?>" align="left" border="0" /><?php echo $e['name'] ?></a></td>
<td width="25%" class="<?php if($f1==true) {echo'f1';$f1=false;} else{echo'f2';$f1=true;}?>"><?php if (!isset($e['default_url'])) echo '<strong>'.lang('GLOBAL_default').'</strong>'; else echo '<a href="'.$e['default_url'].'">'.lang('GLOBAL_make_default').'</a>' ?></td>
<?php 	}
		else
		{ ?>
<td width="50%" class="<?php if($f1==true) {echo'f1';          } else{echo'f2';         }?>"><img src="<?php echo $image_dir.'icon_lang.png' ?>" align="left"/><?php echo $e['name'] ?></td>
<td width="25%" class="<?php if($f1==true) {echo'f1';$f1=false;} else{echo'f2';$f1=true;}?>">&nbsp;</td>
<?php 	} ?>
<td width="25%" class="<?php if($f1==true) {echo'f1';$f1=false;} else{echo'f2';$f1=true;}?>"><?php if (!isset($e['select_url' ])) echo '<strong>'.lang('GLOBAL_selected').'</strong>'; else echo '<a href="'.'?'.$e['select_url'].'">'.lang('GLOBAL_select').'</a>' ?></td>
</tr>
<?php } ?>

<?php if (isset($isocodes))
      { ?>
<tr>
<td colspan="3" class="act"><?php echo Html::selectBox( 'isocode',$isocodes ) ?>
<input type="submit" class="submit" value="<?php echo lang('GLOBAL_ADD') ?>"></td>
</tr>
<?php } ?>

</table>

</form>

</center>

<?php include( $tpl_dir.'footer.tpl.php') ?>