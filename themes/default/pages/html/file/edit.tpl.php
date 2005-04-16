<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<?php windowOpen( 'FILE_REPLACE',2,'file') ?>

<tr>
  <td colspan="2" class="help"><?php echo lang('FILE_REPLACE_DESC') ?></td>
</tr>

<tr>
<td colspan="2" class="act">
  <?php echo Html::form( 'file','replace',$id,array('enctype'=>'multipart/form-data') ) ?>

    <input type="file" name="file"> <input type="submit" class="submit" value="<?php echo lang('GLOBAL_UPLOAD') ?>">
  </form>

</td>
</tr>

<?php windowClose() ?>

<?php if ( count($formats) > 0 )
      { ?>
<?php echo Html::form( 'file','resize',$id ) ?>

<?php windowOpen( 'FILE_IMAGE_RESIZE',2,'file') ?>

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
<td width="50%" class="f2"><?php echo Html::selectBox('format',$formats,$default_format) ?></td>
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

<?php windowClose() ?>

</form>
<?php } ?>





<?php if	( substr($mimetype,0,5) == 'text/' )
      { ?>

<?php echo Html::form( 'file','savevalue',$id ) ?>

<?php windowOpen( 'GLOBAL_VALUE',2,'file') ?>

<tr>
<td class="f2"><?php echo lang('GLOBAL_VALUE') ?></a></td>
<td class="f2"><textarea cols="60" rows="35" name="value"><?php echo htmlentities($value) ?></textarea></td>
</tr>
<tr>
<td class="act" colspan="2"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>"></td>
</tr>

<?php windowClose() ?>

</form>
<?php } ?>

</center>

<?php Html::focusField('name') ?>

<?php include( $tpl_dir.'footer.tpl.php') ?>