<?php include( $tpl_dir.'header.tpl.php') ?>

<!-- $Id$ -->
<center>

<?php echo Html::form('page','elsave') ?>

<table class="main" width="90%" cellspacing="0" cellpadding="4">

<tr>
  <th><?php echo $name ?></th>
</tr>
<tr>
  <td class="help"><?php echo $desc ?></th>
</tr>

<tr>
<td class="f1"><?php echo Html::selectBox( 'linkobjectid',$objects,$act_linkobjectid) ?></td>
</tr>

<?php if	( $release )
      { ?>
<tr>
<td class="f2"><?php echo Html::checkBox('release',true,true) ?> <?php echo lang('GLOBAL_RELEASE') ?></td>
</tr>
<?php } ?>
<?php if	( $publish )
      { ?>
<tr>
  <td class="f2"><?php echo Html::checkBox('publish',false) ?> <?php echo lang('PAGE_PUBLISH_AFTER_SAVE') ?></td>
</tr>
<?php } ?>

<tr>
<td class="act"><input type="submit" class="submit" value="<?php echo lang('GLOBAL_SAVE') ?>"></td>
</tr>

</table>

</form>

</center>

<?php include( $tpl_dir.'footer.tpl.php') ?>