<?php include( $tpl_dir.'header.tpl.php') ?>

<center>

<?php echo Html::form('folder','pubnow') ?>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th colspan="2"><?php echo lang('GLOBAL_PUBLISH') ?></th>
</tr>

<tr>
  <td width="50%" class="f1"><?php if	($pages||$subdirs) echo Html::checkbox('pages'  ,$pages).'&nbsp;'.lang('GLOBAL_pages'               ).'<br/>' ?>
                             <?php if	($files||$subdirs) echo Html::checkbox('files'  ,$files).'&nbsp;'.lang('GLOBAL_files'               ).'<br/>' ?>
  </td>
  <td width="50%" class="f1"><?php if	($subdirs)         echo Html::checkbox('subdirs',false).'&nbsp;'.lang('GLOBAL_PUBLISH_WITH_SUBDIRS').'<br/>' ?>
                             <?php if	($clean)           echo Html::checkbox('clean'  ,false).'&nbsp;'.lang('GLOBAL_CLEAN_AFTER_PUBLISH' ).'<br/>' ?>
  </td>
</tr>

<tr>
  <td class="help" colspan="2"><?php echo lang('GLOBAL_MUCH_TIME') ?></td>
</tr>

<tr>
  <td class="act" colspan="2"><input type="submit"  class="submit" value="<?php echo lang('GLOBAL_PUBLISH') ?>"></td>
</tr>


</table>

</form>


</center>

<?php Html::focusField('subdirs') ?>

<?php include( $tpl_dir.'footer.tpl.php') ?>