<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('FILE_REPLACE') ?></th>
</tr>
<tr>
  <td colspan="2" class="help"><?php echo lang('FILE_REPLACE_DESC') ?></td>
</tr>

<tr>
<td colspan="2" class="act">
  <form action="<?php echo $self ?>" method="post" enctype="multipart/form-data">
  <input type="hidden" name="action"    value="file">
  <input type="hidden" name="subaction" value="replace">
  <input type="file" name="file"> <input type="submit" class="submit" value="<?php echo lang('GLOBAL_UPLOAD') ?>">
  </form>

</td>
</tr>

</table>

<?php if	( substr($mimetype,0,6) == 'image/' )
      { ?>
<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="action"    value="file">
<input type="hidden" name="subaction" value="resize">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('FILE_IMAGE_RESIZE') ?></th>
</tr>
<tr>
  <td colspan="2" class="help"><?php echo lang('FILE_IMAGE_RESIZE_DESC') ?></td>
</tr>

<tr>
<td width="50%" class="f2"><?php echo lang('FILE_IMAGE_NEW_WIDTH') ?></td>
<td width="50%" class="f2"><input type="text" name="width" value=""></td>
</tr>
<tr>
<td width="50%" class="f2"><?php echo lang('FILE_IMAGE_NEW_HEIGHT') ?></td>
<td width="50%" class="f2"><input type="text" name="height" value=""></td>
</tr>
<tr>
<td width="50%" class="f2"><?php echo lang('FILE_IMAGE_FORMAT') ?></td>
<td width="50%" class="f2"><?php echo Html::selectBox('format',$formats,$extension) ?></td>
</tr>
<tr>
<td width="50%" class="f2"><?php echo lang('FILE_IMAGE_JPEG_COMPRESSION') ?></td>
<?php
	$jpeglist = array();
	for ($i=10; $i<=95; $i+=5)
		$jpeglist[$i]=$i.'%';
?>
<td width="50%" class="f2"><?php echo Html::selectBox('jpeg_compression',$jpeglist,'70') ?></td>
</tr>

<tr>
<td class="act" colspan="2"><input type="submit"  class="submit" value="<?php echo lang('FILE_IMAGE_RESIZE') ?>"></td>
</tr>

</table>

</form>
<?php } ?>





<?php if	( substr($mimetype,0,5) == 'text/' )
      { ?>

<form action="<?php echo $self ?>" method="post" target="_self">

<input type="hidden" name="action"    value="file">
<input type="hidden" name="subaction" value="savevalue">

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('GLOBAL_VALUE') ?></th>
</tr>

<tr>
<td class="f2"><?php echo lang('GLOBAL_VALUE') ?></a></td>
<td class="f2"><textarea cols="60" rows="35" name="value"><?php echo htmlentities($value) ?></textarea></td>
</tr>
<tr>
<td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>"></td>
</tr>

</table>

</form>
<?php } ?>



</center>

<?php Html::focusField('name') ?>

<?php include( $tpl_dir.'footer.tpl.php') ?>