<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<form action="<?php echo $self ?>" method="post" target="_self">
<input type="hidden" name="action"    value="model">
<input type="hidden" name="subaction" value="add">

<table class="main" width="60%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="3"><?php echo lang('MODELS') ?></th>
</tr>

<?php $f1=true;
      foreach( $el as $id=>$e )
      { ?>
<tr>
<?php 	if (isset($e['url']))
      	{ ?>
<td width="50%" class="<?php if($f1==true) {echo'f1';          } else{echo'f2';         }?>"><a href="<?php echo $e['url'] ?>"><?php echo $e['name'] ?></a></td>
<td width="25%" class="<?php if($f1==true) {echo'f1';$f1=false;} else{echo'f2';$f1=true;}?>"><?php if ( !isset($e['default_url'])) echo '<strong>'.lang('default' ).'</strong>'; else echo '<a href="'.'?'.$e['default_url'].'">'.lang('make_default').'</a>' ?></td>
<?php 	}
      	else
      	{ ?>
<td width="50%" class="<?php if($f1==true) {echo'f1';          } else{echo'f2';         }?>"><?php echo $e['name'] ?></td>
<td width="25%" class="<?php if($f1==true) {echo'f1';$f1=false;} else{echo'f2';$f1=true;}?>">&nbsp;</td>
<?php 	} ?>
<td width="25%" class="<?php if($f1==true) {echo'f1';$f1=false;} else{echo'f2';$f1=true;}?>"><?php if ( !isset($e['select_url' ])) echo '<strong>'.lang('selected').'</strong>'; else echo '<a href="'.'?'.$e['select_url' ].'">'.lang('select'      ).'</a>' ?></td>
</tr>
<?php } ?>

<?php if ($add)
      { ?>
<tr>
<td class="act" colspan="3">

<?php echo lang('ADD') ?> <input type="text" name="name" size="30">
<input type="submit" class="submit" value="<?php echo lang('ADD') ?>">
</td>
</tr>
<?php } ?>

</table>

</form>

</center>

<script name="JavaScript" type="text/javascript"><!--
document.forms[0].name.focus();
//--></script>

<?php include( $tpl_dir.'footer.tpl.php') ?>