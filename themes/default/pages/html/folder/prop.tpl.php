<?php include( $tpl_dir.'header.tpl.php') ?>

<center>

<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="subaction" value="save">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('PROP') ?></th>
</tr>

<tr>
<td width="50%" rowspan="2" class="f1"><?php echo lang('name') ?></a></td>
<td width="50%"             class="f1"><input class="name" type="text" name="name" size="50" value="<?php echo $name ?>"></td>
</tr>
<tr>
<td width="50%" class="help"><?php echo lang('HELP_NAME') ?></td>
</tr>
<tr>
<td width="50%" rowspan="2" class="f1"><?php echo lang('filename') ?></a></td>
<td width="50%"             class="f1"><input  class="filename" type="text" name="filename" size="50" value="<?php echo $filename ?>"></td>
</tr>
<tr>
<td width="50%" class="help"><?php echo lang('HELP_FILENAME') ?></td>
</tr>
<tr>
<td width="50%" class="f2"><?php echo lang('description') ?></a></td>
<td width="50%" class="f2"><textarea  class="desc" cols="40" rows="10" name="desc"><?php echo $desc ?></textarea></td>
</tr>
<?php if($delete)
      { ?>
<tr>
<td width="50%" class="f2"><?php echo lang('delete') ?></a></td>
<td width="50%" class="f2"><?php echo Html::checkBox('delete') ?></td>
</tr>
<?php } ?>
<tr>
<td class="act"><input type="submit" class="submit" value="<?php echo lang('SAVE') ?>"></td>
<td class="act"><input type="reset"  class="reset"  value="<?php echo lang('UNDO') ?>" onClick="document.forms[0].name.focus();"></td>
</tr>

</table>

</form>


<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="<?php echo session_name() ?>" value="<?php echo session_id() ?>">
<input type="hidden" name="folderaction" value="move">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('MOVE') ?></th>
</tr>

<tr>
<td width="50%" class="f1"><?php echo lang('FOLDER') ?></a></td>
<td width="50%" class="f1"><?php echo Html::selectBox('movetoobjectid',$folder,$act_objectid) ?></td>
</tr>

<tr>
<td class="act" colspan="2"><input type="submit"  class="submit" value="<?php echo lang('MOVE') ?>"></td>
</tr>

</table>

</form>


</center>

<script name="JavaScript" type="text/javascript"><!--
document.forms[0].name.focus();
//--></script>

<?php include( $tpl_dir.'footer.tpl.php') ?>