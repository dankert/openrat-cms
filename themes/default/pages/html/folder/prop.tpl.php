<?php include( $tpl_dir.'header.tpl.php') ?>

<center>

<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="subaction" value="save">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('GLOBAL_PROP') ?></th>
</tr>

<tr>
<td width="50%" rowspan="2" class="f1"><?php echo lang('GLOBAL_name') ?></a></td>
<td width="50%"             class="f1"><input class="name" type="text" name="name" size="50" value="<?php echo $name ?>"></td>
</tr>
<tr>
<td width="50%" class="help"><?php echo lang('GLOBAL_NAME_DESC') ?></td>
</tr>
<tr>
<td width="50%" rowspan="2" class="f1"><?php echo lang('GLOBAL_filename') ?></a></td>
<td width="50%"             class="f1"><input  class="filename" type="text" name="filename" size="50" value="<?php echo $filename ?>"></td>
</tr>
<tr>
<td width="50%" class="help"><?php echo lang('GLOBAL_FILENAME_DESC') ?></td>
</tr>
<tr>
<td width="50%" class="f2"><?php echo lang('GLOBAL_description') ?></a></td>
<td width="50%" class="f2"><textarea  class="desc" cols="40" rows="10" name="desc"><?php echo $desc ?></textarea></td>
</tr>
<?php if($delete)
      { ?>
<tr>
<td width="50%" class="f2"><?php echo lang('GLOBAL_delete') ?></a></td>
<td width="50%" class="f2"><?php echo Html::checkBox('delete') ?></td>
</tr>
<?php } ?>
<tr>
<td class="act"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>"></td>
<td class="act"><input type="reset"  class="reset"  value="<?php echo lang('GLOBAL_UNDO') ?>" onClick="document.forms[0].name.focus();"></td>
</tr>

</table>

</form>



</center>

<?php Html::focusField('name') ?>

<?php include( $tpl_dir.'footer.tpl.php') ?>