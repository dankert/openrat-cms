<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<?php echo Html::form('template','addelement',$templateid ) ?>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('TEMPLATE_ELEMENTS') ?></th>
</tr>

<?php
	 $fx = '';
      if (count($el)>0) foreach( $el as $id=>$e )
      { $fx = fx($fx); ?>
<tr>
<td width="50%" class="<?php echo $fx ?>"><a href="<?php echo $e['url'] ?>" title="<?php echo $e['desc'] ?>"><img src="<?php echo $image_dir.'icon_el_'.$e['type'].IMG_EXT ?>" border="0" align="left"><?php echo $e['name'] ?></a></td>
<td width="50%" class="<?php echo $fx ?>"><?php echo lang('el_'.$e['type']) ?></td>
</tr>
<?php }
      else
      { $fx = fx($fx); ?>
<tr>
<td colspan="2" class="<?php echo $fx ?>"><?php echo lang('GLOBAL_NOT_FOUND') ?></td>
</tr>
<?php } ?>


<tr>
<td class="act" colspan="2"><input type="text" name="name" value=""> <input type="submit" class="submit" value="<?php echo lang('GLOBAL_ADD') ?>"></td>
</tr>

</table>

</form>

</center>

<script name="JavaScript" type="text/javascript"><!--
document.forms[0].name.focus();
//--></script>

<?php include( $tpl_dir.'footer.tpl.php') ?>